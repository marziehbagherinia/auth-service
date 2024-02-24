<?php

namespace App\Jobs\Users;

use App\Models\Users\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Exceptions\Users\UserNotFoundException;
use App\Exceptions\Permissions\PermissionNotFoundException;

class UserPermissionsCheckJob implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $user_id;

    /**
     * @var
     */
    private $permissions;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $user_id, $permissions )
    {
        $this->user_id     = $user_id;
        $this->permissions = $permissions;
    }

    /**
     * @return bool
     * @throws PermissionNotFoundException
     * @throws UserNotFoundException
     */
    public function handle(): bool
    {
        $user = User::query()->where( 'id', $this->user_id )->first();

        if ( !isset( $user ) )
        {
            throw new UserNotFoundException();
        }

        $permissions = $user->getAllPermissions();

        return empty( array_diff( $this->permissions, $permissions ) );
    }
}
