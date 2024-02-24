<?php

namespace App\Jobs\Auth;

use App\Utils\AuthHelper\AuthHelper;
use Illuminate\Queue\SerializesModels;
use App\Utils\CacheManager\CacheManager;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Exceptions\Users\UserNotFoundException;
use App\Exceptions\Auth\HasResetPasswordLimitationException;
use App\Exceptions\Auth\TokenGenerationFailedException;

class SendResetPasswordLinkJob
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $user;

    /**
     * SendResetPasswordLinkJob constructor.
     *
     * @param $user
     */
    public function __construct( $user )
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws HasResetPasswordLimitationException
     * @throws TokenGenerationFailedException
     * @throws UserNotFoundException
     */
    public function handle(): void
    {
        if ( !isset( $this->user->id, $this->user->email ) )
        {
            throw new UserNotFoundException();
        }

        if ( $this->hasResetPasswordLimitation() )
        {
            throw new HasResetPasswordLimitationException();
        }

        $token = $this->getToken();

        if ( !isset( $token ) )
        {
            throw new TokenGenerationFailedException();
        }

        // Send reset password token to user's email.
    }

    /**
     * @return string
     */
    private function getToken(): string
    {
        $token = AuthHelper::generateTokenByEmail( $this->user->email );

        CacheManager::setUserResetPasswordToken( $token, $this->user->id );

        return $token;
    }

    /**
     * @return bool
     */
    private function hasResetPasswordLimitation(): bool
    {
        $resetPasswordDone = CacheManager::getUserResetPasswordDone( $this->user->id ?? null );

        return isset( $resetPasswordDone ) && $resetPasswordDone ;
    }
}
