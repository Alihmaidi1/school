<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:techer']], function () {


    Route::group(["prefix"=>"parent"],function(){


        Route::get("dashboard",function(){

            return view("pages.parents.dashboard");

        });


    });





    });
