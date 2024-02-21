<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Helper;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }
    public function check_admin(Request $request)
    {        
        try{
			$validator = Validator::make($request->all(),[
					'email' => 'required|email',
					'password' => 'required',
				],  [ 
					'email.required' => trans('messages.enter_email'),
					'email.email' => trans('messages.valid_email'),
					'password.required' => trans('messages.enter_password')
				]);
			if ($validator->fails()) {
			
				return redirect()->back()->withErrors($validator)->withInput();
				
			}else{
				
				if (Auth::attempt($request->only('email', 'password'))) 
				{
					if(Auth::user()->type==1 || Auth::user()->type==2) { 

						return redirect()->route('dashboard');

					} else{
						Auth::logout();
						return redirect()->back()->with('error',trans('messages.email_pass_invalid'));
					}
				}else{
					return redirect()->back()->with('error',trans('messages.email_pass_invalid'));
				}
			}
        }catch(Exception $exception){
            return back()->withError($exception->getMessage())->withInput();    
        }
    }
    public function logout() {
        Auth::logout();
        session()->flush();
        return redirect()->route('home');
    }

    public function systemverification(Request $request)
    {
		return Redirect::to('/admin')->with('success', 'You have successfully verified your License. Please try to Login now. Nulled by Nullcave.club');
    }

    public function forgotpassword() {
        return view('admin.auth.forgot-password');
    }

    public function new_password(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ],  [
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $checkadmin = User::where('email', $request->email)->where('type', 2)->first();
            if (!empty($checkadmin)) {
                $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
                $pass = Helper::send_pass($checkadmin->email, $checkadmin->name, $password, $checkadmin->id);
                if ($pass == 1) {
                    $checkadmin->password = Hash::make($password);
                    $checkadmin->save();
                    return redirect('admin')->with('success', trans('messages.password_sent'));
                } else {
                    return redirect()->back()->with('error', trans('messages.email_error'));
                }
            } else {
                return redirect()->back()->with('error', trans('messages.invalid_email'));
            }
        }
    }
}
