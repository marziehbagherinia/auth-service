<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Users\TestController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;

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

Route::middleware( 'auth:sanctum' )->get( '/user', function ( Request $request )
{
    return $request->user();
} );

Route::group( [ 'prefix' => 'v1' ], function ()
{
    Route::post( 'register', RegisterController::class );
    Route::post( 'login', LoginController::class );

    Route::group( [ 'middleware' => 'auth:sanctum' ], function ()
    {
        Route::group( [ 'prefix' => 'users' ], function ()
        {
            Route::get( '/test', TestController::class );
        } );
    } );
} );
