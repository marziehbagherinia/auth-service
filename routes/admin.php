<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Roles\ShowRoleController;
use App\Http\Controllers\Admin\Roles\StoreRoleController;
use App\Http\Controllers\Admin\Roles\DeleteRoleController;
use App\Http\Controllers\Admin\Roles\UpdateRoleController;
use App\Http\Controllers\Admin\Roles\StoreRolePermissionController;
use App\Http\Controllers\Admin\Roles\StoreRolePermissionsController;
use App\Http\Controllers\Admin\Users\ShowUserRolesController;
use App\Http\Controllers\Admin\Users\StoreUserRolesController;
use App\Http\Controllers\Admin\Users\ShowUserPermissionsController;
use App\Http\Controllers\Admin\Permissions\ShowPermissionController;
use App\Http\Controllers\Admin\Permissions\StorePermissionController;
use App\Http\Controllers\Admin\Permissions\DeletePermissionController;
use App\Http\Controllers\Admin\Permissions\UpdatePermissionController;

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


Route::group( [ 'prefix' => 'admin', 'as' => 'admin' ], function ()
{
    Route::group( [ 'middleware' => 'auth.admin' ], function ()
    {
        Route::group( [ 'prefix' => 'users' ], function ()
        {
            Route::post( '/{user_id}/roles', StoreUserRolesController::class );
            Route::get( '/{user_id}/roles', ShowUserRolesController::class );
            Route::get( '/{user_id}/permissions', ShowUserPermissionsController::class );
        } );
    });

    Route::group( [ 'prefix' => 'permissions' ], function ()
    {
        Route::post( '/', StorePermissionController::class );
        Route::get( '/{permission_id}', ShowPermissionController::class );
        Route::put( '/{permission_id}', UpdatePermissionController::class );
        Route::delete( '/{permission_id}', DeletePermissionController::class );
    } );

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
});
