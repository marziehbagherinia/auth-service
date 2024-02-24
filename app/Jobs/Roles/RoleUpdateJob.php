<?php

namespace App\Jobs\Roles;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exceptions\Roles\RoleNotFoundException;

class RoleUpdateJob implements ShouldQueue
{

    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $data;

    /**
     * @var string[]
     */
    private $columns = [
        'name',
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $id, $data )
    {
        $this->id   = $id;
        $this->data = $data;
    }

    /**
     * @return Builder|Model|object
     * @throws RoleNotFoundException
     */
    public function handle()
    {
        $role = Role::query()->where( 'id', $this->id )->first();

        if ( !isset( $role ) )
        {
            throw new RoleNotFoundException();
        }

        $role->update( Arr::only( $this->data, $this->columns ) );

        return $role;
    }

}
