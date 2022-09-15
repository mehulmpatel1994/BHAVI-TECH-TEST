<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\RepositoryInterfaces\VersionControlRepositoryInterface;

class loginRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repo:login';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Login - Command Line Interface';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(VersionControlRepositoryInterface $gitRepository)
    {
        $uName = $this->ask('Enter UserName ');
        $git_token = $this->secret('Enter Persnal Access Token of GitHub');

        if(!empty($uName) && !empty($git_token)){

            $gitRepository->login($uName,$git_token);

            $this->info("Login Successfully To Your GIT Repository");

        }else{

            $this->error('All Fields Is Required!');

        }

    }
}
