<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;
use App\Models\Poll;
use App\Observers\PollObserver;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        view()->composer('*',function($view) {
            $view->with('activePolls', Poll::where('status', 1)->get());
        });
        JsonResource::withoutWrapping();
    }
}
