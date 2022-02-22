<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\DB;

class UpdateEmployee extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = '4{id}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'update employee';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $employee = DB::table('employees')->find($this->argument('id'));
        if($employee){

            $name = $this->ask('set name to');
        if($name === null){
            $this->warn("the name is a must");
            return;
        }
        $email = $this->ask('set Email to');
        if($email === null && filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $this->warn("invalid email");
            return;
        }
        $nationality = $this->ask('set nationality to');
        if($nationality === null){
            $this->warn("can't be empty");
            return;
        }
        $status = $this->ask('set status to');
        if($status === null){
            $this->warn("mut be filled");
            return;
        }
            DB::table('employees')
              ->where('id', $this->argument('id'))
              ->update([
                  'name' => $name,
              'email' => $email,
              'nationality' => $nationality,
              'status' => $status
            ]);
            $this->notify('Notification','an Employee is Updated','Images/edit.jpg');  
        }
     else {
         echo 'There is no employee with this ID';
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
