<?php

namespace App\Http\Controllers;

use App\Mail\UserVerificationMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //Login
    public function login(){
        return view('auth.login');
    }

    public function loginSubmit(Request $request){
        $validatedData = $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:8'
        ]);

        try{
            $user = User::where('email',$validatedData['email'])->first();

            if(!Hash::check($validatedData['password'],$user->password)){
                return redirect()->back()->with('error','Invalid credentials. Please try again.');
            }
            
            if(!$user->email_verified_at){
                if(!$user->email_verification_token){
                    $user->update([
                        'email_verification_token' =>Str::random(64)
                    ]);
                    Mail::to($user->email)->send(new UserVerificationMail($user));
                }
                return redirect()->back()->with('error','Your email is not verified. Please check your inbox.');
            }
           if(Auth::attempt($validatedData)){
                $request->session()->regenerate();
                return redirect()->route('home')->with('success','Successfully Logged In!!!');
           }

        }catch(Exception $e){
            Log::channel('login')->error($e->getMessage());
            return redirect()->back()->with('error','Fail to Login');
        }
    }

    //Register
    public function register(){
        return view('auth.register');
    }

    public function registerSubmit(Request $request){
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
        ]);

        try{
            $validatedData['email_verification_token'] = Str::random(64);

            $user = User::create($validatedData);

            //Send Email Verify Mail
            Mail::to($user->email)->send(new UserVerificationMail($user));

            return redirect()->route('login')->with('success','Successfully Register New User');
        }catch(Exception $e){
            Log::channel('register')->error($e->getMessage());
            return redirect()->back()->with('error','Fail to Register New User');
        }
    }

    //Logout
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success','You have been logged out successfully!!!');
    }
}
