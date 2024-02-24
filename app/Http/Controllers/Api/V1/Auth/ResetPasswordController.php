<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Jobs\Auth\ResetPasswordViaLinkJob;
use App\Http\Requests\Api\V1\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function __invoke( ResetPasswordRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        $result =  ResetPasswordViaLinkJob::dispatchSync( $inputs );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'auth.password.reset.success' ),
            'data'    => $result,
        ], 200 );
    }
}
