@extends('layouts.dashboard')


@section('content')
    <div class="heading">
        <h1>Lessons</h1>
    </div>

    <div class="container">
        <ul>
        @foreach($lessons as $item)
            <li>
                <a href="lesson/{{$item->id}}">
                    {{ $item['title'] }}
                </a>
                |
                <a href="lesson/edit/{{$item->id}}">
                    Edit
                </a>
                |
                <a href="lesson/delete/{{$item->id}}">
                    Delete
                </a>
            </li>
        @endforeach
        </ul>
        
        <hr/>
        <ul>
            <li><a href="/billing">Manage your billing</a></li>
            <li><a href="/update">Update card info</a></li>
            <li><a href="/subenkr">Sub EN-KR</a></li>
            <li><a href="/subende">Sub EN-DE</a></li>
            <li><a href="/getallsubs">Update subs</a></li>
        </ul>


        <hr/>
            <input id="payOne" type="button" value="payOne" onclick="payOne();" />
        <hr/>

        <a class="btn btn-primary" href="/lesson/create">Create new lesson</a>
    </div>
@endsection



<script src="https://js.stripe.com/v3/"></script>

<script>

    function payOne(){

    const stripe = Stripe('pk_test_51HT7trLFv1NQex0wDGt418pRQVPj2yb8LvhvDotXwV3Ve6xp56hyYXy5txlYCgwG8WXMrRgrBe8b2Ip0FwBm1pqc00U7EQSuh8');


    stripe.redirectToCheckout({
    lineItems: [{
        price: 'price_1He4fkLFv1NQex0w239HmfiN', // Replace with the ID of your price
        quantity: 1,
    }],
    mode: 'payment',
    successUrl: 'http://127.0.0.1:8000/single/success?session_id={CHECKOUT_SESSION_ID}&oid=12345',  // add param here
    cancelUrl: 'https://example.com/single/cancel',
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
