<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LessonType;
use App\Models\Enrolls;
use App\Models\Subscriptions;
use App\Models\Lesson;
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
        $enrolled = LessonType::doesntHave('enrolls.lessonType.subscription.user')->has('enrolls.lessonType')->get();
        $remaining = LessonType::doesntHave('enrolls')->get();
        

        return view('courses/index', compact('enrolled', 'subscribed', 'remaining'));
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
        $course = LessonType::where('id', $id)->first();
        $subPlan = LessonType::has('subscription.user')->where('id', $id)->get();
        $lessons = Lesson::all()->where('lesson_type_id', $id)->sortByDesc('created_at');
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
}
