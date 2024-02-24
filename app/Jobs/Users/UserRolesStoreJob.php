<?php

namespace App\Jobs\Users;

use App\Models\Users\User;
use Spatie\Permission\Models\Role;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Exceptions\Roles\RoleNotFoundException;
use App\Exceptions\Users\UserNotFoundException;

class UserRolesStoreJob implements ShouldQueue
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
     * @throws RoleNotFoundException
     */
    public function handle(): mixed
    {
        $user = User::query()->where( 'id', $this->user_id )->first();

        if ( !isset( $user ) )
        {
            throw new UserNotFoundException();
        }

        $roles = Role::query()->whereIn( 'name', $this->roles )->get()->pluck( 'name' );

        if ( !empty( array_diff( $this->roles, $roles ) ) )
        {
            throw new RoleNotFoundException();
        }

        return $user->assignRole( $this->roles );
    }
}
