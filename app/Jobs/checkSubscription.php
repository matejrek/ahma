<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use Illuminate\Http\Request;

use App\Models\User;
use DB;

class checkSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stripeKey = 'sk_test_51HT7trLFv1NQex0wUTuPus2dssqxJn6Q1ze0yZ4O59pxDp6gIkica1Fky5NvtLntmKWtBhk65uSoS9mrOq1N8VWJ000Xhxbx7x';
        $stripe = new \Stripe\StripeClient($stripeKey);
        

        $stripeSubs = $stripe->subscriptions->all(['limit' => 250000]);

        $users = User::all();
        //User::chunk(100, function ($users) {
            $counter=0;
            foreach($users as $user){
                $user->createOrGetStripeCustomer();
                //$stripeSubs = $user->asStripeCustomer()->subscriptions->all();
                $dbSubs = DB::table('subscriptions')->select('stripe_id')->where('user_id', $user->id)->get();
                foreach($dbSubs as $check){
                    $canDelete=0;
                    foreach($stripeSubs as $value){
                        if($check->stripe_id == $value->id){
                            $canDelete++;
                        }
                        //error_log('foreach 3 done');
                    }


                    if($canDelete==0){
                        DB::table('subscriptions')->where('user_id', $user->id)->where('stripe_id',$check->stripe_id)->update(['stripe_status'=>'ended']);
                    }
                    //error_log('foreach 2 done');
                }
                $counter++;
                error_log('foreach 1 done: ' . $counter);
            }
        //});

    }
}
