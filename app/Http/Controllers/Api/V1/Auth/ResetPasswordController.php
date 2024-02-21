<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ResetPasswordRequest;
use App\Jobs\Auth\ResetPasswordViaLinkJob;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ResetPasswordRequest $request
     * @return mixed
     */
    public function __invoke( ResetPasswordRequest $request )
    {
        return response()->success(
            trans( 'auth.password.reset.success' ),
            ResetPasswordViaLinkJob::dispatchSync( $request->validated() )
        );
    }
}
