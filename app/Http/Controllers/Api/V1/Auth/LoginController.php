<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\Users\User;
use App\Enums\Users\UserTokenType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Exceptions\Users\UserNotFoundException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param LoginRequest $request
     * @return mixed
     * @throws UserNotFoundException
     */
    public function __invoke( LoginRequest $request ): mixed
    {
        $inputs = $request->validated();

        $user = $this->findUser( $inputs );

        if ( !$user )
        {
            throw new UserNotFoundException();
        }

        if ( !Hash::check( $inputs[ 'password' ], $user->password ) )
        {
            return response()->error( trans( 'auth.login.password.incorrect' ) );
        }

        $token = $user->createToken( UserTokenType::AUTH );

        return response()->success( trans( 'auth.login.success' ), [ "token" => $token->plainTextToken ] );
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
