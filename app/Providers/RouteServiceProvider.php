<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers\Web';
    protected $adminSpace='App\Http\Controllers\Admin';
    protected $apiSpace='App\Http\Controllers\App';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::middleware('app')->prefix('app')->namespace($this->apiSpace)->group(base_path('routes/app.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware('admin')
            ->namespace($this->adminSpace)
            ->group(function ($route){
                if (is_file(base_path('routes/admin.php'))) {
                    require base_path('routes/admin.php');
                }
                if (is_file(base_path('routes/tool.php'))) {
                    require base_path('routes/tool.php');
                }
            });
    }
}
