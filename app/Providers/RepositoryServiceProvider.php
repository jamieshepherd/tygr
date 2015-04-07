<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ClientRepositoryInterface',
            'App\Repositories\ClientRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ProjectRepositoryInterface',
            'App\Repositories\ProjectRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\IssueRepositoryInterface',
            'App\Repositories\IssueRepository'
        );
    }

}
