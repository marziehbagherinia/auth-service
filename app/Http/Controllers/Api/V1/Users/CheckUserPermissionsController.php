<?php

namespace App\Http\Controllers\Api\V1\Users;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Jobs\Users\UserPermissionsCheckJob;
use App\Http\Requests\Api\V1\Users\CheckUserPermissionsRequest;

class CheckUserPermissionsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param CheckUserPermissionsRequest $request
     * @return JsonResponse
     */
    public function __invoke( CheckUserPermissionsRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        $result = UserPermissionsCheckJob::dispatchSync( Auth::id(), $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'auth.login.success' ),
            'data'    => $result,
        ], 200 );
    }
}
