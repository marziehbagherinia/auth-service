<?php

namespace App\Http\Controllers\Admin\Roles;

use Illuminate\Http\Request;
use App\Jobs\Roles\RoleDeleteJob;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class DeleteRoleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $role_id
     * @return JsonResponse
     */
    public function __invoke( Request $request, $role_id ): JsonResponse
    {
        $role = RoleDeleteJob::dispatchSync( [
            'id' => $role_id
        ] );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'role.delete.success' ),
            'data'    => $role,
        ], 200 );
    }
}
