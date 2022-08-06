<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // 'App\Models\Post' => 'App\Policies\PostPolicy',
        Post::class => PostPolicy::class, // same above
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Define Gate
        Gate::define('admin', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('editor', function($user){
            return $user->hasRole('editor');
        });

        Gate::define('author', function($user){
            return $user->hasRole('author');
        });

    }
}
