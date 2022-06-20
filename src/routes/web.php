<?php

use Illuminate\Support\Facades\Route;
use Modullo\ModulesLmsLearningBase\Http\Controllers\ModulesLmsBaseAccountsController;

Route::group(['namespace' => 'Modullo\ModulesLmsBaseAccounts\Http\Controllers','middleware' => ['web']],function() {


    Route::middleware('auth')->group(function () {
        Route::group(['prefix' => 'tenant'],function(){
//            Route::get('/learners','ModulesLmsLearningBaseTenantController@management')->name('tenant-learners');
            Route::post('learners/store-bulk','ModulesLmsBaseAccountsTenantController@storeBulk');
            Route::resource('learners','ModulesLmsBaseAccountsTenantController');
        });
    });

});
