<?php

namespace App\Http\Controllers\Api\V1\Users;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Jobs\Users\UserRolesStoreJob;
use App\Http\Requests\Api\V1\Users\StoreUserRolesRequest;

class StoreUserRolesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreUserRolesRequest $request
     * @param $user_id
     * @return JsonResponse
     */
    public function __invoke( StoreUserRolesRequest $request, $user_id ): JsonResponse
    {
        $inputs = $request->validated();

        $roles = UserRolesStoreJob::dispatchSync( $user_id, $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'auth.login.success' ),
            'data'    => $roles,
        ], 200 );
    }
}
