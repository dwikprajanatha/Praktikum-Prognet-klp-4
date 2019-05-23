<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Mail;
use Auth;
use DB;

use App\User;
use App\verifyUser;
use App\PasswordReset;


use App\Mail\VerifyMail;
use App\Mail\ResetPasswordMail;


class AuthController extends Controller
{
    /**
     * Show Login and Register Form
     */
    public function showLoginForm()
    {
        return view('user.auth.loginRegister');
    }

    
    /**
     * Login User
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|max:100',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator)->withInput($request->only('email'));
        }
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            //check verification email

            $user = User::find(Auth::id());

            if($user->status == 'pending'){
                
                return redirect()->route('email.verification.show');

            } else {
                return redirect()->route('home');
            }

        } else {
            
            return redirect()->back()->with('error',"Email and Password didn't match");

        }

    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        
        return redirect()->route('home');
    }


    /**
     * Register User
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);

        }

        DB::transaction(function() use($request){

            // default pic
            $pic_default = public_path('/images/default.jpg');

            // create user
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->profile_image = $pic_default;
            $user->save();

            // generate token
            $verify = new verifyUser;
            $verify->user_id = $user->id;
            $verify->token = sha1(time());
            $verify->save();

            // send email to user email with token url
            Mail::to($user->email)->send(new VerifyMail($user,$verify->token));

            // auto login after registration
            Auth::login($user);

        });

        return redirect()->route('home');

    }


    /**
     * Verify user email
     */
    public function verify($token)
    {
        //check token exists or not
        $user_id = verifyUser::select('user_id')->where('token',$token)->first();

        if(is_null($user_id)){

            return redirect()->route('show.login')->with('error','Verify Token not found');

        }

        //find user data
        $user = User::find($user_id->user_id);

        if(is_null($user)){

            return redirect()->route('show.login')->with('error','No User Found');

        }

        //update user field
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->status = 'Aktif';

        $user->save();

        return redirect()->route('home');

    }

    /**
     * Resend Token
     */
    public function resendToken()
    {
        $user = User::find(Auth::id());
        $token = verifyUser::select('token')->where('user_id',$user->id)->first();
        Mail::to($user->email)->send(new VerifyMail($user,$token->token));

        return redirect()->back()->with('success','Verification Email has been sent to your email');
    }
    
    /**
     * Show the notification Email Verification
     */
    public function showVerifiyNotice()
    {
        return view('user.auth.verify');
    }


    /**
     * Show Reset Password Form
     */
    public function showResetPassword()
    {
        return view('user.auth.passwords.email');
    }

    /**
     * Send Reset Password Token to Email
     */
    public function sendResetPasswordToken(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:100',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $user = User::where('email',$request->email)->first();

        if(is_null($user)){
            return redirect()->back()->with('errors','No User Found!');
        }

        $reset = new PasswordReset;
        $reset->user_id = $user->id;
        $reset->email = $request->email;
        $reset->token = sha1(time());
        $reset->save();

        Mail::to($request->email)->send(new ResetPasswordMail($user,$reset->token));

        return redirect()->back()->with('status','Password Reset Token has been sent to your email');
    }


    /**
     * Verify Token Reset Password and Show Reset Password Form
     */
    public function showResetPasswordForm($token)
    {
        $user_id = PasswordReset::select('user_id')->where('token',$token)->first();

        //Check if token is exists
        if(is_null($user_id)){
            return redirect()->route('show.reset.password')->with('errors','No Token Found');
        }

        //find user
        $user = User::find($user_id->user_id);

        if(is_null($user)){
            return redirect()->route('show.reset.password')->with('errors','No User Found');
        }

        return view('user.auth.passwords.reset')->with(['token' => $token, 'email' => $user->email]);

    }

    /**
     * Update Password
     */
    public function resetPassword(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:100',
            'password' => 'required|min:8|confirmed',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $user_id = User::select('id')->where('email', $request->email)->first();

        //Check User
        if(is_null($user_id)){
            return redirect()->route('show.reset.password')->with('errors','No User Found');
        }

        $token = PasswordReset::select('token')->where('email', $request->email)->first();

        //Check Token
        if($request->token != $token->token){
            return redirect()->route('show.reset.password')->with('errors','No Token');
        }

        $user = User::find($user_id->id);
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        return redirect()->route('home');

    }

    
}
