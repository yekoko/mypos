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

class ApiController extends Controller
{
    public function getJobs(Request $request)
    {
        $time = $request->input('t')/1000;

        $jobs = Job::where('end_date','>', Carbon::now()->toDateString())
            ->where(function ($query) use ($time){
                $query->orWhere('created_at', '>', date("Y-m-d H:i:s", $time))
                    ->orWhere('updated_at', '>', date("Y-m-d H:i:s", $time));
            })
            ->get()
            ->makeHidden(['created_at', 'updated_at']);

        return response()->json(['jobs'=>$jobs]);
    }

    public function getCompanies()
    {
        $companies = Company::leftJoin('jobs', 'jobs.company_id', '=', 'companies.id')
                        ->groupBy('companies.id')
                        ->where('jobs.end_date','>', Carbon::now()->toDateString())
                        ->get([
                            'companies.id as company_id', 'companies.user_id', 'companies.name as company_name', 'companies.address as company_address',
                            'companies.phone as company_phone', 'companies.company_size', 'companies.image as company_image',
                            'companies.registration_no as company_reg_no', 'companies.website as company_website', 'companies.working_hours as company_working_hours',
                            'companies.industry_id as company_industry_id', 'companies.overview as company_overview'
                        ]);

        return response()->json([ 'companies' => $companies ]);
    }

    public function getExperiences()
    {
        $experiences = Experience::leftJoin('jobs', 'jobs.experience_id', '=', 'experiences.id')
                            ->groupBy('experiences.id')
                            ->where('jobs.end_date','>', Carbon::now()->toDateString())
                            ->get(['experiences.id as experience_id', 'experiences.name as experience_name']);

        return response()->json([ 'experiences' => $experiences ]);
    }

    public function getCategories()
    {
        $categories = Category::leftJoin('jobs', 'jobs.category_id', '=', 'categories.id')
                            ->groupBy('categories.id')
                            ->where('jobs.end_date','>', Carbon::now()->toDateString())
                            ->get(['categories.id as category_id', 'categories.name as category_name']);

        return response()->json([ 'categories' => $categories ]);
    }
}
