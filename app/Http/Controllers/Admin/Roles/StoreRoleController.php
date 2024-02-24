<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Roles\StoreRoleRequest;
use App\Jobs\Roles\RoleStoreJob;
use Illuminate\Http\JsonResponse;

class StoreRoleController extends Controller
{
    /**
     * Handle the incoming request.
     * @param StoreRoleRequest $request
     * @return JsonResponse
     */
    public function __invoke( StoreRoleRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        $role = RoleStoreJob::dispatchSync( $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'role.store.success' ),
            'data'    => $role,
        ], 200 );
    }
}
