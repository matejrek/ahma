<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\Progress;
use App\Models\Role;

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
                return view('lessons/create');
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
        $requestArr = $request->all();
        $lesson = new Lesson();
        $lesson->user_id = auth()->user()->id;
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
        $lesson = Lesson::findOrFail($id);
        return view('lessons/show', compact('lesson'));
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


    public function send()
    {
        /*$to_name = 'RECEIVER_NAME';
        $to_email = 'matej_rek@ymail.com';

        $lesson = Lesson::all()->first();

        $data = array('title'=>$lesson->title, 'description' => $lesson->description, 'content'=>$lesson->content);


        Mail::send('mail', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email, $to_name)->subject('AHMAlearn.com');
            $message->from('lessons@mrsif.com','Learn KOREA with AHMAlearn.com');
        });*/

        $users = User::all();
        foreach($users as $user){
            //get user id
            $cuserid = $user['id'];
            //get his progress if he has any at all
            $progress = Progress::all()->where('user_id', $cuserid)->first();
            //if he has progress
            if($progress){
                //send next mail from progress
                $to_name = $user['name'];
                $to_email = $user['email'];


                $lesson = Lesson::all()->where('id', '>', $progress['lesson_id'])->first();

                if($lesson->count() > 1){

                    $data = array('title'=>$lesson->title, 'description' => $lesson->description, 'content'=>$lesson->content);

                    Mail::send('mail', $data, function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)->subject('AHMAlearn.com');
                        $message->from('lessons@mrsif.com','Learn KOREA with AHMAlearn.com');
                    });
                    //update progress
                    $cprogress = Progress::all()->where('user_id', $user['id'])->first();

                    $newid = $lesson['id'];

                    //\DB::table('progress')->where('id', $cprogress->id)->update('lesson_id', $newid);
                    Progress::all()->where('user_id', $user['id'])->first()->delete();
                    $newprog = new Progress();
                    $newprog->user_id = $user['id'];
                    $newprog->lesson_id = $lesson['id'];
                    $newprog->save();
                }
                else{
                    //user's progress is on last lesson so skip email till new lesson is added
                }

            }
            else{
                //send first mail
                $to_name = $user['name'];
                $to_email = $user['email'];

                $lesson = Lesson::all()->first();

                $data = array('title'=>$lesson->title, 'description' => $lesson->description, 'content'=>$lesson->content);

                Mail::send('mail', $data, function($message) use ($to_name, $to_email){
                    $message->to($to_email, $to_name)->subject('AHMAlearn.com');
                    $message->from('lessons@mrsif.com','Learn KOREA with AHMAlearn.com');
                });
                //create progress
                $newprogress = new Progress();
                $newprogress->user_id = $user['id'];
                $newprogress->lesson_id = $lesson->id;
                $newprogress->save();
            }

        }

        return redirect('/lessons');
    }
}
