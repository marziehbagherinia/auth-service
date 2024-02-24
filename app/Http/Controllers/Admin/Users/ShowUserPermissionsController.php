<?php

namespace App\Http\Controllers\Admin\Users;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Jobs\Users\UserRolesShowJob;

class ShowUserPermissionsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $user_id
     * @return JsonResponse
     */
    public function __invoke( Request $request, $user_id ): JsonResponse
    {
        $permissions = UserRolesShowJob::dispatchSync( $user_id );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'auth.login.success' ),
            'data'    => $permissions,
        ], 200 );
    }
}
