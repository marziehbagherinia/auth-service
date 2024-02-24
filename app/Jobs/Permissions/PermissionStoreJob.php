<?php

namespace App\Jobs\Permissions;

use Illuminate\Support\Arr;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PermissionStoreJob implements ShouldQueue
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
     * @return \Spatie\Permission\Contracts\Permission|Permission
     */
    public function handle(): \Spatie\Permission\Contracts\Permission|Permission
    {
        return Permission::create( Arr::only( $this->data, $this->columns ) );
    }
}
