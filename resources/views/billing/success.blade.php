@extends('layouts.payment')


@section('content')
    <div class="paymentProcessNotification textCenter">
        <h1>Payment successful!</h1>
        <p>You will soon be redirected to the main app. If not press the button below:</p>
        <a class="button" href="/courses">Go to courses</a>
        <p><span id="count">5</span></p>
    </div>
  
    <script>
        $(function(){
            var counter = 5;

            setInterval(function() {
                counter--;
                if (counter >= 0) {
                    span = document.getElementById("count");
                    span.innerHTML = counter;
                }
                if (counter === 0) {
                    clearInterval(counter);
                }
            }, 1000);

            setTimeout(function(){
                window.location.href = '/courses';
            }, 5000);
        });
    </script>

    
@endsection

