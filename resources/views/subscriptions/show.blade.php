
@extends('layouts.dashboard')


@section('content')
    <div class="container">

        <h1>{{$lesson->title}}</h1>
        <hr/>
        <p>{{$lesson->description}}</p>
        <hr/>
        {!! $lesson->content !!}
        <hr/>
        {!! $lesson->extras !!}
    </div>
@endsection

