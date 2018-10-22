<?php

namespace Ilya\Recaptcha;

use Illuminate\Support\ServiceProvider;

class RecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../../config/recaptcha.php' => config_path('recaptcha.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // ...
    }
}
