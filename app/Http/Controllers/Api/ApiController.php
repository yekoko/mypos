<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Company;
use App\Experience;
use App\Http\Controllers\Controller;
use App\Job;
use App\Industry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User_Experience;
use App\User;
use App\Saved_Job;
use App\Qualification;
use App\Http\Requests;
use App\Education;
use Illuminate\Support\Facades\Cache;
use Validator;
use Illuminate\Validation\Rule;

class ApiController extends Controller
{
    public function getJobs(Request $request)
    {
        $time = $request->input('t')/1000;

        $jobs = Cache::tags('jobs')->remember('jobs_' . $time, 7200, function () use ($time) {
            return Job::where('end_date','>', date('Y-m-d'))
                ->where(function ($query) use ($time) {
                    $query->orWhere('created_at', '>', date("Y-m-d H:i:s", $time))
                        ->orWhere('updated_at', '>', date("Y-m-d H:i:s", $time));
                })
                ->get();
        });

        return response()->json(['jobs'=>$jobs]);
    }

    public function getCompanies()
    {
        $companies = Cache::tags('companies')->remember('companies_' . strtotime(Carbon::now()->toDateString()), 1800, function () {
            return Company::leftJoin('jobs', 'jobs.company_id', '=', 'companies.id')
                ->groupBy('companies.id')
                ->where('jobs.end_date','>', Carbon::now()->toDateString())
                ->get([
                    'companies.id', 'companies.user_id', 'companies.name', 'companies.address',
                    'companies.phone', 'companies.company_size', 'companies.image',
                    'companies.registration_no', 'companies.website', 'companies.working_hours',
                    'companies.industry_id', 'companies.overview', 'companies.latitude', 'companies.longitude', 'companies.updated_at'
                ]);
        });

        return response()->json([ 'companies' => $companies ]);
    }

    public function getExperiences()
    {
        $experiences = Cache::tags('experiences')->remember('experiences_' . strtotime(Carbon::now()->toDateString()), 1800, function () {
            return Experience::leftJoin('jobs', 'jobs.experience_id', '=', 'experiences.id')
                ->groupBy('experiences.id')
                ->where('jobs.end_date','>', Carbon::now()->toDateString())
                ->get(['experiences.id', 'experiences.name', 'experiences.updated_at']);
        });

        return response()->json([ 'experiences' => $experiences ]);
    }

