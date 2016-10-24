<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sentinel;
use Activation;
use DB;
use URL;
use Reminder;
use App\Role;
use Config;
use Mail;
use App\Delivery_staff;
use Session;
use App\User;
use App\Shipper;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,ErrorException;
use \Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use \Cartalyst\Sentinel\Checkpoints\ThrottlingException;

class AdminController extends Controller
{
	/**
     * Account sign in.
     *
     * @return View
     */
	public function getLogin()
	{
		// Is the user logged in?
        if (Sentinel::check()) {           
            return redirect('admin/dashboard');
        }

        // Show the page
        return View('admin.login');
	}

	/**
     * Account sign in form processing.
     *
     * @return Redirect
     */
	public function postLogin(Request $request)
	{
        /*Check validation*/
        $validator = Validator::make($request->all(), [            
            'email'              => 'required',
            'password'           => 'required|min:6',                        
        ]);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            if ($request->route()->getPrefix() == "/admin") {
              return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            } 
            if($validator->errors()->has('email'))
                return response()->json($validator->errors()->first('email'), 400);
            if($validator->errors()->has('password'))
                return response()->json($validator->errors()->first('password'), 400);             
                         
        }

        $credentials = [
            'login'    => $request->email,
            'password' => $request->password,
        ];

        try {
            // Try to log the user in           
            if($user = Sentinel::authenticate($credentials))
            {   
                $user = User::with('roles')->whereid($user->id)->first();
                $staff = Delivery_staff::where('user_id',$user->id)->first();

                $user['staff']=$staff;

                return response()->json($user);
            }
            $message = 'Invalid Username or Password';

        } catch (NotActivatedException $e) {
	    $credentials = [
    		'login' => $request->email,
	    ];

	    $user = Sentinel::findByCredentials($credentials);
            return response()->json($user,403);
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $message = "Too many login attemps.Please try again in {$delay} second(s).";
        }

        
        // Redirect back to login page if prefix is admin 
        if ($request->route()->getPrefix() == "/admin") 
        {
            return redirect()->back()->withErrors(array('message'=>$message));
        }
        // Response json if prefix is api  
        return response()->json($message,400);
	}

    public function postSignin(Request $request)
    {
        /*Check validation*/
        $validator = Validator::make($request->all(), [            
            'email'              => 'required|email',
            'password'           => 'required|min:6',                        
        ]);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            if ($request->route()->getPrefix() == "/admin") {
              return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            } 
            if($validator->errors()->has('email'))
                return response()->json($validator->errors()->first('email'), 400);
            if($validator->errors()->has('password'))
                return response()->json($validator->errors()->first('password'), 400);             
                         
        }

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        try {
            $user = Sentinel::findByCredentials($credentials);
            if ($user == null) {
                 $message = 'Invalid Username or Password';
                 if ($request->route()->getPrefix() == "/admin") 
                 {
                    return redirect()->back()->withErrors(array('message'=>$message));               
                 }  
                 return response()->json($message);
             }
            
            if(Sentinel::authenticate($credentials))
            {                  
                // Redirect to the dashboard page if prefix is admin
                if ($request->route()->getPrefix() == "/admin") 
                {
                    return redirect('admin/dashboard');                    
                }                
                 // Response json if prefix is api
                return response()->json($user); 
            }
            $message = 'Invalid Username or Password';

        } catch (NotActivatedException $e) {
            $message = "Your account is not activate!";
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $message = "Too many login attemps.Please try again in {$delay} second(s).";

        }

        
        // Redirect back to login page if prefix is admin 
        if ($request->route()->getPrefix() == "/admin") 
        {
            return redirect()->back()->withErrors(array('message'=>$message));
        }
    }

	/**
     * Account register
     *
     * @return View
     */
    public function getRegister()
    {
    	return view('admin.register');
    }

    /**
     * Account register form processing.
     *
     * @return Redirect
     */
    public function postRegister(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name'               => 'required|unique:users,name',
            'email'              => 'required|email|max:255|unique:users,email',
            'password'           => 'required|min:6',            
            'phone'              => 'required|numeric|min:8',
             

        ]);

        if ($validator->fails()) {
            if($validator->errors()->has('name'))
                return response()->json($validator->errors()->first('name'), 400);
            if($validator->errors()->has('email'))
                return response()->json($validator->errors()->first('email'), 400);
            if($validator->errors()->has('password'))
                return response()->json($validator->errors()->first('password'), 400);             
            if($validator->errors()->has('phone'))
                return response()->json($validator->errors()->first('phone'), 400);
             
                         
        }
        // if ($file = $request->file('pic'))
        // {
        //     $fileName        = $file->getClientOriginalName();
        //     $extension       = $file->getClientOriginalExtension() ?: 'png';
        //     $folderName      = '/uploads/users/';
        //     $destinationPath = public_path() . $folderName;
        //     $safeName        = str_random(10).'.'.$extension;
        //     $file->move($destinationPath, $safeName);
        // }

         $credentials = [   
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
            'phone'     => $request->phone,
            
        ];

        $user = Sentinel::registerAndActivate($credentials,true);
        $role = Sentinel::findRoleById($request->role);
         
        if($role){
            $role->users()->attach($user);  
        }
         
        

        if ($request->route()->getPrefix() == "/admin") {
            return redirect('admin/dashboard'); 
        }  
        
        return response()->json($user);
    }

    public function getActivate($userId,$activationCode = null)
    {
        if ($activationCode == 0) {
           return response()->json("Sorry Your code is not match!",400);
        }
        else{
            $user = Sentinel::findById($userId);
            $activation = Activation::where('user_id',$user->id)->first();
            if ($activation == null) {
                if ($user->code == $activationCode) {
                    $activation = Activation::create($user);
                    if (Activation::complete($user, $activation->code))
                    {
                        return response()->json($user);
                    }
                    else
                    {
                        return response()->json("Activation not found or not completed",400);
                    }
                }
                else{
                    return response()->json("Sorry Your code is not match!",400);
                }
            }
            else{
                return response()->json("Your acoount is already Activated!",400);
            }
            
        }
               
    }

    public function getResend($phone)
    {

        $user = User::where('phone',$phone)->first();
         
        $activation = Activation::where('user_id',$user->id)->first();
        if ($activation == null) {
            $curl = curl_init("http://shopyface.com/api/v1/sms");
            curl_setopt( $curl, CURLOPT_POST , true);
            curl_setopt( $curl, CURLOPT_POSTFIELDS, array(
                'mobiles'      => $user->phone,
                'message'      => "Your Varification code is ".$user->code,
            ));
            curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
            $auth = curl_exec( $curl );

            $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if($http_status == 200){
                return response()->json('Resend your code. Please check your mobile phone!');
            }
            else{
                return response()->json('Sorry Something wrong!',400);
            }
        }
        else{
            return response()->json("Your account is already Activated!!");
        }
    }

    

    public function postForgotpassword(Request $request)
    {

        $validator = Validator::make($request->all(), [            
            'email'              => 'required|email|exists:users,email',
                                    
        ]);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            if ($request->route()->getPrefix() == "/admin") {
              return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            } 
            if($validator->errors()->has('email'))
                return response()->json($validator->errors()->first('email'), 400);             
                         
        }

        $credentials = [
            'email'    => $request->email,
        ];
        $user = Sentinel::findByCredentials($credentials);
        
        if($user)
        {
            //get reminder for user

            $reminder = Reminder::exists($user) ?: Reminder::create($user);

            // Data to be used on the email view
            $data = array(
                'user'              => $user,
                'forgotPasswordUrl' => URL::route('forgot-password-confirm',array($user->id, $reminder->code)),
            );

            // Send the activation code through email
            Mail::send('admin.emails.forgot-password', $data, function ($m) use ($user) {
                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                $m->subject('Account Password Recovery');
            });
        }
        else
        {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        return redirect(URL::previous() . '#toforgot')->with('success','Password recovery email successfully sent.');
        
    }

    public function apipostForgotpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'phone'              => 'required|min:8',
                                    
        ]);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {           
            if($validator->errors()->has('phone'))
                return response()->json($validator->errors()->first('phone'), 400);                                  
        }

        $credentials = [
            'phone'    => $request->phone,
        ];
        $user = Sentinel::findByCredentials($credentials);

        if($user)
        {
            $reminder = Reminder::exists($user) ?: Reminder::create($user);

            $curl = curl_init("http://shopyface.com/api/v1/sms");
            curl_setopt( $curl, CURLOPT_POST , true);
            curl_setopt( $curl, CURLOPT_POSTFIELDS, array(
                'mobiles'      => $request->phone,
                'message'      => "Your Varification code is ".$user->code,
            ));
            curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
            $auth = curl_exec( $curl );

            $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if($http_status == 200){
                return response()->json('Already send your code. Please check your mobile phone!');
            }
            else{
                return response()->json('Sorry Something wrong!',400);
            }
        }
        else
        {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }
        return response()->json('Sorry! Your phone number is not correct');
    }


    public function getForgotpasswordconfirm($userId,$passwordResetCode = null)
    {
        if(!$user = Sentinel::findById($userId))
        {
            // Redirect to the forgot password page
            return redirect()->route('forgot-password')->with('error','account_not_found');
        }
        return View('admin.forgot-password-confirm');
    }

    public function postForgotpasswordconfirm($userId,$passwordResetCode = null,Request $request)
    {

        $validator = Validator::make($request->all(), [            
            'password'           => 'required|between:6,32',
            'password_confirm' => 'required|same:password'
                                    
        ]);

        if ($validator->fails()) {
            return Redirect::route('forgot-password-confirm', $passwordResetCode)->withInput()->withErrors($validator);
        }

        $user = Sentinel::findById($userId);
        if(!$reminder = Reminder::complete($user, $passwordResetCode,$request->password))
        {
            return redirect()->route('login')->with('error', 'There was a problem while trying to reset your password, please try again.');
        }
        return redirect()->route('login')->with('success','Your password has been successfully reset.');
    }

    public function apiCodeconfirm(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'code'           => 'required|min:6',                                
        ]);
        if ($validator->fails()) {
            if($validator->errors()->has('code'))
                return response()->json($validator->errors()->first('code'), 400); 
        }
        $credentials = [
            'phone'    => $request->phone,
        ];
        $user = Sentinel::findByCredentials($credentials);
        if ($user && $user->code == $request->code) {
            return response()->json('Confirmation is Successful!');
        }
        else{
            return response()->json('Sorry! Your code is not correct');
        }
    }
    public function apiForgotpasswordConfirm(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'password'           => 'required|between:6,32',                  
        ]);
        if ($validator->fails()) {
            if($validator->errors()->has('password'))
                return response()->json($validator->errors()->first('password'), 400); 
        }

        $credentials = [
            'phone'    => $request->phone,
        ];
        $user = Sentinel::findByCredentials($credentials);
        $passwordResetCode = Reminder::where('user_id',$user->id)->where('completed',0)->value('code');

        if(!$reminder = Reminder::complete($user, $passwordResetCode,$request->password))
        {
            return response()->json('There was a problem while trying to reset your password, please try again.');
        }
        return response()->json('Successful!');
    }

    public function getLogout()
    {
        // Log the user out
        Sentinel::logout();
        return redirect('admin/login');
         
    }
}
