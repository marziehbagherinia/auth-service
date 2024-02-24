<?php

namespace App\Jobs\Permissions;

use Illuminate\Support\Arr;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exceptions\Permissions\PermissionNotFoundException;

class PermissionUpdateJob implements ShouldQueue
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
     * @throws PermissionNotFoundException
     */
    public function handle()
    {
        $permission = Permission::query()->where( 'id', $this->id )->first();

        if ( !isset( $permission ) )
        {
            throw new PermissionNotFoundException();
        }

        $permission->update( Arr::only( $this->data, $this->columns ) );

        return $permission;
    }

}
