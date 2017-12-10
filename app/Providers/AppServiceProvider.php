<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use App\Repositories\MessagesRepository;
use App\Repositories\IMessagesRepository;
use App\Repositories\CacheMessagesRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        //$this->app->bind(IMessagesRepository::class, CacheMessagesRepository::class);
        $this->app->bind(IMessagesRepository::class, MessagesRepository::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->environment('local')){
            $this->app->register(\Modelizer\Selenium\SeleniumServiceProvider::class);
        }
    }
}
