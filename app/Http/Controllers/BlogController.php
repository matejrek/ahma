<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogposts = Blog::orderBy('id', 'DESC')->paginate(10); //Blog::all();
        return view('pages/blog/blog', compact('blogposts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/blog/create');
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
        $blog= new Blog();
        $blog->title = $requestArr['title'];
        $blog->content = $requestArr['content'];
        $blog->image = "/images/blog-image.jpg";

        //create unque slug
        $uniqueslug = Str::slug($requestArr['title'], "-");
        
        $isslug = Blog::where('slug', '=', $uniqueslug)->first();
        if($isslug === null){

        }
        else{
            $cnt = 1;
            $tempslug = $uniqueslug."-".$cnt;
            $amnew = Blog::where('slug', '=',  $tempslug)->first();
            while( $amnew != null){
                $cnt++;
                $tempslug = $uniqueslug."-".$cnt;
                $amnew = Blog::where('slug', '=',  $tempslug)->first();
            }  
            $uniqueslug = $tempslug;
        }

        $blog->slug = $uniqueslug;

        $blog->save();

        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {   
        $blogposts = Blog::orderBy('id')->limit(3)->get();
        $blogpost = Blog::all()->where('slug', $slug)->first();
        return view('pages/blog/show', compact('blogpost', 'blogposts'));
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
