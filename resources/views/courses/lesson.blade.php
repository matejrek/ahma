@extends('layouts.courses')


@section('content')

        <div class="heading">
            <h1>{{$lesson->title}}</h1>
        </div>
        
        @if($subPlan->isEmpty())
            <div class="subscribeNotice">
                Subscribe to this course to get the extended content <a href="/course/subscribe/{{$course->id}}" class="button">Subscribe</a>
            </div>
        @endif 

        <div class="lesson">
            <div class="dashPanel">
            <div class="content">
                {!!$lesson->content!!}
            </div>
            </div>

            @if($accessLevel->premium == 0)
                <div class="subscribeNotice">
                    To unlock extra content for lessons you unlocked while you were not subscribed <div onclick="getLessonData()" class="button">Purchase lesson extras</div>
                </div>
            @else
                <div class="dashPanel">
                    <h4>Extras:</h4>
                    <div class="extras">
                        {!!$lesson->extras!!}
                    </div>
                </div>
            @endif
        </div>


      
@endsection

<script src="https://js.stripe.com/v3/"></script>

<script>

    function getLessonData(){
        var lessonId = @json($lesson->id);
        $.ajax({
            type: 'GET',
            url: '/unlockLessonData/'+lessonId+'',
            success: function (data){
                console.log(data);

                /*const value = Object.values(data).map(e => e.value)
                console.log(value)

                const label = Object.values(data).map(e => e.created_at)
                console.log(label)*/

                //rebuild graph
                payOne(data)
            },
            error: function(e){
                //console.log(e);
            }
        });
    }

    function payOne(params){
        const stripe = Stripe('pk_test_51HT7trLFv1NQex0wDGt418pRQVPj2yb8LvhvDotXwV3Ve6xp56hyYXy5txlYCgwG8WXMrRgrBe8b2Ip0FwBm1pqc00U7EQSuh8');

        stripe.redirectToCheckout({
        lineItems: [{
            price: 'price_1He4fkLFv1NQex0w239HmfiN', // Replace with the ID of your price
            quantity: 1,
        }],
        mode: 'payment',
            successUrl: 'http://127.0.0.1:8000/single/success?session_id={CHECKOUT_SESSION_ID}'+params+'',  // add param here
            cancelUrl: 'http://127.0.0.1:8000/single/cancel',
        }).then(function (result) {
            // If `redirectToCheckout` fails due to a browser or network session_id=cs_test_bWvOwplvj2pWX06DtA7D6HKjuZAh5Hzk3bFKmCMxHiJldwcygmcMxGcn
            // error, display the localized error message to your customer session_id=cs_test_saE64rbF4irnVFPhkw4BmYl9kbXD1n5QnwjfeHKvw55dW6MFawuQhovu
            // using `result.error.message`. 
            /*
                session = Stripe::Checkout::Session.retrieve(params[:session_id])
                customer = Stripe::Checkout::Customer.retrieve(session.customer)
                shranjujem oid- orderId pa session id na success in dam enabled, 
            */
        });
    }
</script>