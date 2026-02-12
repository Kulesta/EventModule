<?php

namespace Modules\Events\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'Events';
    protected string $moduleNamespace = 'Modules\Events\Http\Controllers';

    public function boot(): void
    {
        parent::boot();
    }

    public function map(): void
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAdminRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path($this->name, 'routes/web.php'));
    }

    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace . '\Api')
            ->group(module_path($this->name, 'routes/api.php'));
    }

    protected function mapAdminRoutes(): void
    {
        Route::prefix('admin')
            ->middleware('web')
            ->namespace($this->moduleNamespace . '\Admin')  // ← ONLY ONE 'Admin' HERE
            ->name('admin.')  // ← This adds admin. prefix to route names
            ->group(module_path($this->name, 'routes/admin.php'));
    }
}