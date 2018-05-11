<?php

namespace App\Console\Commands;

use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class importPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:plans';
	protected $plans;
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Plans from Stripe';

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
     * @return mixed
     */
    public function handle()
    {
    	$plan = new Plan();
        $plans = $plan->getStripePlans();
		
        foreach($plans as $object)
		{
			$requestedData = [
				'name' => $object->id,
				'frequency' => $object->nickname,
				'price' => $object->amount,
				'created_at' =>Carbon::now(),
				];
			
			
			Plan::create($requestedData);
		}
		
    }
}
