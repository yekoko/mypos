<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Company;
use App\Industry;
use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate();
        return view('admin.companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industries = Industry::all();
        return view('admin.companies.create',compact('industries'));
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
            'name'              => 'required|unique:companies,name',
            'address'           => 'required',
            'website_link'      => 'required',
            'industry'          => 'required',
            'company_size'      => 'required',
            'registration_no'   => 'required',
            'phone'             => 'required',
            'working_hour'      => 'required',
            'overview'          => 'required'
        ]);

        if ($validator->fails()) {
            if ($request->route()->getPrefix() == "/admin") {
              return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            } 
            if($validator->errors()->has('name'))
                return response()->json($validator->errors()->first('name'), 400);
            if($validator->errors()->has('registration_no'))
                return response()->json($validator->errors()->first('registration_no'), 400);
            if($validator->errors()->has('industry'))
                return response()->json($validator->errors()->first('industry'), 400);
            if($validator->errors()->has('address'))
                return response()->json($validator->errors()->first('address'), 400);
            if($validator->errors()->has('company_size'))
                return response()->json($validator->errors()->first('company_size'), 400);
            if($validator->errors()->has('phone'))
                return response()->json($validator->errors()->first('phone'), 400);  
            if($validator->errors()->has('working_hour'))
                return response()->json($validator->errors()->first('working_hour'), 400); 
            if($validator->errors()->has('website_link'))
                return response()->json($validator->errors()->first('website_link'), 400); 
            if($validator->errors()->has('overview'))
                return response()->json($validator->errors()->first('overview'), 400);             
        }

        $company = new Company;

        if ($file = $request->file('pic'))
        {
            $fileName        = $file->getClientOriginalName();
            $extension       = $file->getClientOriginalExtension() ?: 'png';
            $folderName      = '/uploads/logos/';
            $destinationPath = public_path() . $folderName;
            $safeName        = str_random(10).'.'.$extension;
            $file->move($destinationPath, $safeName);
        }
        $company->user_id = 1;
        $company->name    = $request->name;
        $company->address = $request->address;
        $company->phone   = $request->phone;
        $company->company_size = $request->company_size;
        $company->image        = isset($safeName)?$safeName:'';
        $company->registration_no = $request->registration_no;
        $company->website = $request->website_link;
        $company->working_hours = $request->working_hour;
        $company->industry_id = $request->industry;
        $company->overview = $request->overview;
        $company->save();

        return redirect()->route('company.index'); 
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
