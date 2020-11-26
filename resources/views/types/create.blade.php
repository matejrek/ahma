@extends('layouts.dashboard')

@section('content')


    <div class="container">

        <form method="POST" action="/lesson/type/store" class="mrsif-form">
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

            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>


@endsection