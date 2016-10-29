<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Company;
use App\Experience;
use App\Http\Controllers\Controller;
use App\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    public function getJobs(Request $request)
    {
        $time = $request->input('t')/1000;

        $jobs = Cache::tags('jobs')->remember('jobs_' . $time, 7200, function () use ($time) {
            return Job::where('end_date','>', date('Y-m-d'))
                ->where(function ($query) use ($time){
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
                    'companies.id as company_id', 'companies.user_id', 'companies.name as company_name', 'companies.address as company_address',
                    'companies.phone as company_phone', 'companies.company_size', 'companies.image as company_image',
                    'companies.registration_no as company_reg_no', 'companies.website as company_website', 'companies.working_hours as company_working_hours',
                    'companies.industry_id as company_industry_id', 'companies.overview as company_overview', 'companies.updated_at'
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
                ->get(['experiences.id as experience_id', 'experiences.name as experience_name', 'experiences.updated_at']);
        });

        return response()->json([ 'experiences' => $experiences ]);
    }

    public function getCategories()
    {
        $categories = Cache::tags('categories')->remember('categories_' . strtotime(Carbon::now()->toDateString()), 1800, function () {
            return $categories = Category::leftJoin('jobs', 'jobs.category_id', '=', 'categories.id')
                ->groupBy('categories.id')
                ->where('jobs.end_date','>', Carbon::now()->toDateString())
                ->get(['categories.id as category_id', 'categories.name as category_name', 'categories.updated_at']);
        });

        return response()->json([ 'categories' => $categories ]);
    }
}
