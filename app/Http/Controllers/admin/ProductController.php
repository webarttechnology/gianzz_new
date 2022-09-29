<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\Categary;
use App\Models\Subcategary;
use App\Models\Rope_chain;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;

class ProductController extends Controller
{
    private $pageLimit = 30;
    public function list(Request $request){
        if($request ->method() == 'GET'){
            $data = Blog:: limit(30)->get();
            $categary = Categary::get();
            $sub_categary = Subcategary::get();
            $rope_chain =Rope_chain::get();
                     
                $newArray =[];
               foreach($data as $d){
                
                $newArray[] = [
                    'product'=> $d,
                    'rope' => Rope_chain::where('blog_id', $d-> id)-> get(),
                    'minprice' =>Rope_chain::select('final_price')->where('blog_id',$d->id)->min('final_price'),
                    'maxprice' =>Rope_chain::select('final_price')->where('blog_id',$d->id)->max('final_price'),
                    'discount_amt'=>Rope_chain::select('discount_amt')->where('blog_id',$d->id)->first(),
                    'discountPercentage' =>Rope_chain::select('discount_percentage')->where('blog_id',$d->id)->first()
                ];
              }


            $productCount = Blog::count();
           
            $pageCount = $productCount/$this -> pageLimit;            
            if($request -> get('page')){
              $starting = $request -> get('page') - 3 <= 0?1:$request -> get('page') - 3;
              $ending = $request -> get('page')+3 < round($pageCount)?$request -> get('page')+3:round($pageCount);
              $starting = $starting > $ending ? $ending - 5 : $starting ;
            }else{
              $starting = 1;
              $ending = $request -> get('page')+3 < round($pageCount)?$request -> get('page')+3:round($pageCount);
            }

           
            return view('admin/product/productList',['errorNo' => $request->get('page')?$request->get('page'):1, 'fullurl' => '/author/product', 'starting'=> $starting, 'ending'=> $ending, 'selectedPage' => $request->get('page')?$request->get('page'):1, 'maxCount' => $pageCount, 'blog'=>$newArray,'rope_chain'=>$rope_chain, 'categary' => $categary, 'subCategary' => $sub_categary,'title' =>"Product",'newArray'=>$newArray]);
        }
    }

