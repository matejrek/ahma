@extends('layouts.dashboard')


@section('content')
    <div class="heading">
        <h1>Lessons</h1>
    </div>

    <div class="container">
        <ul>
        @foreach($lessons as $item)
            <li>
                <a href="lesson/{{$item->id}}">
                    {{ $item['title'] }}
                </a>
                |
                <a href="lesson/edit/{{$item->id}}">
                    Edit
                </a>
                |
                <a href="lesson/delete/{{$item->id}}">
                    Delete
                </a>
            </li>
        @endforeach
        </ul>

        <a class="btn btn-primary" href="/lesson/create">Create new lesson</a>
    </div>
@endsection




