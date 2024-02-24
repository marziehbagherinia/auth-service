<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Enums\Users\UserTokenType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Jobs\Users\UserStoreJob;
use App\Models\Users\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke( RegisterRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        $user =  UserStoreJob::dispatchSync( $inputs );

        $token = User::createTokenByUserId( $user->id, UserTokenType::AUTH );

        return response()->json( [
            'message' => trans( 'auth.verify.success' ),
            'status' => 200,
            'data' => [ 'token' => $token->plainTextToken, 'has_password' => !empty( $user->password ) ]
        ] );
    }
}
