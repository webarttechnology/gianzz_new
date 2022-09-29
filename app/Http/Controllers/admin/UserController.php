<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Company;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;

class UserController extends Controller
{
    public function login(Request $request){
        if($request->method() == 'GET'){
            return view('admin.login');
        }else if($request->method() == 'POST'){
            $request->validate([
                'email_id'  =>'required|email',
                'password'  =>'required|min:8'
             ]);
            $loginData = Admin::where('email',$request->email_id)->first();
            $company =Company::where(['is_active' => 1])->first();
           // print_r($company);die;
           
            if($loginData != ''){
                if(Hash :: check($request->password, $loginData->pwd)){
                    $request->session()->put('loginStatus', true);
                    $request->session()->put('loginID', $loginData['id']);
                    $request->session()->put('email', $loginData['email']);
                    $request->session()->put('name', $loginData['name']);
                    $request->session()->put('image', $loginData['image']);
                    $request->session()->put('company_logo', $company['logo']);
                    $request->session()->put('company_name', $company['name']);
                    $request->session()->put('company_address', $company['address']);
                    $request->session()->put('company_mobileno', $company['mobile_no']);
                    $request->session()->put('company_email', $company['email_id']);
                    return redirect::to('author/dashboard');
                }else{
                    return redirect::to('/author')->with('errmsg',Config::get('constants.PASSWORD_ERROR'))->withInput($request->all);
                }
            }else{
                return redirect::to('/author')->with('errmsg',Config::get('constants.EMAIL_ERROR'))->withInput($request->all);
            }
        }
        
    }

    public function logout(){
        Session::forget('loginStatus');
        return redirect::to('/author');
    }

    public function dashboard(Request $request){
        return view('admin/dashboard');
    }


    public function forgotPasseord(Request $request){
        return view('admin.forgot-password');
    }

    public function sendVerificationCode(Request $request){
      $emailTo =$request->post('email');
      if(Admin::where(['email' => $emailTo]) -> count() > 0){
            $adminData = Admin::where(['email' => $emailTo]) -> first(); 
            $admin_id = Admin::find($adminData -> id);
            $verificationCode = rand(1000,9999);
            $update_verification_code = Admin::where('id',$adminData -> id)->update([
                'verification_code' => $verificationCode
           ]);
            if($update_verification_code){
               Mail::send('mail.verify-code', ['verification_code' => $verificationCode], function($message) use($emailTo){
                    $message->to($emailTo)->subject("Request For Forgot Password");
                });
                
                $request->session()->put('forgotPasswordId',$adminData -> id );  // Session for forgot password
                return redirect::to('/author/verify-record')->with('successmsg', "We have send a verification code to your Email ID.");
            }else{
                return redirect::to('/author/forgot')-> with('errmsg', "You entered unregistered Email ID");
            }
        }else{
        return redirect::to('/author/forgot')-> with('errmsg', "You entered unregistered Email ID");
      }

    }

    public function Check_verification_code(Request $request){
        $user_code =$request->post('verification_code');
        $VerifyMail_id = $request->session() ->get('forgotPasswordId');
        $mail_id = Admin::find($VerifyMail_id);
        if($user_code == $mail_id->verification_code){
            return redirect::to('/author/reset-password')-> with('successmsg', "Verification Succesful"); 
        }
        else{
            return redirect::to('/author/verify-record')-> with('errmsg', "You entered Code Not Match");
        }

    }


    public function Verify_record(Request $request){
        return view('admin.verify-record');
    }

    public function reset_password(){
        return view('admin.reset-password');
    }

    public function reset_emailPassword(Request $request){
        $VerifyMail_id = $request->session() ->get('forgotPasswordId');
         // print_r($request->post());die;
            $request -> validate([
                'pwd' =>'required|min:8',
                'confirm_pwd' =>'required|min:8|same:pwd',
            ]);
            $hashedpassword = Hash :: make($request -> pwd);
            $update = Admin::where('id', $VerifyMail_id)->update([
                    'email' => $request->email,
                    'pwd' => $hashedpassword
            ]);
        
       if($update){
        return redirect::to('/author')-> with('successmsg', "Password Reset Succesfully");
       }else{
        return redirect::to('/author/reset-password')-> with('errmsg', "Email Id and Password Not Reset")->withInput($request->all());  
       }
    }


    public function passwordChange(Request $request){
        if($request->method() == 'GET'){
            return view('admin.changePassword');
        }else if($request->method() == 'POST'){
            $loginId = $request->session() ->get('loginID');
           // echo $loginId;die;
            $getalldata = Admin::where('id',$loginId)->first();
           // print_r($getalldata->pwd);die;
            if(Hash :: check($request->old_password, $getalldata->pwd)){
                $request -> validate([
                    'old_password' =>'required|min:8',
                    'pwd' =>'required|min:8|same:pwd',
                    'con_password' =>'required|min:8|same:pwd',
                ]);
                $hashedpassword = Hash :: make($request -> pwd);
                $update = Admin::where('id', $loginId)->update([
                    'pwd' => $hashedpassword
                ]);
                if($update){
                    return redirect::to('/author/password-change')-> with('successmsg', "Password Change Succesfully");
                }else{
                    return redirect::to('/author/password-change')-> with('errmsg', "Email Id and Password Not Reset");  
                }
            }else{
                return redirect::to('/author/password-change')-> with('errmsg', "Your Old Password Does not match");  
            }
        }

    }

}
