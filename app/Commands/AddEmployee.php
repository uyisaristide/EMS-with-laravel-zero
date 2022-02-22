<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\DB;

class AddEmployee extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = '2';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Add a new Employee';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('name of employee');
        if($name === null){
            $this->warn("the name is a must");
            return;
        }
        $email = $this->ask('Enter your Email');
        if($email === null && filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $this->warn("invalid email");
            return;
        }
        $nationality = $this->ask('nationality of employee');
        if($nationality === null){
            $this->warn("can't be empty");
            return;
        }
        $status = $this->ask('Martial status');
        if($status === null){
            $this->warn("mut be filled");
            return;
        }

        DB::table('employees')->insert([
            'name' => $name,
            'email' => $email,
            'nationality' => $nationality,
            'status' => $status
        ]);

    $this->notify('Notification','New Record Inserted','Images/add.png');
    
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
