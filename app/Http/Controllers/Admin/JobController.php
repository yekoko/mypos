<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Job;
use App\Experience;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
 
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobs = Job::with('category')->paginate();
        //dd($request->route()->getPrefix());
        if ($request->route()->getPrefix() == "api") {
            return response()->json(['job'=>$jobs]);
        }
        //return response()->json(['job'=>$jobs]);
        return view('admin.jobs.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $experiences = Experience::all();
        return view('admin.jobs.create',compact('categories','experiences'));
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
            'title'              => 'required',
            'category'           => 'required',
            'experience'         => 'required',
            'salary'             => 'required',
            'requirement'        => 'required',
            'responsibilities'   => 'required',
            'description'        => 'required',
            'email'              => 'required|email',
            'phone'              => 'required',
            'address'            => 'required',

             
        ]);
        if ($validator->fails()) {
            if ($request->route()->getPrefix() == "/admin") {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            }
            if($validator->errors()->has('title'))
                return response()->json($validator->errors()->first('title'), 400);
            if($validator->errors()->has('category'))
                return response()->json($validator->errors()->first('category'), 400);
            if($validator->errors()->has('experience'))
                return response()->json($validator->errors()->first('experience'), 400);   
            if($validator->errors()->has('salary'))
                return response()->json($validator->errors()->first('salary'), 400);
            if($validator->errors()->has('requirement'))
                return response()->json($validator->errors()->first('requirement'), 400);
            if($validator->errors()->has('responsibilities'))
                return response()->json($validator->errors()->first('responsibilities'), 400);
            if($validator->errors()->has('description'))
                return response()->json($validator->errors()->first('description'), 400);
            if($validator->errors()->has('email'))
                return response()->json($validator->errors()->first('email'), 400);
            if($validator->errors()->has('phone'))
                return response()->json($validator->errors()->first('phone'), 400);
            if($validator->errors()->has('address'))
                return response()->json($validator->errors()->first('address'), 400);

        }

        $job = new Job;
        $job->title = $request->title;
        $job->company_id = 1 ;
        $job->category_id = $request->category;
        $job->experience_id = $request->experience;
        $job->salary = $request->salary;
        $job->requirements = $request->requirement;
        $job->responsibilities = $request->responsibilities;
        $job->description = $request->description;
        $job->email = $request->email;
        $job->phone_no = $request->phone;
        $job->address = $request->address;
        $job->end_date = "2016-09-21 06:36:27";
        $job->save(); 

        return redirect()->route('job.index');
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