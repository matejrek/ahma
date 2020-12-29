<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Progress;
use App\Models\Role;
use App\Models\LessonType;
use App\Models\Enrolls;
use App\Models\LessonAccessLevel;
use App\Models\SinglePurchase;

use App\Jobs\sendMails;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::all()->where('user_id', auth()->user()->id);
        //return $routines->toJson(JSON_PRETTY_PRINT);
        return view('admin/index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //Role::all()->where('user_id', $userId)->where('admin', 1)->first();
        $userId = auth()->user()->id;
        $isadmin = Role::all()->where('user_id', $userId)->first();

        if($isadmin){
            if($isadmin['admin'] == 1){
                $types = LessonType::all();
                return view('admin/create', compact('types'));
            }
            else{
                return redirect('/admin');
            }
        }
        else{
            return redirect('/admin');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $requestArr = $request->all();
        $lesson = new Lesson();
        $lesson->user_id = auth()->user()->id;
        $lesson->lesson_type_id = $requestArr['lesson_type'];
        $lesson->title = $requestArr['title'];
        $lesson->description = $requestArr['description'];
        $lesson->content = $requestArr['content'];
        $lesson->extras = $requestArr['extras'];

        $lesson->save();

        return redirect('/admin');
    }

    public function course($id)
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
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    //public function show(Lesson $lesson)
    public function show($id)
    {
        $userId = auth()->user()->id;
        $courseId = Lesson::select('lesson_type_id')->where('id', $id)->first();
        $subPlan = LessonType::has('subscription.user')->where('id', $courseId->lesson_type_id)->get();
        $course = LessonType::where('id', $courseId->lesson_type_id)->first();
        $lesson = Lesson::findOrFail($id);
        $accessLevel = LessonAccessLevel::where('lesson_id', $id)->where('user_id', $userId)->first();
        //if accesslevel doesnt exist for some reason
        if(!$accessLevel){
            $accessLevel = new LessonAccessLevel();
            $accessLevel->premium = 0;
        }
        
        return view('courses/lesson', compact('lesson', 'subPlan', 'course', 'accessLevel'));
        //return $accessLevel;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('/admin/edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*Lesson::all()->whereId($id)->delete();

        $requestArr = $request->all();
        $lesson = new Lesson();
        $lesson->user_id = auth()->user()->id;
        $lesson->title = $requestArr['title'];
        $lesson->description = $requestArr['description'];
        $lesson->content = $requestArr['content'];*/
        

        $requestArr = $request->all();
        $lesson = Lesson::all()->where('id', $id)->first();
        //return $requestArr;
        $lesson->user_id = auth()->user()->id;
        $lesson->title = $requestArr['title'];
        $lesson->description = $requestArr['description'];
        $lesson->content = $requestArr['content'];
        $lesson->extras = $requestArr['extras'];

        $lesson->save();

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Lesson:all()->whereId($id)->delete();

        /*$requestArr = $request->all();
        $lesson = new Lesson();
        $lesson->user_id = auth()->user()->id;
        $lesson->title = $requestArr['title'];
        $lesson->description = $requestArr['description'];
        $lesson->content = $requestArr['content'];

        $lesson->save();*/

        return redirect('/admin/lessons');
    }

    public function enroll(Request $request, $id)
    {
        $any = Enrolls::all()->where('user_id', auth()->user()->id)->where('lesson_type_id', $id);

        $enroll = new Enrolls();
        $enroll->user_id = auth()->user()->id;
        $enroll->lesson_type_id = $id;
        $enroll->save();
        
        return redirect('/courses');
    }

    public function unlockLessonData($id){

        $lesson = Lesson::all()->where('id',$id)->first();
        $user_id = auth()->user()->id;

        return "&lid=".$lesson->id."&uid=".$user_id."&tid=".$lesson->lesson_type_id."";
    }

    public function singlePurchaseSuccess(Request $request){

        //$user_id = auth()->user()->id;
        $session_id = request()->session_id;
        $lid = request()->lid;
        $uid = request()->uid;
        $tid = request()->tid;

        //check if a purchase with this session id already exists
        $purchase = SinglePurchase::where('session_id',$session_id)->where('user_id', $uid)->first();
        if($purchase){
            //already exists -> error
            return "error";
            //return redirect('/single/error');
        }
        else{
            //proceed with purchase record
            $newSinglePurchase = new SinglePurchase();
            $newSinglePurchase->user_id = $uid;
            $newSinglePurchase->session_id = $session_id;
            $newSinglePurchase->lesson_id= $lid;
            $newSinglePurchase->save();

            //update access level
            $accessLevelUpdate = LessonAccessLevel::where('lesson_id', $lid)->where('user_id',$uid)->where('lesson_type_id',$tid)->first();
            if($accessLevelUpdate){
                $accessLevelUpdate->premium = true;
                $accessLevelUpdate->save();
            }
            else{
                $accessLevelUpdate = new LessonAccessLevel();
                $accessLevelUpdate->lesson_type_id = $tid;
                $accessLevelUpdate->lesson_id = $lid;
                $accessLevelUpdate->user_id = $uid;
                $accessLevelUpdate->premium = true;
                $accessLevelUpdate->save();
            }
            return redirect('/single/success/completed');
        }

        //return redirect('lesson/'.$lid.'');

        //return "Lesson id:".$lid." user id:".$uid." lesson type id:".$tid;
        //update access level redirect to that lesson 
    }

    public function singlePurchaseCancel(Request $request){
        /*$lessonData = Lesson::all()->where('user_id', auth()->user()->id)->where('id', $id)->first();*/
        return "purchase was canceled, retry";
    }

    public function singlePurchaseError(Request $request){
        /*$lessonData = Lesson::all()->where('user_id', auth()->user()->id)->where('id', $id)->first();*/
        return "There was an error with your purchase";
    }
    public function singlePurchaseCompleted(Request $request){
        return "Your single purchase was compelted successfully";
    }


/*
When you have an URI such as login?r=articles, you can retrieve articles like this:

request()->r
You can also use request()->has('r') to determine if it's present in the URI.

And request()->filled('r') to find out if it's present in the URI and its value is not empty.
*/


    public function send()
    {
        sendMails::dispatch();//you can use chunk method and pass your $users as params
        return redirect('/admin');
    }
}
