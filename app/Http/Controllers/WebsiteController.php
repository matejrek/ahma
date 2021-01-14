<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LessonType;
use App\Models\Enrolls;
use App\Models\Subscriptions;
use App\Models\Lesson;
use App\Models\Progress;
use App\Models\LessonAccessLevel;
use DB;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = LessonType::all();
        return view('welcome', compact('lessons'));
    }

    public function soon()
    {
        return view('comingsoon');
    }

    public function courses()
    {
        $userId = auth()->user()->id;
        //$lessons = LessonType::all();

        
        //$enrolled = Enrolls::all()->where('user_id', $userId);
        /*$enrolled = DB::table('enrolls')->where('user_id', $userId)
                        ->leftJoin('lesson_types', 'id', '=', 'lesson_type_id')
                        ->select('name');

        $subscribed = DB::table('subscriptions')->where('user_id', $userId)
                        ->leftJoin('lesson_types', 'stripe_sub_id', '=', 'stripe_plan')
                        ->select('name');

        $remaining = DB::table('enrolls')->where('user_id', $userId)
                        ->leftJoin('lesson_types', 'id', '=', 'lesson_type_id')
                        ->select('name');*/
        //$enrolled = "";

        //$remaining = ""; //where not yet enrolled
        //$enrolled = Enrolls::doesntHave('lessonType.subscription.user')->get();
        
        $subscribed = LessonType::has('subscription.user')->get();
        //$subscribedLessonType = LessonType::has('subscription.user')->first();
        //$isActiveSub = Subscriptions::all()->where('stripe_plan', $subscribedLessonType->stripe_sub_id)->where('user_id', auth()->user()->id)->where('stripe_status', 'active');
        //$subscribed = Subscriptions::where('stripe_plan', $subscribedLessonType->stripe_sub_id)->where('user_id', auth()->user()->id)->where('stripe_status', 'active')->get();

        //$isEnrolled = Enrolls::where('user_id', auth()->user()->id);
        $enrolled = LessonType::doesntHave('enrolls.lessonType.subscription.user')->has('enrolls.lessonType')->get();
        

        $remaining = LessonType::doesntHave('enrolls')->get();

        
        //$userPaymentMethod = $user->paymentMethods();
        
        $user = auth()->user();
        $paymentMethods = $user->paymentMethods()->map(function($paymentMethod){
            return $paymentMethod->asStripePaymentMethod();
        });

        //return $isActiveSub;
        return view('courses/index', compact('enrolled', 'subscribed', 'remaining', 'paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $userId = auth()->user()->id;
        $course = LessonType::where('id', $id)->first();
        $subPlan = LessonType::has('subscription.user')->where('id', $id)->get();
        $progress = Progress::where('lesson_type_id', $id)->where('user_id', $userId)->first();

        $lessons = [];
        if($progress){
            $lessons = Lesson::all()->where('lesson_type_id', $id)->where('id', '<=', $progress->lesson_id)->sortByDesc('created_at');
        }
        else{
            //handle for no lessons to type "wait for 1st scheduled lesson"
        }


        /*$lessons = Lesson::join('lesson_access_levels', 'lessons.id', '=', 'lesson_access_levels.lesson_id')
            ->get()->where('lesson_type_id', $id)->where('lessons.id', '<=', $progress->lesson_id)->where('user_id', $userId)
            ->sortByDesc('created_at');*/

        return view('courses/course', compact('lessons', 'subPlan', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function faq()
    {
        return view('pages/faq');
    }



}