    public function getCategories()
    {
        $categories = Cache::tags('categories')->remember('categories_' . strtotime(Carbon::now()->toDateString()), 1800, function () {
            return $categories = Category::leftJoin('jobs', 'jobs.category_id', '=', 'categories.id')
                ->groupBy('categories.id')
                ->where('jobs.end_date','>', Carbon::now()->toDateString())
                ->get(['categories.id', 'categories.name', 'categories.updated_at']);
        });

        return response()->json([ 'categories' => $categories ]);
    }
    public function getUserexperience($id)
    {
        $user = User_Experience::with('industry')->whereuser_id($id)->get();
        return response()->json($user);
    }
    public function postUserexperience(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'position_title'       => 'required',
            'company_name'         => 'required',
            'industry_id'          => 'required',
            'start_date'           => 'required',
            'position_level'       => 'required',
            'job_type'             => 'required',
        ]);

        if ($validator->fails()) {
            if($validator->errors()->has('position_title'))
                return response()->json($validator->errors()->first('position_title'), 400);
            if($validator->errors()->has('company_name'))
                return response()->json($validator->errors()->first('company_name'), 400);
            if($validator->errors()->has('industry_id'))
                return response()->json($validator->errors()->first('industry_id'), 400);
            if($validator->errors()->has('start_date'))
                return response()->json($validator->errors()->first('start_date'), 400);
            if($validator->errors()->has('position_level'))
                return response()->json($validator->errors()->first('position_level'), 400);  
                if($validator->errors()->has('job_type'))
                return response()->json($validator->errors()->first('job_type'), 400);         
        }

        $experience = new User_Experience;
        $experience->user_id            = $request->user_id;
        $experience->position_title     = $request->position_title;
        $experience->company_name       = $request->company_name;
        $experience->industry_id        = $request->industry_id;
        $experience->start_date         = $request->start_date;
        $experience->end_date           = $request->end_date;
        $experience->position_level     = $request->position_level;
        $experience->save();

    }

    public function editUserexperience(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'position_title'       => 'required',
            'company_name'         => 'required',
            'industry_id'          => 'required',
            'start_date'           => 'required',
            'position_level'       => 'required',
            'job_type'             => 'required',
        ]);

        if ($validator->fails()) {
            if($validator->errors()->has('position_title'))
                return response()->json($validator->errors()->first('position_title'), 400);
            if($validator->errors()->has('company_name'))
                return response()->json($validator->errors()->first('company_name'), 400);
            if($validator->errors()->has('industry_id'))
                return response()->json($validator->errors()->first('industry_id'), 400);
            if($validator->errors()->has('start_date'))
                return response()->json($validator->errors()->first('start_date'), 400);
            if($validator->errors()->has('position_level'))
                return response()->json($validator->errors()->first('position_level'), 400);  
            if($validator->errors()->has('job_type'))
                return response()->json($validator->errors()->first('job_type'), 400);         
        }

        $experience = User_Experience::find($id);
        if ($experience) {
            $experience->user_id            = $request->user_id;
            $experience->position_title     = $request->position_title;
            $experience->company_name       = $request->company_name;
            $experience->industry_id        = $request->industry_id;
            $experience->start_date         = $request->start_date;
            $experience->end_date           = $request->end_date;
            $experience->position_level     = $request->position_level;
            $experience->update();

            return response()->json(["user_experience" => $experience]);
        }
        
    }

    public function getIndustries()
    {
        $industries = Industry::orderBy('id','desc')->get();
        return response()->json(['industries'=>$industries]);
    }

    public function editUser($id,Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'       => ['required',Rule::unique('users')->ignore($id)],
        ]);

        if ($validator->fails()) {
            if($validator->errors()->has('email'))
                return response()->json($validator->errors()->first('email'), 400);        
        }
        $user = User::find($id);
        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->address       = $request->address;
        $user->phone         = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->nationality   = $request->nationality;
        $user->religion      = $request->religion;
        $user->race          = $request->race;
        $user->gender        = $request->gender;
        $user->marital_status= $request->marital_status;
        $user->update();

    }

    public function getSavedjobs($user_id,$status)
    {
        if($status == "save"){
            $saved = Saved_Job::where('user_id',$user_id)->where('status',$status)->get();
            foreach ($saved as $key => $value) {
                $saved_jobs[$key] = Job::with('category','experience','company')->find($value->job_id);
            }
            
        }
        else{
            $saved_jobs = Saved_Job::with('job')->where('user_id',$user_id)->where('status',$status)->get();
        }
        
        return response()->json(['saved_jobs'=>$saved_jobs]);
    }

    public function postSavedjobs(Request $request)
    {
        $jobs = Saved_Job::where('user_id',$request->user_id)->where('job_id',$request->job_id)->where('status',$request->status)->first();
        if ($jobs) {
            $jobs->delete();
        }
        else{
            $saved_jobs = new Saved_Job;
            $saved_jobs->user_id = $request->user_id;
            $saved_jobs->job_id  = $request->job_id;
            $saved_jobs->status  = $request->status;
            $saved_jobs->save();
        }
        

        return response()->json("Successful");
    }

    public function getSavedjobscount($user_id){
        $saved_jobs = Saved_Job::where('user_id',$user_id)->where('status','save')->get();
        $apply_jobs = Saved_Job::where('user_id',$user_id)->where('status','apply')->get();
        return response()->json(['count'=>[['saved_jobs'=>count($saved_jobs),"apply_jobs"=>count($apply_jobs)]]]);

    }


    public function getQualification()
    {
        $qualifications = Qualification::orderBy('id','desc')->get();
        return response()->json(["qualifications" => $qualifications]);
    }

    public function getEducation($user_id)
    {
        $education = Education::with('qualification')->where('user_id',$user_id)->get();

        return response()->json(["educations"=>$education]);
    }

    public function postEducation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'           => 'required',
            'university'        => 'required',
            'qualification_id'  => 'required',
            'graduation_date'   => 'required',
            'major'             => 'required',
        ]);

        if ($validator->fails()) {
            if($validator->errors()->has('user_id'))
                return response()->json($validator->errors()->first('user_id'), 400);
            if($validator->errors()->has('university'))
                return response()->json($validator->errors()->first('university'), 400);
            if($validator->errors()->has('qualification_id'))
                return response()->json($validator->errors()->first('qualification_id'), 400);
            if($validator->errors()->has('graduation_date'))
                return response()->json($validator->errors()->first('graduation_date'), 400);
            if($validator->errors()->has('major'))
                return response()->json($validator->errors()->first('major'), 400);           
        }

        $education = new Education;
        $education->user_id            = $request->user_id;
        $education->university         = $request->university;
        $education->qualification_id   = $request->qualification_id;
        $education->graduation_date    = $request->graduation_date;
        $education->major              = $request->major;
        $education->save();

        return response()->json(["education" => $education]);
    }
}
