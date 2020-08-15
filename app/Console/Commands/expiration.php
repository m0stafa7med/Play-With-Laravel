<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:exipire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'exipire user every 5 min automatically';

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
       $users= User::where('exipire',0)->get();
        foreach($users as $user)
        {
            $user->update(['exipire'=>1]);
        }
      
        
    }
}
