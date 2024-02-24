<?php

namespace App\Jobs\Roles;

use App\Exceptions\Roles\RoleNotFoundException;
use Spatie\Permission\Models\Role;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

class RoleDeleteJob implements ShouldQueue
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
     * @return Builder|Model|object|null
     * @throws RoleNotFoundException
     */
    public function handle()
    {
        $role = Role::query()->where( 'id', $this->inputs[ 'id' ] )->first();

        if ( !isset( $role ) )
        {
            throw new RoleNotFoundException();
        }

        $role->delete();

        return $role;
    }
}
