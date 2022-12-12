<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PlayingTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    //public $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

//        if (is_numeric($this->id)) {
//            $result = [];
//            for ($i = 1 ; $i <= $this->id ; $i++){
//                if ($i % 3 == 0 && $i % 5 == 0) {
//                    $result[] .= 'FizzBuzz';
//                } else if ($i % 3 == 0) {
//                    $result[] .= 'Fizz';
//                } else if ($i % 5 == 0) {
//                    $result[] .= 'Buzz';
//                } else {
//                    $result[] .= $i;
//                }
//            }
//            return $result;
//        }
//        return 'Please enter a number';
    }
}
//        if (is_numeric($id)) {
//            $result = [];
//            for ($i = 1 ; $i <= $id ; $i++){
//                if ($i % 3 == 0 && $i % 5 == 0) {
//                    $result[] .= 'FizzBuzz';
//                } else if ($i % 3 == 0) {
//                    $result[] .= 'Fizz';
//                } else if ($i % 5 == 0) {
//                    $result[] .= 'Buzz';
//                } else {
//                    $result[] .= $i;
//                }
//            }
//            return $result;
//        }
//        return 'Please enter a number';
