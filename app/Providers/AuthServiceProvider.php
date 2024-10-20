<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
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

        Gate::before(function ($user,$ability){
            if($user->admin){
                return true;
            }
   
        });

        Gate::define("admin-tasks", function($user){
            return $user->admin;
        });

        Gate::define('edit-user', function ($user, $editUser) {
           
                return $user->id == $editUser->id;
            
        });

        Gate::define('edit-tag', function ($user, $tag) {
           
                return $user->admins->find($tag->id) != null;
            
           
        });

        Gate::define('edit-post', function ($user, $post) {
           
            return $user->posts->find($post->id) != null;
        
    });

    Gate::define('edit-comment', function ($user, $comment) {
        if($user->comments->find($comment->id) != null){
            return true;
        }else if(!$comment->post->tags->whereIn("tag",$user->admins->pluck("tag")->toArray())->isEmpty()){
            return true;
        }else{
            return false;
        }

    
});


        Passport::routes();
    }
}
