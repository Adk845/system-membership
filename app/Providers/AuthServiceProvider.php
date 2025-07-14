<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        $this->registerPolicies();

    Gate::define('member-only', function ($user) {
        return $user->role === 'member'; // atau sesuai kolom/relasi yang kamu gunakan
    });

    // Tambahkan role lainnya jika perlu
    Gate::define('admin-only', function ($user) {
        return $user->role === 'admin';
    });
    Gate::define('koordinator-only', function ($user) {
        return $user->role === 'koordinator';
    });
    Gate::define('admin-koordinator', function ($user) {        
        return in_array($user->role, ['admin', 'koordinator']);
    });
    }
}
