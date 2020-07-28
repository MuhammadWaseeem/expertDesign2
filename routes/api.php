<?php

use App\Assessment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', 'Api\AuthController@register');
    Route::post('login', 'Api\AuthController@login');
    Route::post('refresh-token', 'Api\AuthController@refresh');
});
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('logout', 'Api\AuthController@logout');
        Route::get('user', 'Api\AuthController@user');
        ##Risk Assessment
        Route::get('dashboard',function (){
           $user= User::where('userRole','user')->count();
           $certificates = Assessment::all()->count();
            return response()->json(['total_users'=>$user,'total_certificate'=>$certificates]);
        });
        Route::resource('risk-assessment','Api\Certificate\AssessmentController');
        Route::get('users-list','Api\AuthController@users');
        Route::resource('location','Api\Data\LocationFlueController');
    });


