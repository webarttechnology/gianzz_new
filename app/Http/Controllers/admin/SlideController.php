<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Slide;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;

class SlideController extends Controller
{
    public function list(Request $request){
        if($request ->method() == 'GET'){
            $data = Slide:: all();
            return view('admin/slide/slide-List',['categary'=>$data,'title' =>"Home Slide"]);
        }
   }

   public function add(Request $request){
       if($request ->method() == 'GET'){
            return view('admin/slide/slide-add',['title' =>"Home Slide"]);
       }else if($request -> method() == "POST"){
           $request->validate([
               'title'  =>'required',
                'description' =>'required',
               'image' =>'required'

           ]);
           //print_r($request->post());die;
           $duplicateCategaryCheck = Slide::where('title',$request->title)->count();
           if($duplicateCategaryCheck == 0) {
             $slug = Str::slug($request->title, '-');
               $categary = new Slide([
                   'title' =>$request->title,
                   'details' =>$request->description,
                   'slug_name'=>$slug,
                   'image' =>1
               ]);
               $categary->save();

               $lastId = $categary->id;
               $file = $request->file('image');
               $name = $file->getClientOriginalName();
               $path = "uploads/";
               $file->move($path, $lastId."slide");

               $image_name = $path. $lastId."slide";
               $update_image = Slide::where('id', $lastId)->update([
                   'image' => $image_name
               ]);

               if($update_image){
                   return Redirect::to('/author/home-slide')-> with('successmsg',Config::get('constants.ADD_SUCCESS'))->withInput($request->all);
               }else{
                   return Redirect::to('/author/home-slide')-> with('errmsg',Config::get('constants.ADD_ERROR'))->withInput($request->all);
               }
           }else{
               return Redirect::to('/author/home-slide')-> with('errmsg',"Already Exist This Categary")->withInput($request->all);
           }
       }
  }

  public function update(Request $request , $id = ''){
      $cat_id = $id;      
       if($request ->method() == 'GET' || $id != '' ){
           $data = Slide ::where('id',$id)->first();
           //print_r($data);die;
           return view('admin/slide/slide-update',['categary' => $data,'title' =>"Home Slide"]);
       }else if ($request -> method() == "POST"){
           
           $request->validate([
            'title'  =>'required',
            'description' =>'required',
           ]);
           $duplicateCategaryCheck = Slide::where('title',$request->title)->where('id','!=',$request->id)->count();
           if($duplicateCategaryCheck == 0) {
                $slug = Str::slug($request->title, '-');
                //  echo $request->image;die; 
                if($request->hasFile('image')){  
                        
                    $get_file_name = Slide::where('id',$request->id)->select('image')->get();
                        // print_r($get_file_name);die;
                        foreach($get_file_name as $value){
                            @unlink($value->image);
                            }
                        $file = $request->file('image');
                        $name = $file->getClientOriginalName();
                        $path = "uploads/";
                        $file->move($path, $request->id."slide");
                        $image_name = $path.$request->id."slide";
                        // echo $image_name1;die;
                        $update_data = Slide::where('id',$request->id)->update([
                            'title' => $request->title,
                            'details' =>$request->description,
                            'slug_name' =>$slug,
                            'image'=>$image_name
                        ]);
                }else{

                    $update_data = Slide::where('id', $request->id)->update([
                        'title' =>$request->title,
                        'details' =>$request->details,
                        'slug_name'=>$slug,
                       
                    ]);

                }
               if($update_data){
                   return Redirect::to('/author/home-slide')-> with('successmsg',Config::get('constants.UPDATE_SUCCESS'))->withInput($request->all);
               }else{
                   return Redirect::to('/author/home-slide')-> with('errmsg',Config::get('constants.UPDATE_ERROR'))->withInput($request->all);
               }
            }else{
               return Redirect::to('/author/home-slide')-> with('errmsg',"Do Not Update,Already Exis Updated Categary")->withInput($request->all);
           }
       }
       
    }


   public function delete(Request $request,$id){
       if($request ->method() == 'GET' || $id != ''){
           $data =Slide ::find($id);
           $delete = $data->delete();
           if($delete){
               return Redirect::to('/author/home-slide')-> with('successmsg',Config::get('constants.DELETE_SUCCESS'))->withInput($request->all);
           }else{
               return Redirect::to('/author/home-slide')-> with('errmsg',Config::get('constants.DELETE_ERROR'))->withInput($request->all);
           }
       }
   }
}
