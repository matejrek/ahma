@extends('layouts.dashboard')

@section('content')
    <script>
        tinymce.init({
            selector: '#contentTextArea',
            height: "600"
        });
        tinymce.init({
            selector: '#extrasTextArea',
            height: "600"
        });
    </script>

    <div class="container">

        <form method="POST" action="/admin/lesson/{{$lesson->id}}/edit/save" class="mrsif-form">
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

            <label>Content</label>
            <textarea id="contentTextArea" name="content" value="{!!$lesson['content']!!}
            </textarea>

            <br/><br/>
            <label>Extras</label>
            <textarea id="extrasTextArea" name="extras" value="{!!$lesson['extras']!!}
            </textarea>


            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>


@endsection