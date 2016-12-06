<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Company;
use App\Experience;
use App\Http\Controllers\Controller;
use App\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User_Experience;
use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Validator;

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
        $user = User_Experience::whereuser_id($id)->get();
        return response()->json($user);
    }
    public function postUserexperience(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'position_title'       => 'required',
            'company_name'         => 'required',
            'start_date'           => 'required',
            'end_date'             => 'required',
            'position_level'       => 'required',
        ]);

        if ($validator->fails()) {
            if($validator->errors()->has('position_title'))
                return response()->json($validator->errors()->first('position_title'), 400);
            if($validator->errors()->has('company_name'))
                return response()->json($validator->errors()->first('company_name'), 400);
            if($validator->errors()->has('start_date'))
                return response()->json($validator->errors()->first('start_date'), 400);
            if($validator->errors()->has('end_date'))
                return response()->json($validator->errors()->first('end_date'), 400);
            if($validator->errors()->has('position_level'))
                return response()->json($validator->errors()->first('position_level'), 400);           
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
}
