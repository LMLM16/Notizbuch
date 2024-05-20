<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Berechtigung zum Löschen einer Notiz
        Gate::define('delete-note', function ($user, $note) {
            return $user->id === $note->user_id;
        });

        // Berechtigung zum Löschen einer Liste
        Gate::define('delete-list', function ($user, $list) {
            return $user->id === $list->user_id;
        });
    }
}
