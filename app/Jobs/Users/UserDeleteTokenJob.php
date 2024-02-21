<?php

namespace App\Jobs\Users;

use App\Exceptions\Users\TokenNotFoundException;
use App\Exceptions\Users\UserNotFoundException;
use App\Models\Users\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserDeleteTokenJob implements ShouldQueue
{

    use Dispatchable, SerializesModels;

    private $inputs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userId  = $this->inputs['user_id'];
        $tokenId = $this->inputs['token_id'];

        if ( ! User::show( $userId ) )
        {
            throw new UserNotFoundException();
        }

        if ( ! User::findTokenById($userId, $tokenId)) {
            throw new TokenNotFoundException();
        }

        return User::deleteToken($userId, $this->inputs['token_id']);
    }

}
