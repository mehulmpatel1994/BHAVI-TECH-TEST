<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\RepositoryInterfaces\VersionControlRepositoryInterface;

class listRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repo:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List All Repository.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(VersionControlRepositoryInterface $gitRepository)
    {
       $list = $gitRepository->list();

       if(count($list) > 0){

        $this->info("Below Are ALl Available Repositories");
        $this->newLine(2);
        $this->table(
         ['Id', 'Name','Private'],
         $list
     );

       }else{
        $this->error('Not Found Any Repository!');

       }

    }
}
