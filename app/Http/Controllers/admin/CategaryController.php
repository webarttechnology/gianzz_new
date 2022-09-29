<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Categary;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;

class CategaryController extends Controller
{
    public function list(Request $request){
        if($request ->method() == 'GET'){
            $data = Categary:: all();
            return view('admin/categary/categoryList',['categary'=>$data,'title' =>"Category"]);
        }
   }

   public function add(Request $request){
       if($request ->method() == 'GET'){
       }else if($request -> method() == "POST"){
           $request->validate([
               'name'  =>'required',
               'image' =>'required'
           ]);
           $duplicateCategaryCheck = Categary::where('name',$request->name)->count();
           if($duplicateCategaryCheck == 0) {
             $slug = Str::slug($request->name, '-');
               $categary = new Categary([
                   'name' =>$request->name,
                   'slug_categary' =>$slug,
                   'image' =>1
               ]);
               $categary->save();

               $lastId = $categary->id;
               $file = $request->file('image');
               $name = $file->getClientOriginalName();
               $path = "uploads/";
               $file->move($path, $lastId.$slug);

               $image_name = $path. $lastId.$slug;
               $update_image = Categary::where('id', $lastId)->update([
                   'image' => $image_name
               ]);

               if($update_image){
                   return Redirect::to('/author/category')-> with('successmsg',Config::get('constants.ADD_SUCCESS'))->withInput($request->all);
               }else{
                   return Redirect::to('/author/category')-> with('errmsg',Config::get('constants.ADD_ERROR'))->withInput($request->all);
               }
           }else{
               return Redirect::to('/author/category')-> with('errmsg',"Already Exist This Categary")->withInput($request->all);
           }
       }
  }

  public function update(Request $request , $id = ''){
      $cat_id = $id;      
       if($request ->method() == 'GET' || $id != '' ){
           $data = Categary ::find($id);
           return view('admin/categary/update-categary',['categary' => $data,'title' =>"Category"]);
       }else if ($request -> method() == "POST"){
           
           $request->validate([
               'name'  =>'required',
              // 'is_active' =>'required',
           ]);
           $duplicateCategaryCheck = Categary::where('name',$request->name)->where('id','!=',$request->id)->count();
           if($duplicateCategaryCheck == 0) {
                $slug = Str::slug($request->name, '-');
                //  echo $request->image;die; 
                if($request->hasFile('image')){  
                                  
                    $get_file_name = Categary::where('id',$request->id)->select('image')->get();
                        // print_r($get_file_name);die;
                        foreach($get_file_name as $value){
                            @unlink($value->image);
                            }
                        $file = $request->file('image');
                        $name = $file->getClientOriginalName();
                        $path = "uploads/";
                        $file->move($path, $request->id.$slug);
                        $image_name = $path.$request->id.$slug;
                        // echo $image_name1;die;
                        $update_data = Categary::where('id',$request->id)->update([
                            'name' => $request->name,
                            'slug_categary' =>$slug,
                            'image'=>$image_name
                        ]);
                }else{

                    $update_data = Categary::where('id', $request->id)->update([
                        'name' => $request->name,
                        'slug_categary' =>$slug,
                    // 'is_active' =>$request->is_active
                    ]);

                }
               if($update_data){
                   return Redirect::to('/author/category')-> with('successmsg',Config::get('constants.UPDATE_SUCCESS'))->withInput($request->all);
               }else{
                   return Redirect::to('/author/category')-> with('errmsg',Config::get('constants.UPDATE_ERROR'))->withInput($request->all);
               }
            }else{
               return Redirect::to('/author/category')-> with('errmsg',"Do Not Update,Already Exis Updated Categary")->withInput($request->all);
           }
       }
       
    }


   public function delete(Request $request,$id){
       if($request ->method() == 'GET' || $id != ''){
           $data =Categary ::find($id);
           $delete = $data->delete();
           if($delete){
               return Redirect::to('/author/category')-> with('successmsg',Config::get('constants.DELETE_SUCCESS'))->withInput($request->all);
           }else{
               return Redirect::to('/author/category')-> with('errmsg',Config::get('constants.DELETE_ERROR'))->withInput($request->all);
           }
       }
   }
}
