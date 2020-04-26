<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UserToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send to user a tokken';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $user = User::where('token', 6)->get()->first();
        $this->info($user->name);
        // $users = User::all();
        // info($users);


        // foreach($users  as $user){
        // $token = $user->token;

        //   $user->token = $token += 1;
        //   $user->save();

        // }
    }
}
