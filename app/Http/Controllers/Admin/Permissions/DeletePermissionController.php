<?php

namespace App\Http\Controllers\Admin\Permissions;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Jobs\Permissions\PermissionDeleteJob;

class DeletePermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $permission_id
     * @return JsonResponse
     */
    public function __invoke( Request $request, $permission_id ): JsonResponse
    {
        $permission = PermissionDeleteJob::dispatchSync( [
            'id' => $permission_id
        ] );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'permission.delete.success' ),
            'data'    => $permission,
        ], 200 );
    }
}
