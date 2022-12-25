<?php


namespace Domain\Commerce;


use Domain\Communications\Events\NewCommunication;
use Domain\Communications\Listeners\SendCommunications;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommerceServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware('web')
            ->group(__DIR__. DIRECTORY_SEPARATOR. 'routes/web.php');

        $this->loadMigrationsFrom(__DIR__. DIRECTORY_SEPARATOR. 'database/migrations');
    }

}
