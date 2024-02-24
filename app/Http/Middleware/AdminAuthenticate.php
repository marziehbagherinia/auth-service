<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\Users\UserType;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdminAuthenticate
 */
class AdminAuthenticate
{
	/**
	 * AdminAuthenticate constructor.
	 */
	public function __construct() {}

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param ...$guards
     * @return JsonResponse|mixed
     */
    public function handle( Request $request, Closure $next, ...$guards ): mixed
    {
		if( Auth::check() )
		{
            $user = Auth::user();

            if ( isset( $user ) && in_array( UserType::SUPER_ADMIN , $user->getRoleNames() ) )
            {
                return $next( $request );
            }
		}

		return response()->json( [ 'error' => 'unauthorized' ], 401 );
	}
}
