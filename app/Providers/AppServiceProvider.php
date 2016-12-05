<?php

namespace App\Providers;
use App\Providers\AuthValidation;
use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            //$translator -данные о локале, берется из app.conf
            //$data - массив с данными
            //$rule - название правила (required, max, min...)

            return new AuthValidation($translator, $data, $rules, $messages); // здесь мы добавили наш валидатор
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
