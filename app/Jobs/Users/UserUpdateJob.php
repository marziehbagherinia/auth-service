<?php

namespace App\Jobs\Users;

use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exceptions\Users\UserNotFoundException;

class UserUpdateJob implements ShouldQueue
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
     * @return mixed
     * @throws UserNotFoundException
     */
    public function handle(): mixed
    {
        $user = User::where( 'id', $this->id )->first();

        if ( !isset( $user ) )
        {
            throw new UserNotFoundException();
        }

        if ( isset( $this->data[ 'password' ] ) )
        {
            $this->data[ 'password' ] = Hash::make( $this->data[ 'password' ] );
        }

        $user->update( $this->data );

        return $user;
    }

}
