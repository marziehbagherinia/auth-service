<?php

namespace App\Jobs\Users;

use App\Models\Users\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserStoreJob implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $data;

    private $columns = [
        'email',
        'password',
        'name',
        'phone_number'
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
     * @return mixed
     */
    public function handle(): mixed
    {
        if ( isset( $this->data[ 'password' ] ) )
        {
            $this->data[ 'password' ] = Hash::make( $this->data[ 'password' ] );
        }

        return User::create( Arr::only($this->data, $this->columns ) );
    }
}
