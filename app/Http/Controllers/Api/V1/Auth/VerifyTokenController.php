<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VerifyTokenController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke( Request $request ): JsonResponse
    {
        $user = Auth::user();

        return response()->json( [
            'status' => 1,
            'message' => trans( 'auth.verify.success' ),
            'data' => $user,
        ], 200 );
    }
}
