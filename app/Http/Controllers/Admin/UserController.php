<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Sentinel;
use App\Role;
use App\Shipper;
use App\Delivery_staff;
use App\Delivery_company;
use Validator,ErrorException;
use \Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use \Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = Sentinel::getUserRepository()->with('roles','activations')->orderBy('created_at', 'desc')->paginate(10);
         
         if ($request->route()->getPrefix() == "/admin") {            
             return view('admin.user.index', compact('users'));
        }  
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        $roles = Role::all();
        return view('admin.user.create',compact("companies","roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required|unique:users,name',
            'email'              => 'required|email|max:255|unique:users,email',
            'password'           => 'required|min:6',
            'phone'              => 'required|numeric|min:8',
            'role'               => 'required',
             
             
        ]);

        if ($validator->fails()) {
            if ($request->route()->getPrefix() == "/admin") {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
            if($validator->errors()->has('name'))
                return response()->json($validator->errors()->first('name'), 400);
            if($validator->errors()->has('email'))
                return response()->json($validator->errors()->first('email'), 400);
            if($validator->errors()->has('password'))
                return response()->json($validator->errors()->first('password'), 400);
            if($validator->errors()->has('role'))
                return response()->json($validator->errors()->first('role'), 400);
            if($validator->errors()->has('phone'))
                return response()->json($validator->errors()->first('phone'), 400);
             
                        
        }
        
        
         
        $credentials = [   
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
            'phone'     => $request->phone,
            'photo'     => $request->photo,
             
        ];

        $user = Sentinel::registerAndActivate($credentials,true);
        $role = Sentinel::findRoleById($request->role);
         
        if($role){
            $role->users()->attach($user);  
        }
         
        return redirect()->route('admin.user.index');
         

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'email'             => 'required|email',
            'old_password'      => 'required',
            'phone'             => 'required',                          
        ]);

        if ($validator->fails()) {
            if ($request->route()->getPrefix() == "/admin") {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            } 
            if($validator->errors()->has('name'))
                return response()->json($validator->errors()->first('name'), 400);
            if($validator->errors()->has('email'))
                return response()->json($validator->errors()->first('email'), 400);
            if($validator->errors()->has('old_password'))
                return response()->json($validator->errors()->first('old-password'), 400); 
            if($validator->errors()->has('phone'))
                return response()->json($validator->errors()->first('phone'), 400);                              
        }
        
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->old_password,
        ];
        if (Sentinel::authenticate($credentials)) {
            $user = Sentinel::findById($id);
             
            Sentinel::update($user, array(
                'name'     => $request->name,
                'password' => $request->new_password ? $request->new_password : $request->old_password,
                'phone'    => $request->phone,
                'photo'    => $request->photo,
            ));
	    $user = User::with('roles')->whereid($user->id)->first();
             
            return response()->json($user);
        }else{
            return response()->json('Sorry! Invalid Email or Password',400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Sentinel::findById($id);
        $user->delete();
    }
}
