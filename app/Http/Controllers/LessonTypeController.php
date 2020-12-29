<?php

namespace App\Http\Controllers;

use App\Models\LessonType;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;

class LessonTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = auth()->user()->id;
        $isadmin = Role::all()->where('user_id', $userId)->first();

        if($isadmin){
            if($isadmin['admin'] == 1){
                return view('types/create');
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
        $type = new LessonType();
        $type->name = $requestArr['name'];
        $type->stripe_sub_id = $requestArr['stripe_sub_id'];
        $type->about = $requestArr['about'];

        $type->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonType  $lessonType
     * @return \Illuminate\Http\Response
     */
    public function show(LessonType $lessonType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonType  $lessonType
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonType $lessonType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonType  $lessonType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonType $lessonType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonType  $lessonType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonType $lessonType)
    {
        //
    }
}
