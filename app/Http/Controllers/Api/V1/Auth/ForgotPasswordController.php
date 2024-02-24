<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\Users\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Jobs\Auth\SendResetPasswordLinkJob;
use App\Exceptions\Users\UserNotFoundException;
use App\Http\Requests\Api\V1\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    public function __invoke( ForgotPasswordRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        if ( isset( $inputs[ 'email' ] ) )
        {
            $user = User::findByEmail( $inputs[ 'email' ] );
        }
        elseif ( isset( $inputs[ 'phone_number' ] ) )
        {
            $user = User::findByPhoneNumber( $inputs[ 'phone_number' ] );
        }

        if ( !isset( $user ) )
        {
            throw new UserNotFoundException();
        }

        $result = SendResetPasswordLinkJob::dispatchSync( $user );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'auth.password.forgot.link.send.success' ),
            'data'    => $result,
        ], 200 );
    }
}
