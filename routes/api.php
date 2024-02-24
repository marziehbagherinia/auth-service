<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\VerifyTokenController;
use App\Http\Controllers\Api\V1\Users\UpdateUserController;
use App\Http\Controllers\Api\V1\Users\ShowUserRolesController;
use App\Http\Controllers\Api\V1\Users\StoreUserRolesController;
use App\Http\Controllers\Api\V1\Users\CheckUserRolesController;
use App\Http\Controllers\Api\V1\Users\ShowUserPermissionsController;
use App\Http\Controllers\Api\V1\Users\CheckUserPermissionsController;
use App\Http\Controllers\Api\V1\Roles\StoreRoleController;
use App\Http\Controllers\Api\V1\Roles\ShowRoleController;
use App\Http\Controllers\Api\V1\Roles\DeleteRoleController;
use App\Http\Controllers\Api\V1\Roles\UpdateRoleController;
use App\Http\Controllers\Api\V1\Roles\StoreRolePermissionController;
use App\Http\Controllers\Api\V1\Roles\StoreRolePermissionsController;
use App\Http\Controllers\Api\V1\Permissions\StorePermissionController;
use App\Http\Controllers\Api\V1\Permissions\ShowPermissionController;
use App\Http\Controllers\Api\V1\Permissions\DeletePermissionController;
use App\Http\Controllers\Api\V1\Permissions\UpdatePermissionController;

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

    Route::group( [ 'middleware' => 'auth:sanctum' ], function ()
    {
        Route::get( '/verify', VerifyTokenController::class );

        Route::group( [ 'prefix' => 'users' ], function ()
        {
            Route::put( 'profile', UpdateUserController::class );

            // user-roles
            Route::get( '/{user_id}/roles', ShowUserRolesController::class );
            Route::post( '/{user_id}/roles', StoreUserRolesController::class );

            Route::group( [ 'prefix' => 'roles' ], function ()
            {
                Route::post( '/check', CheckUserRolesController::class );
            } );

            // user-permissions
            Route::get( '/{user_id}/permissions', ShowUserPermissionsController::class );

            Route::group( [ 'prefix' => 'permissions' ], function ()
            {
                Route::post( '/check', CheckUserPermissionsController::class );
            } );
        } );

        // ToDo: Add Admin middleware
        Route::group( [ 'prefix' => 'roles' ], function ()
        {
            Route::post( '/', StoreRoleController::class );
            Route::get( '/{role_id}', ShowRoleController::class );
            Route::put( '/{role_id}', UpdateRoleController::class );
            Route::delete( '/{role_id}', DeleteRoleController::class );

            Route::group( [ 'prefix' => 'permissions' ], function ()
            {
                Route::post( '/{role_id}', StoreRolePermissionController::class );
                Route::post( '/{role_id}/batch', StoreRolePermissionsController::class );
            } );
        } );

        Route::group( [ 'prefix' => 'permissions' ], function ()
        {
            Route::post( '/', StorePermissionController::class );
            Route::get( '/{permission_id}', ShowPermissionController::class );
            Route::put( '/{permission_id}', UpdatePermissionController::class );
            Route::delete( '/{permission_id}', DeletePermissionController::class );
        } );
    } );
} );
