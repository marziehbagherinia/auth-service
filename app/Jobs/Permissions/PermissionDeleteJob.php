<?php

namespace App\Jobs\Permissions;

use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exceptions\Permissions\PermissionNotFoundException;

class PermissionDeleteJob implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    private $inputs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $inputs )
    {
        $this->inputs = $inputs;

    }

    /**
     * @return Builder|Model|object
     * @throws PermissionNotFoundException
     */
    public function handle()
    {
        $permission = Permission::query()->where( 'id', $this->inputs[ 'id' ] )->first();

        if ( !isset( $permission ) )
        {
            throw new PermissionNotFoundException();
        }

        $permission->delete();

        return $permission;
    }
}
