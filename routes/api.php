<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\VerifyTokenController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\Users\UpdateUserController;
use App\Http\Controllers\Api\V1\Users\CheckUserRolesController;
use App\Http\Controllers\Api\V1\Users\CheckUserPermissionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group( [ 'prefix' => 'v1' ], function ()
{
    Route::post( 'register', RegisterController::class );
    Route::post( 'login', LoginController::class );
    Route::post( 'logout', LogoutController::class );
    Route::post( '/password/forgot', ForgotPasswordController::class );
    Route::post( '/password/reset', ResetPasswordController::class );

    Route::group( [ 'middleware' => 'auth:sanctum' ], function ()
    {
        Route::get( '/verify', VerifyTokenController::class );

        Route::group( [ 'prefix' => 'users' ], function ()
        {
            Route::put( 'profile', UpdateUserController::class );

            Route::group( [ 'prefix' => 'check' ], function ()
            {
                Route::post( '/roles', CheckUserRolesController::class );
                Route::post( '/permissions', CheckUserPermissionsController::class );

            } );
        } );
    } );
} );
