@extends('layouts.courses')


@section('content')
   <div class="container">
        <div class="heading">
            <h1>Courses</h1>
        </div>


        <div class="courseList">
            @foreach($subscribed as $item)
                <div class="item">
                    <a href="course/{{$item->id}}" class="box">
                        <!--div class="learn">
                            <img src="{{ URL::to('/') }}/img/lang/south-korea.svg" />
                        </div>
                        <div class="lang">
                            <img src="{{ URL::to('/') }}/img/lang/united-kingdom.svg" />
                        </div-->
                        <h3>{{$item->name}}</h3>
                        <p>This curriculum is in english.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s

                        </p>
                        <span class="button">Go to course</span>
                    </a>
                    <div class="button subscribed">
                        Active subscription
                    </div>
                </div>
            @endforeach

            @foreach($enrolled as $item)
                <div class="item">
                    <div class="box">
                        <!--div class="learn">
                            <img src="{{ URL::to('/') }}/img/lang/south-korea.svg" />
                        </div>
                        <div class="lang">
                            <img src="{{ URL::to('/') }}/img/lang/united-kingdom.svg" />
                        </div-->
                        <h3>
                            <a href="course/{{$item->id}}">
                                {{$item->name}}
                            </a>
                        </h3>
                        <p>
                            This curriculum is in english.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                        </p>
                        <a href="course/{{$item->id}}" class="button">
                            Go to course
                        </a>
                    </div>
                    <a href="course/subscribe/{{$item->id}}" class="button subscribe">
                        Subscribe
                    </a>
                </div>
            @endforeach

            @foreach($enrolled as $item)
                <div class="item">
                    <div class="box">
                        <!--div class="learn">
                            <img src="{{ URL::to('/') }}/img/lang/south-korea.svg" />
                        </div>
                        <div class="lang">
                            <img src="{{ URL::to('/') }}/img/lang/united-kingdom.svg" />
                        </div-->
                        <h3>
                            <a href="course/{{$item->id}}">
                                {{$item->name}}
                            </a>
                            {{--<a href="lesson/{{$item->id}}">
                                {{$item->name}}
                            </a>--}}
                        </h3>
                        <p>
                            This curriculum is in english.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                        </p>
                        <a href="course/{{$item->id}}" class="button">
                            Go to course
                        </a>
                    </div>
                    <a href="course/enroll/{{$item->id}}" class="button enroll">
                        Enroll
                    </a>
                </div>
            @endforeach

        </div>

    
@endsection

