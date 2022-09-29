<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\Categary;
use App\Models\Subcategary;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;


class SubCategoryController extends Controller
{
    public function list(Request $request){
        if($request ->method() == 'GET'){
            $data = Subcategary::get();
            $categary = Categary::get();
            return view('admin/subcategary/subcategoryList', ['sub_categary' => $data , 'categary' => $categary, 'title' =>"Sub-Category"]);
        }
    }

   public function add(Request $request){
       if($request ->method() == 'GET'){
       }else if($request -> method() == "POST"){
            $request->validate([
                'categary_id'  =>'required',
                'name'  =>'required',
                'is_active' =>'required'
            ]);

            $duplicateSubCategaryCheck = Subcategary::where('name',$request->name)->count();
            if($duplicateSubCategaryCheck == 0) {    
                $slug = str::slug($request->name);           
                $Subcategary = new Subcategary([
                    'name' =>$request->name,
                    'categary_id' =>$request->categary_id,
                    'slug_subcategory'=>$slug,
                    'is_active' =>$request->is_active
                ]);

                if($Subcategary->save()){
                    return Redirect::to('/author/subcategory')-> with('successmsg',Config::get('constants.ADD_SUCCESS'))->withInput($request->all);
                }else{
                    return Redirect::to('/author/subcategory')-> with('errmsg',Config::get('constants.ADD_ERROR'))->withInput($request->all);
                }
            }else{
                return Redirect::to('/author/subcategory')-> with('errmsg',"Already Exist This Sub-Category")->withInput($request->all);
            }
       }
   }


  public function update(Request $request ,$id =''){
        if($request ->method() == 'GET' || $id != ''){
                $data = Subcategary ::find($id);
                $categary = Categary::get();
                return view('admin/subcategary/update-subcategary',['subcategary' => $data,'categary' => $categary,'title' =>"Sub-Category"]);
        }else if($request -> method() == "POST"){
                $request->validate([
                    'name'  =>'required',
                    'categary_id'  =>'required',
                    'is_active' =>'required'
                ]);
                $duplicateSubCategaryCheck = Subcategary::where('name',$request->name)->where('id','!=',$request->id)->count();
                if($duplicateSubCategaryCheck == 0){
                    $slug = str::slug($request->name); 
                    $update_data = Subcategary::where('id', $request->id)->update([
                        'name' => $request->name,
                        'categary_id' => $request->categary_id,
                        'slug_subcategory'=>$slug,
                        'is_active' =>$request->is_active
                    ]);

                    if($update_data){
                        return Redirect::to('/author/subcategory')-> with('successmsg',Config::get('constants.UPDATE_SUCCESS'))->withInput($request->all);
                    }else{
                        return Redirect::to('/author/subcategory')-> with('errmsg',Config::get('constants.UPDATE_ERROR'))->withInput($request->all);
                    }
                }else{
                    return Redirect::to('/author/subcategory')-> with('errmsg',"Do not Update,Already Exist Sub Categary");
                }

        }
    }



   public function delete(Request $request,$id){
       if($request ->method() == 'GET' || $id != ''){
           $data =Subcategary ::find($id);
           $delete = $data->delete();
           if($delete){
                return Redirect::to('/author/subcategory')-> with('successmsg',Config::get('constants.DELETE_SUCCESS'));
           }else{
                return Redirect::to('/author/subcategory')-> with('errmsg',Config::get('constants.DELETE_ERROR'));
           }
        }

    }
}
