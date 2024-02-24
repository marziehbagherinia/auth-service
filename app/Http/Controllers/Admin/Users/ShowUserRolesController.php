<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Jobs\Users\UserRolesShowJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowUserRolesController extends Controller
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
        $roles = UserRolesShowJob::dispatchSync( $user_id );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'auth.login.success' ),
            'data'    => $roles,
        ], 200 );
    }
}
