<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class repo extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("App\\repo\interfaces\\techer","App\\repo\classes\\techer");
        $this->app->bind("App\\repo\interfaces\grade","App\\repo\classes\grade");
        $this->app->bind("App\\repo\interfaces\student","App\\repo\classes\student");
        $this->app->bind("App\\repo\interfaces\classroom","App\\repo\classes\classroom");
        $this->app->bind("App\\repo\interfaces\section","App\\repo\classes\section");
        $this->app->bind("App\\repo\interfaces\parents","App\\repo\classes\parents");
        $this->app->bind("App\\repo\interfaces\promotion","App\\repo\classes\promotion");
        $this->app->bind("App\\repo\interfaces\salary","App\\repo\classes\salary");
        $this->app->bind("App\\repo\interfaces\subject","App\\repo\classes\subject");
        $this->app->bind("App\\repo\interfaces\\fee","App\\repo\classes\\fee");
        $this->app->bind("App\\repo\interfaces\student_fee","App\\repo\classes\student_fee");
        $this->app->bind("App\\repo\interfaces\\exam","App\\repo\classes\\exam");
        $this->app->bind("App\\repo\interfaces\queze","App\\repo\classes\queze");
        $this->app->bind("App\\repo\interfaces\library","App\\repo\classes\library");
        $this->app->bind("App\\repo\interfaces\sheck","App\\repo\classes\sheck");
        $this->app->bind("App\\repo\interfaces\attendaces","App\\repo\classes\attendaces");

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
