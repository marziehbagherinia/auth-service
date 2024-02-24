<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Jobs\Users\UserUpdateJob;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Users\UpdateUserRequest;

class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function __invoke( UpdateUserRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        $user = UserUpdateJob::dispatchSync( $request->user()->id, $inputs );

        return response()->json( [
            'status' => 1,
            'message' => trans( 'auth.login.success' ),
            'data' => $user,
        ], 200 );
    }
}
