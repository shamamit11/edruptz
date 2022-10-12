<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
	protected $siteNamespace = 'App\Http\Controllers\Site';
	protected $instructorNamespace = 'App\Http\Controllers\Instructor';
	protected $studentNamespace = 'App\Http\Controllers\Student';
	protected $adminNamespace = 'App\Http\Controllers\Admin';
	
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->siteNamespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('instructor')
                ->prefix('instructor')
                ->namespace($this->instructorNamespace)
                ->group(base_path('routes/instructor.php'));

            Route::middleware('student')
                ->prefix('student')
                ->namespace($this->studentNamespace)
                ->group(base_path('routes/student.php'));

            Route::middleware('admin')
                ->prefix('admin')
                ->namespace($this->adminNamespace)
                ->group(base_path('routes/admin.php'));

        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
