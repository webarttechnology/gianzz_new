<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Slide;
use App\Models\Registration;
use App\Models\Categary;
use App\Models\Blog;
use App\Models\Rope_chain;
use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;


class HomeController extends Controller
{
    
    public function index(Request $request){
        if($request -> method() == "GET"){
            $slider  = Slide::get();
            $categories = Categary::limit(4) -> get();
            $products = Blog::get()->random(8);
            return view("home", ['slider' => $slider, 'sliderCount' => Slide::count(), 'categories' => $categories, 'products' => $products]);
        }
    }

    public function login(Request $request){
        if($request -> method() == "GET"){
                return view('login');
        }else if($request->method() == 'POST'){
           
            $request->validate([
                'emailid'  =>'required|email',
                'password'  =>'required|min:8'
             ]);
             
             $loginData = Registration::where('email_id',$request->emailid)->first();
             if($loginData != ''){
                if(Hash :: check($request->password, $loginData->password)){ 
                    $request->session()->put('frontendloginStatus', true);
                    $request->session()->put('frontendloginID', $loginData['id']);
                    $request->session()->put('frontendemail', $loginData['email']);
                    $request->session()->put('frontendname', $loginData['name']);
                    $request->session()->put('frontendimage', $loginData['image']);
                    return redirect::to('/');

                }else{
                    return redirect::to('/login')->with('errmsg',Config::get('constants.PASSWORD_ERROR'))->withInput($request->all);
                }

             }else{
                return redirect::to('/login')->with('errmsg',Config::get('constants.EMAIL_ERROR'))->withInput($request->all);
             }
        }

    }

    public function logout(Request $request){
        Session::forget('frontendloginStatus');
        return redirect::to('/');
    }

    public function shop(Request $request){
        if($request -> method() == 'GET'){
            $categories = Categary::get();
            if($request -> get('cat') != ''){
                $catSlugName = $request -> get('cat');
                $categoriesDetails = Categary::where('slug_categary', $catSlugName) -> first();
                $categoryId = $categoriesDetails -> id;
                $products = Blog::where('categary_id', $categoryId)-> get();

                  $newArray = [];
                    foreach($products as $d){
                    
                      $newArray[] = [
                          'product'=> $d,
                          'rope' => Rope_chain::where('blog_id', $d-> id)-> get(),
                          'minprice' =>Rope_chain::select('final_price')->where('blog_id',$d->id)->min('final_price'),
                          'maxprice' =>Rope_chain::select('final_price')->where('blog_id',$d->id)->max('final_price'),
                          'discountPercentage' =>Rope_chain::select('discount_percentage')->where('blog_id',$d->id)->first()
                      ];
                    }

            }else{
                $products = Blog::get();
                $categoryId = $categories[0] -> id;

                $newArray = [];
                foreach($products as $d){
                
                  $newArray[] = [
                      'product'=> $d,
                      'rope' => Rope_chain::where('blog_id', $d-> id)-> get(),
                      'minprice' =>Rope_chain::select('final_price')->where('blog_id',$d->id)->min('final_price'),
                      'maxprice' =>Rope_chain::select('final_price')->where('blog_id',$d->id)->max('final_price'),
                      'discountPercentage' =>Rope_chain::select('discount_percentage')->where('blog_id',$d->id)->first()
                  ];
                }
            }

            // echo "<pre/>";
            // print_r($newArray[0]['product']->slug_name )."</br>" ;die;
            return view("shop", ['categories' => $categories, 'activeCategory'=> $categoryId, 'products' => $newArray]);
        }else{

        }
    }

    public function productDetails(Request $request,$id='') {
        if($request -> method() == 'POST'){

        }else if($request -> method() == 'GET' || $id != ''){
            //echo $request -> get('product');die;
            $productDetails = Blog::where('slug_name', $id) -> first();
            $rope =Rope_chain::where('blog_id',$productDetails->id)->get();
            $rope_chain =Rope_chain::where('blog_id',$productDetails->id)->first();
            $similarproduct =Blog::where('categary_id', $productDetails->categary_id)->limit(3) -> get();
            $productquantatity = 0;
            // echo "<pre/>";
            // print_r($productDetails);die;
            return view("product_details", ["productDetails" => $productDetails,'rope'=>$rope,'rope_chain'=>$rope_chain,'similarproduct'=>$similarproduct,'productquantatity'=>$productquantatity]);
        }
    }

    public function productprice(Request $request){
        if($request -> method() == 'GET'){
            $id = $request->get('id');
            $blog_id = $request->get('blog_id');
          //  echo $id . '-' .$color;
            $amount =Rope_chain::where(['id'=> $id,'blog_id'=>$blog_id])->first();
           // return print_r($amount);    
             return response()->json($amount, 200) ;
          
        }
    }
    
    public function addtocart(){
        return view('cart');
    }

