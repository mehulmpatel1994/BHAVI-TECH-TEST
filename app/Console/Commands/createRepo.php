<?php

namespace App\Console\Commands;

use App\RepositoryInterfaces\VersionControlRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class createRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repo:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create/Add new repository.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(VersionControlRepositoryInterface $gitRepository)
    {
        $reponame = $this->ask('Enter Your New Repository Name');


        if (!empty($reponame)) {

            $status = $gitRepository->create($reponame);
            $this->error($status);
            if ($status) {
                $this->info("{$reponame} Repository Created Successfully.");
                $this->newLine(1);

                $list = $gitRepository->list();

                if(count($list) > 0){

                    $this->info("Here Is Available Repositories");
                    $this->newLine(2);
                    $this->table(
                     ['Id', 'Name','Private'],
                     $list
                 );

                   }else{
                    $this->error('No Repository Available');
                   }
            } else {
                $this->error('Oops! Something Went Wrong!');
            }
        } else {

            $this->error('Enter All Required Fields!');
        }
    }
}
