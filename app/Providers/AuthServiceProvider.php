<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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
        Gate::define('admin', function ($user) {
            return $user->hasRole('admin');
        });

//        $adminRole = Role::create(['name' => 'admin']);
//        $editorRole = Role::create(['name' => 'editor']);
//
//        $createNewsPermission = Permission::create(['name' => 'create news']);
//        $editNewsPermission = Permission::create(['name' => 'edit news']);
//        $deleteNewsPermission = Permission::create(['name' => 'delete news']);
//
//        $adminRole->givePermissionTo([$createNewsPermission, $editNewsPermission, $deleteNewsPermission]);
//        $editorRole->givePermissionTo([$createNewsPermission, $editNewsPermission]);

        //
    }
}
