@extends('layouts.page')


@section('content')
        <div class="pageContainer">
            <div class="sidebar">
                Sidebar
            </div>
            <div class="content">
                <div class="heading">
                    <h1>Blog</h1>
                </div>
                <div class="blogList">
                    @foreach($blogposts as $item)
                        <div class="item">
                            <a href="blog/{{$item->slug}}" class="link">
                                <h2 class="title">{{$item->slug}}</h2>
                                <div class="summary">
                                    {!!Str::of($item->content)->limit(120)!!}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="ahmaPager">
                    {!!$blogposts->links("pagination::bootstrap-4")!!}
                </div>
            </div>
        </div>

@endsection