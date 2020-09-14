@extends('layouts.dashboard')

@section('content')
    <script>
        tinymce.init({
            selector: '#mytextarea',
            height: "600"
        });
    </script>

    <div class="container">

        <form method="POST" action="/lesson/{{$lesson->id}}/edit/save" class="mrsif-form">
            {{ csrf_field() }}

            @if(count($errors) >0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach( $errors->all() as $error) 
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <input class="form-control" type="text" name="title" placeholder="Enter lesson title" value="{{$lesson['title']}}"><br/>
            <input class="form-control" type="text" name="description" placeholder="Enter lesson description" value="{{$lesson['description']}}"><br/>

            <textarea id="mytextarea" name="content" value="{!!$lesson['content']!!}">
            </textarea>

            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>


@endsection