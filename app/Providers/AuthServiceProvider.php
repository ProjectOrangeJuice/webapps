<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerPolicies();

        Gate::define('edit-user', function ($user, $editUser) {
            if ($user->admin){
            return true;
            }else{
                return $user->id == $editUser->id;
            }
        });

        Gate::define('edit-tag', function ($user, $tag) {
            if($user->admin){
                return true;
            }else{
                return $user->admins->find($tag->id) != null;
            }
           
        });

        Gate::define('edit-post', function ($user, $post) {
            if($user->admin){
                return true;
            }else{
                return $user->posts->find($post->id) != null;
            }
        });
    }
}
