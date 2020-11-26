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
        return view('lessons/index', compact('lessons'));
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
                return view('lessons/create', compact('types'));
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/');
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

        return redirect('/');
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
        $courseId = Lesson::select('lesson_type_id')->where('id', $id)->first();
        $subPlan = LessonType::has('subscription.user')->where('id', $courseId->lesson_type_id)->get();
        $course = LessonType::where('id', $courseId->lesson_type_id)->first();
        $lesson = Lesson::findOrFail($id);
        return view('courses/lesson', compact('lesson', 'subPlan', 'course'));
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
        return view('lessons/edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        Lesson:all()->whereId($id)->delete();

        $requestArr = $request->all();
        $lesson = new Lesson();
        $lesson->user_id = auth()->user()->id;
        $lesson->title = $requestArr['title'];
        $lesson->description = $requestArr['description'];
        $lesson->content = $requestArr['content'];


        $lesson->save();

        return redirect('/lessons');
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

        return redirect('/lessons');
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


    public function send()
    {
        /*$enrolls = Enrolls::all();
      
        foreach($enrolls as $enroll){
            $cuserid = $enroll['user_id'];
            $clessonType = $enroll['lesson_type_id'];
            //check for progress on lesson type
            $progress = Progress::all()->where('user_id', $cuserid)->where('lesson_type_id', $clessonType)->first();

            if($progress){
                error_log("has progress: ".$progress);
                $lesson = Lesson::all()->where('lesson_type_id', $clessonType)->where('id', '>' , $progress['lesson_id'])->first();
                error_log("get next lesson: ".$lesson);

                if($lesson){
                    error_log("new lesson exists...");

                    $oldProgress = Progress::all()->where('user_id', $cuserid)->where('lesson_type_id', $clessonType)->first();
                    $oldProgress->delete();
                    error_log("deleted old progress: " . $oldProgress);

                    $newProgress = new Progress();
                    $newProgress->user_id = $cuserid;
                    $newProgress->lesson_id = $lesson->id;
                    $newProgress->lesson_type_id = $clessonType;
                    $newProgress->save();

                    $subscribed = LessonType::has('subscription.user')->where('id', $clessonType)->first();
                    $premium=false;
                    if($subscribed!=null){
                        $premium=true;
                    }
                    error_log("is premium: ".$premium);
                    //create record for lesson and if premium
                    $newAccessLevel = new LessonAccessLevel();
                    $newAccessLevel->user_id = $cuserid;
                    $newAccessLevel->lesson_type_id = $clessonType;
                    $newAccessLevel->lesson_id = $lesson->id;
                    $newAccessLevel->premium = $premium;
                    $newAccessLevel->save();
                }
                else{
                    //no new lesson, dont send...
                }

            }
            else{
                error_log("has no progress: ".$progress);
                $lesson = Lesson::all()->where('lesson_type_id', $clessonType)->first();
                error_log("sending first: ".$lesson);

                //send mail

                $newProgress = new Progress();
                $newProgress->user_id = $cuserid;
                $newProgress->lesson_id = $lesson->id;
                $newProgress->lesson_type_id = $clessonType;
                $newProgress->save();

                $subscribed = LessonType::has('subscription.user')->where('id', $clessonType)->first();
                $premium=false;
                if($subscribed!=null){
                    $premium=true;
                }
                error_log("is premium: ".$premium);
                //create record for lesson and if premium
                $newAccessLevel = new LessonAccessLevel();
                $newAccessLevel->user_id = $cuserid;
                $newAccessLevel->lesson_type_id = $clessonType;
                $newAccessLevel->lesson_id = $lesson->id;
                $newAccessLevel->premium = $premium;
                $newAccessLevel->save();
            }
        }*/
        
        /*$enrolls = Enrolls::all();
      
        foreach($enrolls as $enroll){
            $cuserid = $enroll['user_id'];
            $clessonType = $enroll['lesson_type_id'];
            //check for progress on lesson type
            $progress = Progress::all()->where('user_id', $cuserid)->where('lesson_type_id', $clessonType)->first();

            if($progress){
                //error_log("has progress: ".$progress);
                $lesson = Lesson::all()->where('lesson_type_id', $clessonType)->where('id', '>' , $progress['lesson_id'])->first();
                //error_log("get next lesson: ".$lesson);

                if($lesson){
                    //error_log("new lesson exists...");

                    $oldProgress = Progress::all()->where('user_id', $cuserid)->where('lesson_type_id', $clessonType)->first();
                    $oldProgress->delete();
                    //error_log("deleted old progress: " . $oldProgress);

                    $newProgress = new Progress();
                    $newProgress->user_id = $cuserid;
                    $newProgress->lesson_id = $lesson->id;
                    $newProgress->lesson_type_id = $clessonType;
                    $newProgress->save();

                    $subscribed = LessonType::has('subscription.user')->where('id', $clessonType)->first();
                    $premium=false;
                    if($subscribed!=null){
                        $premium=true;
                    }

                    $data = array('title'=>$lesson->title, 'description' => $lesson->description, 'content'=>$lesson->content);
                    $user = User::all()->where('id',$cuserid)->first();
                    
                    $to_name = $user['name'];
                    $to_email = $user['email'];

                    error_log("USER:" . $user . "####NAME:" . $user['name'] . "EMAIL:" . $user['email']);
                    Mail::send('mail', $data, function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)->subject('AHMAlearn.com');
                        $message->from('lessons@mrsif.com','Learn KOREA with AHMAlearn.com');
                    });
                    //error_log("is premium: ".$premium);
                    //create record for lesson and if premium
                    $newAccessLevel = new LessonAccessLevel();
                    $newAccessLevel->user_id = $cuserid;
                    $newAccessLevel->lesson_type_id = $clessonType;
                    $newAccessLevel->lesson_id = $lesson->id;
                    $newAccessLevel->premium = $premium;
                    $newAccessLevel->save();
                }
                else{
                    //no new lesson, dont send...
                }

            }
            else{
                //error_log("has no progress: ".$progress);
                $lesson = Lesson::all()->where('lesson_type_id', $clessonType)->first();
                //error_log("sending first: ".$lesson);

                //send mail

                $newProgress = new Progress();
                $newProgress->user_id = $cuserid;
                $newProgress->lesson_id = $lesson->id;
                $newProgress->lesson_type_id = $clessonType;
                $newProgress->save();

                $subscribed = LessonType::has('subscription.user')->where('id', $clessonType)->first();
                $premium=false;
                if($subscribed!=null){
                    $premium=true;
                }

                $data = array('title'=>$lesson->title, 'description' => $lesson->description, 'content'=>$lesson->content);
                $user = User::all()->where('id',$cuserid)->first();
                
                $to_name = $user['name'];
                $to_email = $user['email'];

                error_log("USER:" . $user . "####NAME:" . $user['name'] . "EMAIL:" . $user['email']);
                Mail::send('mail', $data, function($message) use ($to_name, $to_email){
                    $message->to($to_email, $to_name)->subject('AHMAlearn.com');
                    $message->from('lessons@mrsif.com','Learn KOREA with AHMAlearn.com');
                });
                //error_log("is premium: ".$premium);
                //create record for lesson and if premium
                $newAccessLevel = new LessonAccessLevel();
                $newAccessLevel->user_id = $cuserid;
                $newAccessLevel->lesson_type_id = $clessonType;
                $newAccessLevel->lesson_id = $lesson->id;
                $newAccessLevel->premium = $premium;
                $newAccessLevel->save();
            }
        }*/


        
        //return redirect('/lessons');
        sendMails::dispatch();//you can use chunk method and pass your $users as params
        return redirect('/lessons');
    }
}
