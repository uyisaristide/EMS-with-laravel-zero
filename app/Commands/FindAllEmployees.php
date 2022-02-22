<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\DB;

class FindAllEmployees extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = '1';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'display all employees';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $headers = ['ID','Name','Email'];
        $employees = DB::table('employees')->get();

        // foreach ($employees as $employee) {
            
            // $this->table($headers,
            // $this->info($employee->id.$employee->name);
        // $this->
        $employee= DB::select("SELECT id,name,email FROM employees");

        $results = [];

        foreach($employee as $key => $value){
            $results[$key] = (array) $value;
        }
        
        $this->table(['id', 'name', 'email'],$results);
        // }   
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
