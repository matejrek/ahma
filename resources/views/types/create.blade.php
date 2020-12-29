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

        <form method="POST" action="/admin/lesson/type/store" class="mrsif-form">
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

            <input class="form-control" type="text" name="name" placeholder="Enter lesson type"><br/>
            <input class="form-control" type="text" name="stripe_sub_id" placeholder="Enter Stripe sub ID"><br/>

            <br/>
            <br/>
            <textarea id="contentTextArea" name="about">
            </textarea>
            <br/>
            <br/>
            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>


@endsection