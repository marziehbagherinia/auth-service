<?php

namespace App\Http\Controllers\Admin\Roles;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Jobs\Roles\RolePermissionBatchStoreJob;
use App\Http\Requests\Admin\Roles\StoreRolePermissionsRequest;

class StoreRolePermissionsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRolePermissionsRequest $request
     * @param $role_id
     * @return JsonResponse
     */
    public function __invoke( StoreRolePermissionsRequest $request, $role_id ): JsonResponse
    {
        $inputs = $request->validated();

        $role = RolePermissionBatchStoreJob::dispatchSync( $role_id, $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'role.store.success' ),
            'data'    => $role,
        ], 200 );
    }
}
