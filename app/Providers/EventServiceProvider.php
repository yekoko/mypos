<?php

namespace App\Providers;

use App\Category;
use App\Company;
use App\Experience;
use App\Job;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();


        // //Job

        // Job::created(function ($item) {
        //     Cache::tags('jobs')->flush();
        // });

        // Job::updated(function ($item) {
        //     Cache::tags('jobs')->flush();
        // });

        // Job::deleted(function ($item) {
        //     Cache::tags('jobs')->flush();
        // });



        // // Company

        // Company::created(function ($item) {
        //     Cache::tags('companies')->flush();
        // });

        // Company::updated(function ($item) {
        //     Cache::tags('companies')->flush();
        // });

        // Company::deleted(function ($item) {
        //     Cache::tags('companies')->flush();
        // });



        // // Category

        // Category::created(function ($item) {
        //     Cache::tags('categories')->flush();
        // });

        // Category::updated(function ($item) {
        //     Cache::tags('categories')->flush();
        // });

        // Category::deleted(function ($item) {
        //     Cache::tags('categories')->flush();
        // });



        // //Experience

        // Experience::created(function ($item) {
        //     Cache::tags('experiences')->flush();
        // });

        // Experience::updated(function ($item) {
        //     Cache::tags('experiences')->flush();
        // });

        // Experience::deleted(function ($item) {
        //     Cache::tags('experiences')->flush();
        // });
    }
}
