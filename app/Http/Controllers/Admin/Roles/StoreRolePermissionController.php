<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Roles\StoreRolePermissionRequest;
use App\Jobs\Roles\RolePermissionStoreJob;
use Illuminate\Http\JsonResponse;

class StoreRolePermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRolePermissionRequest $request
     * @param $role_id
     * @return JsonResponse
     */
    public function __invoke( StoreRolePermissionRequest $request, $role_id ): JsonResponse
    {
        $inputs = $request->validated();

        $role = RolePermissionStoreJob::dispatchSync( $role_id, $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'role.store.success' ),
            'data'    => $role,
        ], 200 );
    }
}
