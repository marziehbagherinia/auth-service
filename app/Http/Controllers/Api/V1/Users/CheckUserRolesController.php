<?php

namespace App\Http\Controllers\Api\V1\Users;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Jobs\Users\UserRolesCheckJob;
use App\Http\Requests\Api\V1\Users\CheckUserRolesRequest;

class CheckUserRolesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param CheckUserRolesRequest $request
     * @return JsonResponse
     */
    public function __invoke( CheckUserRolesRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        $result = UserRolesCheckJob::dispatchSync( Auth::id(), $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'auth.login.success' ),
            'data'    => $result,
        ], 200 );
    }
}
