<?php

use App\Models\techer;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:techer']], function () {


    Route::group(["prefix"=>"techer"],function(){


        Route::get("dashboard",function(){



            return view("pages.techers.dashboard");

        });



    });





    });
