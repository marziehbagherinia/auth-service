<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\Auth\SendResetPasswordLinkViaEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request )
    {
        $user = Auth::user();

        if ( !isset( $user->email ) )
        {
            return response()->error( trans( 'auth.password.forgot.link.send.fail' )  );
        }

        $isDone = SendResetPasswordLinkViaEmailJob::dispatchSync( $user );

        if ( !$isDone )
        {
            return response()->error( trans( 'auth.password.forgot.link.send.fail' )  );
        }

        return response()->success( trans( 'auth.password.forgot.link.send.success' )  );
    }
}
