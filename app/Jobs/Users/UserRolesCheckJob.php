<?php

namespace App\Jobs\Users;

use App\Models\Users\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Exceptions\Users\UserNotFoundException;

class UserRolesCheckJob implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $user_id;

    /**
     * @var
     */
    private $roles;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $user_id, $roles )
    {
        $this->user_id = $user_id;
        $this->roles   = $roles;
    }

    /**
     * @return mixed
     * @throws UserNotFoundException
     */
    public function handle(): mixed
    {
        $user = User::query()->where( 'id', $this->user_id )->first();

        if ( !isset( $user ) )
        {
            throw new UserNotFoundException();
        }

        return $user->hasRole( $this->roles );
    }
}
