<?php

use Illuminate\Support\Facades\Route;
//use Modullo\ModulesLmsBaseAccounts\Http\Controllers\ModulesLmsBaseAccountsTenantController;

Route::prefix('api/v1')->namespace('Modullo\ModulesLmsBaseAccounts\Http\Controllers')->name('api.')->group(function (){
    Route::middleware('auth:sanctum')->group(function (){
        Route::get('here',function (){
            return response()->json(['here']);
        });
        Route::prefix('tenant')->group(function(){
//            Route::get('/learners','ModulesLmsLearningBaseTenantController@management')->name('tenant-learners');
            Route::post('learners/store-bulk','ModulesLmsBaseAccountsTenantController@storeBulk');
            Route::resource('learners','ModulesLmsBaseAccountsTenantController');
        });
    });
});
