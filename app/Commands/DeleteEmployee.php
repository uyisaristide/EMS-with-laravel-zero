<?php

namespace App\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;


class DeleteEmployee extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = '5{id}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'delete employee';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $employee = DB::table('employees')->find($this->argument('id'));
        if($employee){
            DB::table('employees')->delete($employee->id);
            $this->notify('Delete Notification','an employee    ' . $employee->name . '   is deleted','Images/delete.png');
        }else{
            $this->info('not matching with any employee');
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
