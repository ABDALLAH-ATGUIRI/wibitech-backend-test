<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
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
        Task::class => TaskPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication/authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Grant all abilities to admin users before any policy check
        Gate::before(function ($user, $ability) {
            if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
                return true; // Allow all actions for admin
            }
        });
    }
}
