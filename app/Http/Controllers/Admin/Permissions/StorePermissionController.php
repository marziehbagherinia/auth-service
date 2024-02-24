<?php

namespace App\Http\Controllers\Admin\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Roles\StoreRoleRequest;
use App\Jobs\Permissions\PermissionStoreJob;
use Illuminate\Http\JsonResponse;

class StorePermissionController extends Controller
{
    /**
     * Handle the incoming request.
     * @param StoreRoleRequest $request
     * @return JsonResponse
     */
    public function __invoke( StoreRoleRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        $permission = PermissionStoreJob::dispatchSync( $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'permission.store.success' ),
            'data'    => $permission,
        ], 200 );
    }
}
