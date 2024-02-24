<?php

namespace App\Http\Controllers\Admin\Permissions;

use App\Http\Controllers\Controller;
use App\Jobs\Permissions\PermissionDeleteJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
