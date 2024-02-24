<?php

namespace App\Jobs\Roles;

use Spatie\Permission\Models\Role;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Exceptions\Roles\RoleNotFoundException;
use App\Exceptions\Permissions\PermissionNotFoundException;

class RolePermissionBatchStoreJob implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $role_id;

    /**
     * @var
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $role_id, $data )
    {
        $this->role_id = $role_id;
        $this->data    = $data;
    }

    /**
     * @return \Spatie\Permission\Contracts\Role|Role
     * @throws PermissionNotFoundException
     * @throws RoleNotFoundException
     */
    public function handle(): \Spatie\Permission\Contracts\Role|Role
    {
        $role = Role::query()->where( 'id', $this->role_id )->first();

        if ( !isset( $role ) )
        {
            throw new RoleNotFoundException();
        }

        $permissions = Permission::query()->whereIn('id', $this->data )->get();

        if ( !isset( $permissions ) )
        {
            throw new PermissionNotFoundException();
        }

        return $role->syncPermissions( $permissions );
    }
}