   public function add(Request $request){
       if($request ->method() == 'GET'){
            $categary = Categary::get();
            $sub_categary = Subcategary::get();
           return view('admin/product/add-product',['title' =>"Product",'categary' => $categary, 'subCategary' => $sub_categary,]);
       }else if($request -> method() == "POST"){

             $chain = $request->post('ropeChain');
             $amount =$request->post('amount');
             $color =$request->post('gold_color');
             $finalprice =$request->post('final_price');
             $dicountPercentage =$request->post('discount_percentage');
             $carat =$request->post('carat');
             $discountamount=$request->post('discount_amt');
             $is_variation = "1";

           //echo $is_variation;die;
            $request->validate([
               'tittle'  =>'required',
               'categary_id'  =>'required',
               'description'  =>'required', 
               'name' =>'required',
               'ropeChain'=>'required',
               'amount' =>'required', 
               'gold_color' =>'required', 
               'discount_percentage' =>'required', 
               'image' =>'required',
               'sku_code' =>'required'
           ]);

          
           $duplicateProductyCheck = Blog::where('sku_code', $request->sku_code)->where('id','!=',$request->id)->count();
         
           if($duplicateProductyCheck == 0){
                $slug = Str::slug($request->name, '-');
                $categary = Blog::create([
                    'tittle' =>$request->tittle,
                    'categary_id' =>$request->categary_id,
                    'subcategary_id' =>$request->subcategary_id,
                    'name' =>$request->name,
                    'description' =>$request->description,
                    'slug_name' =>$slug.'-'.$request->sku_code,
                    'sku_code' =>$request->sku_code,
                    'is_variation'=>$is_variation,
                    'image' => 1
                ]);

               

                if($is_variation == 1){
                    foreach($chain as $key => $val){
                        if($_FILES['otherimage']['name'][$key] != ""){
                            $file = $request->file('otherimage')[$key];
                            $name = $file->getClientOriginalName();
                            $path = "uploads/";
                            $file->move($path, $name.$key.time().'.'.$file->getClientOriginalExtension());
                            $image_name = $path. $name.$key.time().'.'.$file->getClientOriginalExtension();
                        }else{
                            $image_name = "";
                        }


                        $ropeChain = Rope_chain::create([         
                        'name' =>$val?$val:'',
                        'blog_id' =>$categary->id,
                        'gold_color' =>$color[$key]?$color[$key]:'N/A',
                        'amount' =>$amount[$key]?$amount[$key]:'',
                        'discount_percentage'=>$dicountPercentage[$key]?$dicountPercentage[$key]:'',
                        'discount_amt' =>$discountamount[$key]?$discountamount[$key]:'',
                        'final_price' =>$finalprice[$key]?$finalprice[$key]:'',
                        'carat' =>$carat[$key]?$carat[$key]:'N/A',
                        'image' => $image_name
                        ]);
                    }

                
                }else{
                    $ropeChain = Blog::where('id', $categary->id)->update([
                        'p_amt' => $amount[0],
                        'gold_color' => $color[0],
                        'discount_percentage' => $dicountPercentage[0],
                        'final_price' => $finalprice[0],
                        'discount_amt' => $discountamount[0],
                        'carat' => $carat[0]
                    ]);
                }


                $lastId = $categary->id;
                $file = $request->file('image');
                $name = $file->getClientOriginalName();
                $path = "uploads/";
                $file->move($path, $lastId.$name."image1");

                $image_name = $path. $lastId.$name."image1";
                $update_image = Blog::where('id', $lastId)->update([
                    'image' => $image_name
                ]);

                if($request->hasFile('image4')){              
                        $file5 = $request->file('image4');
                        $name = $file5->getClientOriginalName();
                        $path = "uploads/";
                        $file5->move($path, $lastId.$name."image5");
        
                        $image_name5 = $path.$lastId.$name."image5";
                        $update_image = Blog::where('id',$lastId)->update([
                            'image4'  =>$image_name5,
                        ]);
                }


                if($update_image && $categary){
                    return Redirect::to('/author/product')-> with('successmsg',Config::get('constants.ADD_SUCCESS'));
                }else{
                    return Redirect::to('/author/product')-> with('errmsg',Config::get('constants.ADD_ERROR'))->withInput($request->all);
                }
           }else{
            return Redirect::to('/author/product/add')-> with('errmsg',"Already Exist This Product");
           }
       }
    }


