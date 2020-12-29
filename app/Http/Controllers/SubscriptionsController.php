<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Enrolls;
use App\Models\LessonType;
use DB;

use App\Jobs\checkSubscription;

class SubscriptionController extends Controller
{
    public function billingPortal(Request $request)
    {
        $request->user()->createOrGetStripeCustomer();

        return $request->user()->redirectToBillingPortal(
            route('courses')
        );
    }

    /*public function updatePaymentMethod(Request $request){

        $user = $request->user();
        return view('payment/update', [
            'intent' => $user->createSetupIntent()
        ]);
    }*/


    public function createSubscription(Request $request){
        //handle if already subscribed
        $user = $request->user();
        $paymentMethod = $user->defaultPaymentMethod()->paymentMethod;
        $user->newSubscription('default', 'price_1HT8OpLFv1NQex0wD3CFgNab')->create($paymentMethod);

        return redirect('/lessons');
    }
    public function createSubscriptionENDE(Request $request){
        //handle if already subscribed
        $user = $request->user();
        $paymentMethod = $user->defaultPaymentMethod()->paymentMethod;
        $user->newSubscription('default', 'price_1HVLeWLFv1NQex0wRM7bKuFF')->create($paymentMethod);

        return redirect('/lessons');
    }

    public function createNewSubscription(Request $request, $sub){
        //if not yet enrolled, enroll
        $hasEnrolled = Enrolls::where('user_id', $request->user()->id)->where('lesson_type_id', $sub);
        if($hasEnrolled){}
        else{
            //$any = Enrolls::all()->where('user_id', auth()->user()->id)->where('lesson_type_id', $id);
            $enroll = new Enrolls();
            $enroll->user_id = auth()->user()->id;
            $enroll->lesson_type_id = $sub;
            $enroll->save();
        }

        //handle if already subscribed
        $user = $request->user();
        $sub_key = LessonType::select('stripe_sub_id')->where('id', $sub)->get();
        $paymentMethod = $user->defaultPaymentMethod()->paymentMethod;
        
        $user->newSubscription('default', $sub_key)->create($paymentMethod);

        return redirect('/courses');
    }


    public function UpdateStatus(){
        //return $request->user()->asStripeCustomer()->subscriptions->all();
        //$userStripeId = User::select('stripe_id')->where('id',1)->get();

        

        //$users = User::all();
        //User::chunk(50, function ($users) {
            /*foreach($users as $user){
                $user->createOrGetStripeCustomer();
                $stripeSubs = $user->asStripeCustomer()->subscriptions->all();
                $dbSubs = DB::table('subscriptions')->select('stripe_id')->where('user_id', $user->id)->get();
                foreach($dbSubs as $check){
                    $canDelete=0;
                    foreach($stripeSubs as $value){
                        //echo "stripeSubs: " . $check->stripe_id . ", value: " . $value->id . "##### \n\n";
                        if($check->stripe_id == $value->id){
                            $canDelete++;
                        }
                    }


                    if($canDelete==0){
                        DB::table('subscriptions')->where('user_id', $user->id)->where('stripe_id',$check->stripe_id)->update(['stripe_status'=>'ended']);
                        //echo $check->stripe_id;
                    }
                }
                
                //echo $user;
            }*/
        //});

        //$stripeSubs = $request->user()->asStripeCustomer()->subscriptions->all();
        

        /*foreach($stripeSubs->data as $newdata){
            echo $newdata->id;
        }*/
        /*$users = User::all();
        foreach($users as $user){
            $subs = $request->user()->asStripeCustomer()->subscriptions->all();
            foreach($lesson->data as $newdata){
                $newdata->id;
                
            }
        }*/
        //delete all records where user id = this and newdataid != tti

        //return redirect('/dashboard');
        checkSubscription::dispatch();//you can use chunk method and pass your $users as params
        return redirect('/courses');

    }   
}
