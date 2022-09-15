<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\RepositoryInterfaces\VersionControlRepositoryInterface;

class deleteRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repo:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Reposiory - Command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(VersionControlRepositoryInterface $gitRepository)
    {
        $reponame = $this->ask('Enter Repository Name Which You Want To Remove From List');


        if (!empty($reponame)) {

            $status = $gitRepository->remove($reponame);

            if ($status) {
                $this->info("{$reponame} Repository Removed Succesfully");
            } else {
                $this->error('Oops! Something Went Wrong!');
            }
        } else {

            $this->error('All Fields Is Required!');
        }
    }
}
