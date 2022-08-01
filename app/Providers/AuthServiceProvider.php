<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        

        Gate::define('isAdmin', function($user) {

            if($user->role == 'admin'){
                return true;
            }
            return false;
 
         });
 
        
 
         /* define a manager user role */
 
         Gate::define('isManager', function($user) {
 
            if($user->role == 'Department Head'){
                return true;
            }
            return false;
         });
 
       
 
         /* define a user role */
 
         Gate::define('isStaff', function($user) {
 
             if($user->role == 'Staff'){
                return true;
             }
             return false;
 
         });

         Gate::define('isCarrier', function($user) {
 
            if($user->role == 'Carrier'){
                return true;
            }
            return false;
        });

        //
    }
}