  public function update(Request $request, $id = ''){
        if($request -> method() == "GET" || $id != ''){
            $data = Blog ::find($id);
            $categary = Categary::get();
            $rope = Rope_chain::where('blog_id',$id)->get();
            $lastrope_id = Rope_chain::orderBy('id', 'desc')->where('blog_id',$id)->first();
           // echo "blog_id". $lastrope_id->blog_id ."-".$lastrope_id->id;die;
            $subcategary = Subcategary::where('categary_id', $data ->categary_id) ->get();
            return view('admin/product/update-product',['blog' => $data,'rope'=>$rope,'lastrope_id'=>$lastrope_id->id,'categary' => $categary, 'subcategary' => $subcategary,'title' =>"Product"]);
       
        }else{
            $id= $request->post('id');
            $is_variation =$request->is_variation?$request->is_variation:"0";
            $request->validate([
                'tittle'  =>'required',
                'categary_id'  =>'required',
                'description'  =>'required', 
                'name' =>'required',
                'amount' =>'required', 
                'gold_color' =>'required', 
                'discount_percentage' =>'required', 
                'sku_code' =>'required'
 
            ]);

            $duplicateProductyCheck = Blog::where('sku_code',$request->sku_code)->where('id','!=',$request->id)->count();

            if($duplicateProductyCheck == 0) {

                $slug = Str::slug($request->name, '-').'-'.$request -> sku_code; 

                $updateDate = [
                    'tittle' =>$request->tittle,
                    'categary_id' =>$request->categary_id,
                    'subcategary_id' =>$request->subcategary_id,
                    'name' =>$request->name,
                    'description' =>$request->description,
                    'slug_name' =>$slug,
                    'sku_code' =>$request->sku_code,
                ];

             


                if($request -> hasFile('image') != ''){
                $file = $request->file('image');
                $name = $file->getClientOriginalName();
                $path = "uploads/";
                $file->move($path, $path.time().'.'.$file->getClientOriginalExtension());
                $updateDate['image'] = $path.time().'.'.$file->getClientOriginalExtension();
                }

               
                $update = Blog::where('id', $request->id)->update($updateDate);
               

                $variation = $request->post('ropeChain');

               
                for($i=0; $i<count($variation); $i++){
                    $updateVariationData = [
                        'name' =>$request->post('ropeChain')[$i]?$request->post('ropeChain')[$i]:'',
                        'gold_color' =>$request->post('gold_color')[$i]?$request->post('gold_color')[$i]:'N/A',
                        'amount' =>$request->post('amount')[$i]?$request->post('amount')[$i]:'',
                        'discount_percentage'=>$request->post('discount_percentage')[$i]?$request->post('discount_percentage')[$i]:'',
                        'discount_amt' =>$request->post('discount_amt')[$i]?$request->post('discount_amt')[$i]:'',
                        'final_price' =>$request->post('final_price')[$i]?$request->post('final_price')[$i]:'',
                        'carat' =>$request->post('carat')[$i]?$request->post('carat')[$i]:'N/A',
                    ];

                    if($_FILES['otherimage']['name'][$i] != ""){
                        $file = $request->file('otherimage')[$i];
                        $name = $file->getClientOriginalName();
                        $path = "uploads/";
                        $file->move($path, $path.$i.time().'.'.$file->getClientOriginalExtension());
                        $updateVariationData['image'] = $path.$i.time().'.'.$file->getClientOriginalExtension();
                    }

                    $ropeChain = Rope_chain::where('id',$request ->rope_id[$i])->update($updateVariationData);
                }

               
                return Redirect::to('/author/product')-> with('successmsg',Config::get('constants.UPDATE_SUCCESS'));


            }else{
                return Redirect::to('/author/product/upate/'.$request->id)-> with('errmsg',"Already Exist This Product")->withInput($request->all);   
            }

        }
  }

