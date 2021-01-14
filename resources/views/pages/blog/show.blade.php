@extends('layouts.page')


@section('content')
        <div class="blogPostSidebar">
            <a class="backToList" href="/blog"><i class="fas fa-chevron-left"></i> Back to blog list</a>

            <div class="sideTitle">
                Other blogs
            </div>
            <div class="sideBlogList">
                @foreach($blogposts as $item)
                    <div class="item">
                        <a href="/blog/{{$item->slug}}" class="link">
                            <div class="title">{{$item->slug}}</div>
                            <div class="summary">
                                {!!Str::of($item->content)->limit(120)!!}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="blogPost">
            <div class="blogPanel">
                <div class="blogPostHeading">
                    <h1>{{$blogpost->title}}</h1>
                </div>
                <div class="blogPostContent">
                    {!!$blogpost->content!!}
                </div>
            </div>
        </div>

@endsection