<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke( Request $request ): JsonResponse
    {
        $result = User::deleteToken( Auth::id() );

        return response()->json( [
            'status'  => 1,
            'message' => trans( 'auth.verify.success' ),
            'data'    => $result,
        ], 200 );
    }
}
