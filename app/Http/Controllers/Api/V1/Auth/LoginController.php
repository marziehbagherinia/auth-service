<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\Users\User;
use Illuminate\Http\JsonResponse;
use App\Enums\Users\UserTokenType;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Exceptions\Users\UserNotFoundException;
use App\Http\Requests\Api\V1\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    public function __invoke( LoginRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        $user = $this->findUser( $inputs );

        if ( !$user )
        {
            throw new UserNotFoundException();
        }

        if ( !Hash::check( $inputs[ 'password' ], $user->password ) )
        {
            return response()->json( [
                'message' => trans( 'auth.login.password.incorrect' ),
                'status' => 400,
            ] );
        }

        $token = $user->createToken( UserTokenType::AUTH );

        return response()->json( [
            'message' => trans( 'auth.login.success' ),
            'status' => 200,
            'data' => [ 'token' => $token->plainTextToken ]
        ] );
    }

    /**
     * @param $inputs
     * @return mixed|null
     */
    private function findUser( $inputs ): mixed
    {
        $user = null;

        if ( isset( $inputs[ 'email' ] ) )
        {
            $user = User::findByEmail( $inputs[ 'email' ] );
        }
        elseif ( isset(  $inputs[ 'phone_number' ] ) )
        {
            $user = User::findByPhoneNumber( $inputs[ 'email' ] );
        }

        return $user;
    }
}