  public function update_bk(Request $request , $id = ''){    
       if($request ->method() == 'GET' || $id != '' ){
           $data = Blog ::find($id);
           $categary = Categary::get();
           $rope = Rope_chain::where('blog_id',$id)->get();
           $lastrope_id = Rope_chain::orderBy('id', 'desc')->where('blog_id',$id)->first();
          // echo "blog_id". $lastrope_id->blog_id ."-".$lastrope_id->id;die;
           $subcategary = Subcategary::where('categary_id', $data ->categary_id) ->get();
           return view('admin/product/update-product',['blog' => $data,'rope'=>$rope,'lastrope_id'=>$lastrope_id->id,'categary' => $categary, 'subcategary' => $subcategary,'title' =>"Product"]);
       }else if ($request -> method() == "POST"){
          $id= $request->post('id');

          $is_variation =$request->is_variation?$request->is_variation:"0";
            $request->validate([
                'tittle'  =>'required',
                'categary_id'  =>'required',
                'description'  =>'required', 
                'name' =>'required',
                'amount' =>'required', 
                'gold_color' =>'required', 
                'discount_percentage' =>'required', 
                'sku_code' =>'required'
 
            ]);
            
            $duplicateProductyCheck = Blog::where('name',$request->name)->where('id','!=',$request->id)->count();
             if($duplicateProductyCheck == 0) {
                    $slug = Str::slug($request->name, '-'); 
                   

                    if($request->hasFile('image')){
                        $get_file_name = Blog::where('id',$id)->select('image')->get();
                        
                          foreach($get_file_name as $value){
                                @unlink($value->image);
                                }
                            $file = $request->file('image');
                            $name = $file->getClientOriginalName();
                            $path = "uploads/";
                            $file->move($path, $id.$name."image1");

                            $image_name = $path.$id.$name."image1";

                            $update_data = Blog::where('id', $request->id)->update([
                                'tittle' =>$request->tittle,
                                'categary_id' =>$request->categary_id,
                                'subcategary_id' =>$request->subcategary_id,
                                'name' =>$request->name,
                                'description' =>$request->description,
                                'slug_name' =>$slug,
                                'sku_code' =>$request->sku_code,
                                'image' => $image_name
                                ]);
                            // echo $update_data;die;
                        }if($request->hasFile('image1')){                 
                            $get_file_name = Blog::where('id',$request->id)->select('image1')->get();
                           
                                 foreach($get_file_name as $value){
                                    @unlink($value->image1);
                                    }
                                $file = $request->file('image1');
                                $name = $file->getClientOriginalName();
                                $path = "uploads/";
                                $file->move($path, $id.$name."image2");

                                $image_name1 = $path.$request->id.$name."image2";
                                $update_data = Blog::where('id',$request->id)->update([
                                    'tittle' =>$request->tittle,
                                'categary_id' =>$request->categary_id,
                                'subcategary_id' =>$request->subcategary_id,
                                'name' =>$request->name,
                                'description' =>$request->description,
                                'slug_name' =>$slug,
                                'sku_code' =>$request->sku_code,
                                'image1' => $image_name1
                                ]);
                        }if($request->hasFile('image2')){  
                            $get_file_name = Blog::where('id',$request->id)->select('image2')->get();               
                                    foreach($get_file_name as $value){
                                    @unlink($value->image2);
                                    }
                                $file = $request->file('image2');
                                $name = $file->getClientOriginalName();
                                $path = "uploads/";
                                $file->move($path, $id.$name."image3");

                                $image_name2 = $path.$id.$name."image3";
                                $update_data = Blog::where('id',$request->id)->update([
                                    'tittle' =>$request->tittle,
                                    'categary_id' =>$request->categary_id,
                                    'subcategary_id' =>$request->subcategary_id,
                                    'name' =>$request->name,
                                    'description' =>$request->description,
                                    'slug_name' =>$slug,
                                    'sku_code' =>$request->sku_code,
                                    'image2' => $image_name2
                                ]);
                        }if($request->hasFile('image3')){  
                            $get_file_name = Blog::where('id',$request->id)->select('image3')->get();               
                                    foreach($get_file_name as $value){
                                    @unlink($value->image3);
                                    }
                                $file = $request->file('image3');
                                $name = $file->getClientOriginalName();
                                $path = "uploads/";
                                $file->move($path, $id.$name."image4");

                                $image_name3 = $path.$id.$name."image4";
                                $update_data = Blog::where('id',$id)->update([
                                    'tittle' =>$request->tittle,
                                    'categary_id' =>$request->categary_id,
                                    'subcategary_id' =>$request->subcategary_id,
                                    'name' =>$request->name,
                                    'description' =>$request->description,
                                    'slug_name' =>$slug,
                                    'sku_code' =>$request->sku_code,
                                    'image3' =>  $image_name3
                                ]);
                        }if($request->hasFile('image4')){                 
                            $get_file_name = Blog::where('id',$request->id)->select('image4')->get();
                                    foreach($get_file_name as $value){
                                    @unlink($value->image4);
                                    }
                                $file = $request->file('image4');
                                $name = $file->getClientOriginalName();
                                $path = "uploads/";
                                $file->move($path, $id.$name."image5");

                                $image_name4 = $path.$id.$name."image5";
                                $update_data = Blog::where('id',$id)->update([
                                    'tittle' =>$request->tittle,
                                    'categary_id' =>$request->categary_id,
                                    'subcategary_id' =>$request->subcategary_id,
                                    'name' =>$request->name,
                                    'description' =>$request->description,
                                    'slug_name' =>$slug,
                                    'sku_code' =>$request->sku_code,
                                    'image4' =>  $image_name4
                                ]);
                        }else{
                            $update_data = Blog::where('id', $id)->update([
                                'tittle' =>$request->tittle,
                                'categary_id' =>$request->categary_id,
                                'subcategary_id' =>$request->subcategary_id,
                                'name' =>$request->name,
                                'description' =>$request->description,
                                'sku_code' =>$request->sku_code,
                                'slug_name' =>$slug,
                            ]);
                        }
                        $rope_id = $request->post('rope_id');
                        $chain = $request->post('ropeChain');
                        $amount =$request->post('amount');
                        $color =$request->post('gold_color');
                        $finalprice =$request->post('final_price');
                        $dicountPercentage =$request->post('discount_percentage');
                        $discountamount=$request->post('discount_amt');
                        if($is_variation == 1){
                         if($chain != '')  {
                            foreach($chain as $key => $val){
                                if($rope_id != '' && array_key_exists($key,$rope_id)){
                                // echo $val. '-'. $amount[$key]. '-'.$color[$key]. '</br>'. $rope_id[$key];die;
                                    $ropeChain = Rope_chain::where('id',$rope_id[$key])->update([         
                                    'name' =>$val,
                                    'blog_id' =>$id,
                                    'gold_color' =>$color[$key],
                                    'amount' =>$amount[$key],
                                    'discount_percentage'=>$dicountPercentage[$key],
                                    'discount_amt' =>$discountamount[$key],
                                    'final_price' =>$finalprice[$key]
                                    ]);
                                }else{
                                    $ropeChain = Rope_chain::create([         
                                        'name' =>$val,
                                        'blog_id' =>$id,
                                        'gold_color' =>$color[$key],
                                        'amount' =>$amount[$key],
                                        'discount_percentage'=>$dicountPercentage[$key],
                                        'discount_amt' =>$discountamount[$key],
                                        'final_price' =>$finalprice[$key],
                                        
                                    ]);
                                }
                            }
                         }else{
                            $amount = Blog::where('id', $id)->update([
                                'p_amt' => $request->p_amt
                            ]);
                        }
                        if($update_data){
                            return Redirect::to('/author/product')-> with('successmsg',Config::get('constants.UPDATE_SUCCESS'));
                        }else{
                            return Redirect::to('/author/product')-> with('errmsg',Config::get('constants.UPDATE_ERROR'))->withInput($request->all);
                        }
                }else{
                    return Redirect::to('/author/product/upate/'.$request->id)-> with('errmsg',"Already Exist This Product")->withInput($request->all);
                }
             }
            
       }
    }


   public function deleteChainrope(Request $request,$id){
       if($request ->method() == 'GET' || $id != ''){
           $data =Rope_chain ::find($id);
           $delete = $data->delete();
       }
    }


    public function delete(Request $request,$id){
        if($request ->method() == 'GET' || $id != ''){
            $data =Blog ::find($id);
            $delete = $data->delete();
            if($delete){
                return Redirect::to('/author/product')-> with('successmsg',Config::get('constants.DELETE_SUCCESS'));
            }else{
                return Redirect::to('/author/product')-> with('errmsg',Config::get('constants.DELETE_ERROR'));
            }
        }
    }

   public function getSubcategary(Request $request){
       if($request ->method() == 'GET'){
            $categary_id = $request->get('categary_id'); 
            $get_subCategary = Subcategary::where('categary_id',$categary_id)->get();
             $option = '<option value=" ">Select A Subcategary</option>';
             foreach($get_subCategary as $key => $item){
             $option = $option." "."<option value=".$item -> id." >".$item -> name."</option>";
             }

             echo $option;
           
       }
    }
}
