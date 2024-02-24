<?php

namespace App\Http\Controllers\Admin\Roles;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Exceptions\Roles\RoleNotFoundException;

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
