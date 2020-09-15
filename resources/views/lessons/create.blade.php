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

        <form method="POST" action="/lesson/store" class="mrsif-form">
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

            <input class="form-control" type="text" name="title" placeholder="Enter lesson title"><br/>
            <input class="form-control" type="text" name="description" placeholder="Enter lesson description"><br/>

            <label>Content</label>
            <textarea id="contentTextArea" name="content">
            </textarea>
            <br/>
            <br/>

            <label>Extras</label>
            <textarea id="extrasTextArea" name="extras">
            </textarea>

            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>


@endsection