<?php

namespace App\Console\Commands;

use App\Domain\Repository\UserRepositoryAPI;
use App\Http\Controllers\UserController;
use Illuminate\Console\Command;

class FetchUsersFromAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:fetchUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches Users from external API';

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
     * @return int
     */
    public function handle()
    {
        $UserRepository = new UserRepositoryAPI();
        $UserController = new UserController($UserRepository);
        $response = (array) $UserController->index(1);
        foreach($response as $User)
            print_r($User);

        return 0;
    }
}
