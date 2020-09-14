<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

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
        return view('lessons/create');
    }

    public function new()
    {
        return view('lessons/create');
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
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
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


    public function send()
    {
        $to_name = 'RECEIVER_NAME';
        $to_email = 'matej_rek@ymail.com';

        $lesson = Lesson::all()->first();

        $data = array('title'=>$lesson->title, 'description' => $lesson->description, 'content'=>$lesson->content);


        Mail::send('mail', $data, function($message) use ($to_name, $to_email){
            $message->to($to_email, $to_name)->subject('AHMAlearn.com');
            $message->from('lessons@mrsif.com','Learn KOREA with AHMAlearn.com');
        });

        return view('welcome');
    }
}
