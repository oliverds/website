<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class WordfulServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->gate();
    }

    protected function gate()
    {
        Gate::define('viewWordful', function ($user) {
           return in_array($user->email, [
                'oliver@radiocubito.com',
            ]);
       });
    }

    public function register()
    {
        //
    }
}
