<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\DB;

class DetailEmployee extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = '3 {id}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'details of employee';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $employee = DB::table('employees')->find($this->argument('id'));
        if($employee){

           
            $employee= DB::select("SELECT * FROM employees WHERE id= ? ",[$this->argument('id')]);

            $results = [];
    
            foreach($employee as $key => $value){
                $results[$key] = (array) $value;
            }
            
            $this->table(['id', 'name', 'email','Nationality','Status'],$results);
}
              else{
            $this->info('there is no Employee with this ID');
        }

       
        
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
