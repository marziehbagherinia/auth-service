<?php

namespace App\Http\Controllers\Admin\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Roles\UpdateRoleRequest;
use App\Jobs\Permissions\PermissionUpdateJob;
use Illuminate\Http\JsonResponse;

class UpdatePermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRoleRequest $request
     * @param $permission_id
     * @return JsonResponse
     */
    public function __invoke( UpdateRoleRequest $request, $permission_id ): JsonResponse
    {
        $inputs = $request->validated();

        $permission = PermissionUpdateJob::dispatchSync( $permission_id, $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'permission.update.success' ),
            'data'    => $permission,
        ], 200 );
    }
}
