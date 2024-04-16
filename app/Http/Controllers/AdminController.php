<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use constGuards;
use constDefaults;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function loginHandler(Request $request){
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email'){
            $request->validate([
                'login_id'=>'required|email|exists:admins,email',
                'password'=>'required|min:5|max:45'
            ],[
                'login_id.required'=>'Email or Username is required',
                'login_id.email'=>'Invalid email address',
                'login_id.exists'=>'Email is not exists in system',
                'password.required'=>'Password is required'
            ]);
        }
        else{
            $request->validate([
                'login_id'=>'required|exists:admins,username',
                'password'=>'required|min:5|max:45'
            ],[
                'login_id.required'=>'Email or Username is required',
                'login_id.exists'=>'Username is not exists in system',
                'password.required'=>'Password is required'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password
        );
        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.home');
        }
        else{
            session()->flash('fail', 'Incorrect credentials');
            return redirect()->route('admin.login');
        }
    }
    public function logoutHandler(Request $request){
        Auth::guard('admin')->logout();
        session()->flash('fail','You are logged out!');
        return redirect()->route('admin.login');
    }
    public function sendPasswordResetLink(Request $request){
        $request->validate([
            'email'=>'required|email|Exists:admins,email'
        ],[
            'email.required'=>'The arrtibute is required',
            'email.email'=>'Invalid email address',
            'email.exists'=>'The attribute is not exists in system'
        ]);
        // get admin details 
        $admin = Admin::where('email',$request->email)->first();

        // general token 
        $token = base64_encode(Str::random(64));

        // Check if there is on existing reset password token 
        $oldToken = DB::table('password_reset_tokens')
                        ->where(['email'=>$request->email,'guard'=>constGuards::ADMIN])
                        ->first();
        if($oldToken){
            // update token 
            DB::table('password_reset_tokens')
                ->where(['email'=>$request->email,'guard'=>constGuards::ADMIN])
                ->update([
                    'token'=>$token,
                    'created_at'=>Carbon::now()
            ]);
        }
        else{
            DB::table('password_reset_tokens')->insert([
                'email'=>$request->email,
                'guard'=>constGuards::ADMIN,
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);
        }
        $actionLink = route('admin.reset-password',['token'=>$token,'email'=>$request->email]);
        $data = array(
            'actionLink'=>$actionLink,
            'admin'=>$admin 
        );
        $mail_body = view('email-templates.admin-forgot-email-template',$data)->render();

        $mailConfig = array(
            'mail_from_email'=>env('EMAIL_FROM_ADDRESS'),
            'mail_from_name'=>env('NAME_FROM_ADDRESS'),
            'mail_recipient_email'=>$admin->email,
            'mail_recipient_name'=>$admin->name,
            'mail_subject'=>'Reset password',
            'mail_body'=>$mail_body
        );

        if(sendEmail($mailConfig)){
            session()->flash('success','We have e-mailed your password reset link');
            return redirect()->route('admin.forgot-password');
        }
        else{
            session()->flash('fail','Something went worng!');
            return redirect()->route('admin.forgot-password');
        }
    }
}


