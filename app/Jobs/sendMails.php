<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Enrolls;
use App\Models\Lesson;
use App\Models\LessonAccessLevel;
use App\Models\LessonType;
use App\Models\Progress;
use App\Models\Role;

class sendMails implements ShouldQueue
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
        $enrolls = Enrolls::all();
      
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
                    //error_log("USER:" . $user);
                    $to_name = $user['name'];
                    $to_email = $user['email'];
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
                //error_log("USER:" . $user);
                $to_name = $user['name'];
                $to_email = $user['email'];
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
        }

    }
}
