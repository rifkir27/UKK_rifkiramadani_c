<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            if (Auth::check() && Auth::user()->role === 'siswa') {
                $hasOverdue = Transaction::where('student_id', Auth::id())
                    ->where('status', 'borrowed')
                    ->whereDate('due_date', '<', now())
                    ->exists();
                $view->with('globalHasOverdue', $hasOverdue);
            }
        });
    }
}
