<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Enums\Users\UserTokenType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Jobs\Users\UserStoreJob;
use App\Models\Otps\Otp;
use App\Models\Users\User;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param RegisterRequest $request
     * @return mixed
     */
    public function __invoke( RegisterRequest $request ): mixed
    {
        $inputs = $request->validated();

        $user =  UserStoreJob::dispatchSync( $inputs );

        $token = User::createTokenByUserId( $user->id, UserTokenType::AUTH );

        return response()->success( trans( 'auth.verify.success' ), [ 'token' => $token->plainTextToken, 'has_password' => !empty( $user->password ) ] );
    }
}
