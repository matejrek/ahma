@extends('layouts.courses')


@section('content')

        <div class="heading">
            <h1>Support</h1>
        </div>
        <div class="supportTypes {{$type}}">
            <a class="support" href="/support">General support</a>
            <a class="feature-request" href="/feature-request">Feature request</a>
            <a class="billing" href="/billing-support">Billing support</a>
        </div>

        <div class="dashPanel">
            <form method="POST" action="/support/store" class="ahma-form">
                {{ csrf_field() }}

                <input class="form-control" type="hidden" name="type" value="{{$type}}">
                
                <textarea class="form-control" name="text" placeholder="Enter your message"></textarea>

                <input type="submit" name="submit" class="button terciary">
            </form>
        </div>

@endsection
