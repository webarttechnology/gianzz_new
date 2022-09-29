<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Discount;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;
use DB;


class DiscountController extends Controller
{
    public function list(Request $request){
        if($request ->method() == 'GET'){         
            $discount =Discount::all();
            return view('admin/discount/discountList', ['title' =>"Discount",'discount'=>$discount]);
        }
    }

   public function add(Request $request){
       if($request ->method() == 'GET'){
            return view('admin/discount/discountadd', ['title' =>"Discount"]);
       }else if($request -> method() == "POST"){
            $request->validate([
                'name'  =>'required',
                'amount'  =>'required',
                'start_date' =>'required',
                'end_date' =>'required'
            ]);
            $duplicateSubCategaryCheck = Discount::where('name',$request->name)->count();
            if($duplicateSubCategaryCheck == 0) {            
                $discount = new Discount([
                    'name' =>$request->name,
                    'amount' =>$request->amount,
                    'start_date'=>$request->start_date,
                    'end_date' =>$request->end_date,
                    'is_active'=>$request->is_active
                ]);

                if($discount->save()){
                    return Redirect::to('/author/product-discount')-> with('successmsg',Config::get('constants.ADD_SUCCESS'))->withInput($request->all);
                }else{
                    return Redirect::to('/author/product-discount')-> with('errmsg',Config::get('constants.ADD_ERROR'))->withInput($request->all);
                }
            }else{
                return Redirect::to('/author/product-discount/add')-> with('errmsg',"Already Exist This Discount Category")->withInput($request->all);
            }
       }
   }


  public function update(Request $request ,$id =''){
        if($request ->method() == 'GET' || $id != ''){
                $data = Discount::find($id);
                return view('admin/discount/discountEdit',['discount' => $data,'title' =>"Discount"]);
        }else if($request -> method() == "POST"){
            $request->validate([
                'name'  =>'required',
                'amount'  =>'required',
                'start_date' =>'required',
                'end_date' =>'required'
            ]);
            $duplicatenameCheck = Discount::where('name',$request->name)->where('id','!=',$request->id)->count();
            if($duplicatenameCheck == 0){
                    $update_data = Discount::where('id', $request->id)->update([
                        'name' =>$request->name,
                        'amount' =>$request->amount,
                        'start_date'=>$request->start_date,
                        'end_date' =>$request->end_date,
                        'is_active'=>$request->is_active
                    ]);

                    if($update_data){
                        return Redirect::to('/author/product-discount')-> with('successmsg',Config::get('constants.UPDATE_SUCCESS'))->withInput($request->all);
                    }else{
                        return Redirect::to('/author/product-discount')-> with('errmsg',Config::get('constants.UPDATE_ERROR'))->withInput($request->all);
                    }
                }else{
                    return Redirect::to('/author/product-discount/upate/'.$request->id)-> with('errmsg',"Already Exist This Discount Category")->withInput($request->all);
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
