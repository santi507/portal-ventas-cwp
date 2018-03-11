<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

use Excel;
use DB;
use Log;

use App\Entities\Goal\Shop\Seller as GoalShopSeller;

class InsertGoalShopSeller extends Job implements SelfHandling, ShouldQueue
{
    use DispatchesJobs, InteractsWithQueue, Queueable, SerializesModels; 

    public $goals;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($goals)
    {
       $this->goals = $goals;
       $this->data = Excel::load($this->goals, function($reader) {})->get();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;
        Log::info($data);
        $data->each( function($row){
            $goal = new GoalShopSeller();
            $goal->goal = $row->meta;
            $goal->weight = $row->peso;
            $goal->arpu = $row->arpu;
            $goal->month = $row->mes;
            $goal->year = $row->ano;
            $goal->shop_seller_id = $row->vendedor_id;
            $goal->subcategory_id = $row->tecnologia_id;
            $goal->save();
        });
    }
}
