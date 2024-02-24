<?php

namespace App\Jobs\Auth;

use App\Jobs\Users\UserUpdateJob;
use Illuminate\Queue\SerializesModels;
use App\Utils\CacheManager\CacheManager;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Exceptions\Auth\InvalidResetPasswordTokenException;
use App\Exceptions\Auth\InvalidResetPasswordInputException;

class ResetPasswordViaLinkJob
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $data;

    /**
     * ResetPasswordViaLinkJob constructor.
     *
     * @param $data
     */
    public function __construct( $data )
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return bool
     * @throws InvalidResetPasswordInputException
     * @throws InvalidResetPasswordTokenException
     */
    public function handle(): bool
    {
        if ( !isset( $this->data[ 'token' ], $this->data[ 'new_password' ] ) )
        {
            throw new InvalidResetPasswordInputException();
        }

        $userId = CacheManager::getUserResetPasswordToken( $this->data[ 'token' ] );

        if ( !isset( $userId ) )
        {
            throw new InvalidResetPasswordTokenException();
        }

        CacheManager::setUserResetPasswordDone( $userId );

        UserUpdateJob::dispatchSync(
            $userId,
            [
                'password' => $this->data[ 'new_password' ]
            ]
        );

        return true;
    }
}
