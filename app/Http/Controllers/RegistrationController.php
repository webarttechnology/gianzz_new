<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Models\Registration;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Config;
use Validator;
use Mail;
use Session;


class RegistrationController extends Controller
{
    public function registration(Request $request){
        if($request->method() == 'GET'){
            return view('registration');
        }else if($request->method() == 'POST'){
            $request->validate([
                'name' =>'required|string',
                'email_id'  =>'required|email',
                'password'  =>'required|min:8',
                'con_password' =>'required|min:8|same:password',
             ]);
             $duplicateEmailCheck = Registration::where('email_id',$request->email_id)->count();
             if($duplicateEmailCheck == 0){
                    $verificationCode = rand(100000,999999);
                    $emailTo =$request->email_id;
                    Mail::send('mail.verify-code', ['verification_code' => $verificationCode], function($message) use($emailTo){
                        $message->to($emailTo)->subject("Email Id Verification");
                    });
                    
                    $request->session()->put('verificationCode',$verificationCode );
                    $request->session()->put('userName',$request->name );
                    $request->session()->put('userEmail',$request->email_id );
                    $request->session()->put('userPassword',$request->password );
                    return redirect::to('/user-verification')->with('successmsg', "We have sent a verification code to your registered email id.");
                }else{
                    return Redirect::to('/registration')-> with('errmsg',"Email Id Already Register")->withInput($request->all);
                }
        }
    }

    public function userVerification(Request $request){
        if($request->method() == 'GET'){
            return view('user-verification');
        }else if($request->method() == 'POST'){
            $userVerifyCode =$request->post('verification_code');
          // echo $userVerifyCode;
            $VerifyCode = $request->session() ->get('verificationCode');
            //echo $VerifyCode;die;
            $name = $request->session() ->get('userName');
            $email = $request->session() ->get('userEmail');
            $password = $request->session() ->get('userPassword');
            $hashedpassword = Hash :: make($password);
            if($userVerifyCode == $VerifyCode){
                $registration = new Registration([
                    'name' =>$name,
                    'email_id' =>$email,
                    'password'=>$hashedpassword,
                ]);
                if($registration->save()){
                    Session::forget('userName');
                    Session::forget('userEmail');
                    Session::forget('userPassword');
                    Session::forget('verification_code');
                    return redirect::to('/login')-> with('successmsg', "Registration Successful! Thanks for join with us");
                }else{
                    return redirect::to('/registration')-> with('errmsg', "Registration not Successful!")->withInput($request->all());  
                }
            }else{
                return redirect::to('/user-verification')->with('errmsg', "Enter Wrong Verification Code");
            }
        }
    }

}
