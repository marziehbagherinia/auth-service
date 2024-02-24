<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Exceptions\Roles\RoleNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ShowRoleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $role_id
     * @return JsonResponse
     * @throws RoleNotFoundException
     */
    public function __invoke( Request $request, $role_id ): JsonResponse
    {
        $role = Role::query()->where( 'id', $role_id )->first();

        if ( !isset( $role ) )
        {
            throw new RoleNotFoundException();
        }

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'role.show.success' ),
            'data'    => $role,
        ], 200 );
    }
}