    public function dashboard(Request $request){
        if($request->method() == 'GET'){     
            $user_id = $request->session() ->get('frontendloginID');
            $data = Registration::where('id',$user_id)->first();  

            $order =Order::where('registration_id',$user_id)->get();
            $invoice = Invoice::get();
            $blog = Blog::get();
            return view('my-account',['user' =>$data,'order'=>$order,'invoice' => $invoice, 'blog' => $blog,'countorder' =>count($order)]);
        }else if($request->method() == 'POST'){
            $request->validate([
                'name' =>'required|string',
                'email_id'  =>'required|email',
                'mobile_no' =>'required|numeric|min:10',
                'city' =>'required',
                'state' =>'required',
                'pincode' =>'required|numeric|min:6'
             ]);
             $user_id = $request->session() ->get('frontendloginID');
            $duplicateEmailCheck = Registration::where('email_id',$request->email_id)->where('id','!=',$user_id)->count();
            if($duplicateEmailCheck == 0){
              
                $registration =  Registration::where('id', $user_id)->update([
                    'name' =>$request->name,
                    'email_id'  =>$request->email_id,
                    'mobile_no' =>$request->mobile_no,
                    'city' =>$request->city,
                    'state' =>$request->state,
                    'pincode' =>$request->pincode
                ]);
                if($request->hasFile('image')){    
                   // echo "picture ok";die;             
                    $file = $request->file('image');
                    $name = $file->getClientOriginalName();
                    $path = "uploads/";
                    $file->move($path, $user_id.$name."image");

                    $image_name = $path.$user_id.$name."image";
                    $update_image = Registration::where('id',$user_id)->update([
                        'image'  =>$image_name,
                    ]);
                    
                }
                if($registration){
                    return Redirect::to('/my-account')-> with('successmsg',"Profile Updated Succesfully")->withInput($request->all);
                }else{
                    return Redirect::to('/my-account')-> with('errmsg',Config::get('constants.UPDATE_ERROR'))->withInput($request->all);
                }
            }else{
                return Redirect::to('/my-account')-> with('errmsg',"Email Id Already Register")->withInput($request->all);
            }
        }
    }



    public function passwordchange(Request $request){
        if($request->method() == 'GET'){  
            $user_id = $request->session() ->get('frontendloginID');
            $data = Registration::where('id',$user_id)->first();
            return view('change-password',['user' =>$data]);
        }else if($request->method() == 'POST'){
            $request->validate([
                'password' =>'required|min:8',
                'con_password'  =>'required|min:8|same:password',
               
             ]);
             $hashedpassword = Hash :: make($request->password);
             $user_id = $request->session() ->get('frontendloginID');
             $password_update =  Registration::where('id', $user_id)->update([
                'password' =>$hashedpassword,
            ]);
            if($password_update){
                return Redirect::to('/my-account')-> with('successmassage',"Password Update Succesfully")->withInput($request->all);
            }else{
                return Redirect::to('/my-account')-> with('errormsg',"Password Update Not Succesfull")->withInput($request->all);
            }
            
        }
    }


    public function profileedit(Request $request){
        if($request->method() == 'GET'){     
            $user_id = $request->session() ->get('frontendloginID');
            $data = Registration::where('id',$user_id)->first();  

            $order =Order::where('registration_id',$user_id)->get();
            $invoice = Invoice::get();
            $blog = Blog::get();
            return view('edit-profile',['user' =>$data,'order'=>$order,'invoice' => $invoice, 'blog' => $blog,'countorder' =>count($order)]);
        }else if($request->method() == 'POST'){
            $request->validate([
                'name' =>'required|string',
                'email_id'  =>'required|email',
                'mobile_no' =>'required|numeric|min:10',
                'city' =>'required',
                'state' =>'required',
                'pincode' =>'required|numeric|min:6'
             ]);
             $user_id = $request->session() ->get('frontendloginID');
            $duplicateEmailCheck = Registration::where('email_id',$request->email_id)->where('id','!=',$user_id)->count();
            if($duplicateEmailCheck == 0){
              
                $registration =  Registration::where('id', $user_id)->update([
                    'name' =>$request->name,
                    'email_id'  =>$request->email_id,
                    'mobile_no' =>$request->mobile_no,
                    'city' =>$request->city,
                    'state' =>$request->state,
                    'pincode' =>$request->pincode
                ]);
                if($request->hasFile('image')){    
                   // echo "picture ok";die;             
                    $file = $request->file('image');
                    $name = $file->getClientOriginalName();
                    $path = "uploads/";
                    $file->move($path, $user_id.$name."image");

                    $image_name = $path.$user_id.$name."image";
                    $update_image = Registration::where('id',$user_id)->update([
                        'image'  =>$image_name,
                    ]);
                    
                }
                if($registration){
                    return Redirect::to('/my-account')-> with('successmsg',"Profile Updated Succesfully")->withInput($request->all);
                }else{
                    return Redirect::to('/my-account')-> with('errmsg',Config::get('constants.UPDATE_ERROR'))->withInput($request->all);
                }
            }else{
                return Redirect::to('/my-account')-> with('errmsg',"Email Id Already Register")->withInput($request->all);
            }
        }

    }

}
