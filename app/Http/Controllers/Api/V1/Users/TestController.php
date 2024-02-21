<?php

namespace App\Http\Controllers\Api\V1\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Users\UserNotFoundException;

class TestController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     * @throws UserNotFoundException
     */
    public function __invoke( Request $request ): mixed
    {
        $user = Auth::user();
        return response()->success( trans( 'auth.login.success' ), $user );
    }
}
