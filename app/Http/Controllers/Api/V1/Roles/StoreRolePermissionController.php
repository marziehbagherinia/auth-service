<?php

namespace App\Http\Controllers\Api\V1\Roles;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Jobs\Roles\RolePermissionStoreJob;
use App\Http\Requests\Api\V1\Roles\StoreRolePermissionRequest;

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
