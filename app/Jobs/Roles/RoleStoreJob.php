<?php

namespace App\Jobs\Roles;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RoleStoreJob implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $data;

    private $columns = [
        'name',
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        $this->data = $data;
    }

    /**
     * @return \Spatie\Permission\Contracts\Role|Role
     */
    public function handle(): \Spatie\Permission\Contracts\Role|Role
    {
        return Role::create( Arr::only( $this->data, $this->columns ) );
    }
}
