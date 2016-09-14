<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Role;
use Validator,ErrorException;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(10);
        //return response()->json($roles);
        return view('admin.role.index',compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
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
            'name'              => 'required|unique:roles,name',
            'slug'              => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->route()->getPrefix() == "/admin") {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
            if($validator->errors()->has('name'))
                return response()->json($validator->errors()->first('name'), 400);
            if($validator->errors()->has('slug'))
                return response()->json($validator->errors()->first('slug'), 400);           
        }

        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();

        return redirect()->route('admin.role.index');
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
        $role = Role::find($id);
        return view('admin.role.edit',compact("role"));
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
        $validator = Validator::make($request->all(),[
            'name'  => 'required|unique:roles,name,$id',
            'slug'  => 'required',
        ]);
        if ($validator->fails()) {
            if ($request->route()->getPrefix() == "/admin") {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
            if($validator->errors()->has('name'))
                return response()->json($validator->errors()->first('name'), 400);
            if($validator->errors()->has('slug'))
                return response()->json($validator->errors()->first('slug'), 400);           
        }

        $role = Role::find($id);
        $role->name = $request->name;
        $role->slug = $request->slug;

        $role->update();
        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
    }
}
