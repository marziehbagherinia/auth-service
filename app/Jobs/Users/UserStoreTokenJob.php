<?php

namespace App\Jobs\Users;

use App\Exceptions\Users\UserNotFoundException;
use App\Models\Users\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserStoreTokenJob implements ShouldQueue
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
        $id = $this->inputs['user_id'];

        if ( ! User::show( $id ) )
        {
            throw new UserNotFoundException();
        }

        return User::createTokenByUserId(
            $id,
            $this->inputs['token_name']
        );
    }

}
