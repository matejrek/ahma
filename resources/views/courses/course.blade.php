@extends('layouts.courses')


@section('content')
   <div class="container">
        <div class="heading">
            <h1>{{$course->name}}</h1>
        </div>
        <div class="courseAbout">
            <div class="headingAbout">
                Introduction
            </div>
            <div class="contentAbout">
                {!!$course->about!!}
            </div>
        </div>
        
        @if($subPlan->isEmpty())
            <div class="subscribe">
                Subscribe to this course to get the most benefits <a href="/subscribe/{{$course->id}}" class="button">Subscribe</a>
            </div>
        @endif

        <div class="lessonList">
            @foreach($lessons as $item)
                <div class="item">
                    <a href="/course/lesson/{{$item->id}}" class="lesson">
                        {{$item->title}}
                    </a>
                </div>
            @endforeach
        </div>

        {{--<div class="lessonList">
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

        </div>--}}
    <script>
        $(function(){
            $('.headingAbout').on('click', function(){
                $(this).toggleClass('active');
                $(this).next().toggle();
            });
        });
    </script>

    
@endsection

