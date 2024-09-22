<?php

namespace App\Providers;

use App\data_display_options_interface;
use App\DataDisplayOptionsInterface;
use App\FeedbackInterface;
use App\Models\DataDisplayOption;
use App\Repositories\DataDisplayOptionsRepository;
use App\Repositories\FeedbackRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DataDisplayOptionsInterface::class,DataDisplayOptionsRepository::class);
        $this->app->bind(FeedbackInterface::class,FeedbackRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
