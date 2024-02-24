<?php

namespace App\Http\Controllers\Admin\Permissions;

use App\Exceptions\Permissions\PermissionNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class ShowPermissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $permission_id
     * @return JsonResponse
     * @throws PermissionNotFoundException
     */
    public function __invoke( Request $request, $permission_id ): JsonResponse
    {
        $permission = Permission::query()->where( 'id', $permission_id )->first();

        if ( !isset( $permission ) )
        {
            throw new PermissionNotFoundException();
        }

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'permission.show.success' ),
            'data'    => $permission,
        ], 200 );
    }
}
