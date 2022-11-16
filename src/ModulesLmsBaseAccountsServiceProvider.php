<?php

namespace Modullo\ModulesLmsBaseAccounts;

use Illuminate\Support\ServiceProvider;

class ModulesLmsBaseAccountsServiceProvider  extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'modules-lms-base-accounts');

        // $this->publishes([
        //     __DIR__.'/resources/carousel' => public_path('LearningBase'),
        // ], 'modullo-modules');

/*        $this->publishes([
            __DIR__.'/resources/js/app/' => public_path('/'),
        ], 'modullo-modules');

        $this->publishes([
            __DIR__.'/resources/js/' => resource_path('js/vendor/modules-lms-base-accounts')
        ],'modullo-modules');

        $this->publishes([
            __DIR__.'/resources/js' => public_path('vendor/modules-lms-base-accounts'),
        ], 'modullo-modules');*/

        $this->publishes([
            __DIR__.'/config/modules-lms-base-accounts.php' => config_path('modules-lms-base-accounts.php')
        ],'modullo-modules');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/navigation-menu.php', 'modullo-navigation-menu.modules-lms-base-accounts'
        );
    }
}
