<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
     * Keterangan
     *
     * Daftarkan layanan otentikasi / otorisasi apa pun.
     *GATE
     * definesi gate, mengembalikan Nilai TRUE atau FALSE
     * berdasarkan logika authorization yang didefinisikan dalam definisi gate.
     * Selain function closure, ada cara lain Anda dapat menetapkan gates.
     * Define == degfinisi
     * Identik ( === ) : Jika nilai $x sama dengan nilai $y, dan memiliki jenis atau nilai yang sama, maka hasilnya Benar.
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-question', function($user, $question){
            return $user->id === $question->user_id;
        });

        Gate::define('delete-question', function($user, $question){
            return $user->id === $question->user_id;
        });
    }
}
