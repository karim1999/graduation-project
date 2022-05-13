<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class ProjectInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the project';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call("migrate:fresh");
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->call("admin:install");
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
//        $this->call("admin:generate-menu");
//        $this->call("admin:export-seed");
        $this->call("db:seed");
        return 0;
    }
}
