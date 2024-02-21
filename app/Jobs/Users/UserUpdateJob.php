<?php

namespace App\Jobs\Users;

use App\Exceptions\Users\UserNotFoundException;
use App\Models\Users\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class UserUpdateJob implements ShouldQueue
{

    use Dispatchable, SerializesModels;

    private $id;
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $data)
    {
        $this->id   = $id;
        $this->data = $data;
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\Users\UserNotFoundException
     */
    public function handle()
    {
        $user = User::where('id', $this->id)->first();

        if ( ! $user) {
            throw new UserNotFoundException();
        }

        if (isset($this->data['password'])) {
            $this->data['password'] = Hash::make($this->data['password']);
        }

        $user->update($this->data);

        return $user;
    }

}
