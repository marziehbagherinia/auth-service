<?php

namespace App\Http\Controllers\Api\V1\Roles;

use App\Jobs\Roles\RoleUpdateJob;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Roles\UpdateRoleRequest;

class UpdateRoleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UpdateRoleRequest $request
     * @param $role_id
     * @return JsonResponse
     */
    public function __invoke( UpdateRoleRequest $request, $role_id ): JsonResponse
    {
        $inputs = $request->validated();

        $role = RoleUpdateJob::dispatchSync( $role_id, $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'role.update.success' ),
            'data'    => $role,
        ], 200 );
    }
}
