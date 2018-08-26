<form action="{{route('subscriptions.process_subscription')}}" method="POST">
    @csrf
    <input type="hidden" name="type" value="{{$product['type']}}">
    <input type="text" class="form-control"  name="coupon" 
        placeholder="{{ __("Tienes un cupón?")}}"/>
    <input type="hidden" name="plan" value="{{$product['plan']}}">
    <hr>
    <stripe-form
        stripe_key="{{env('STRIPE_KEY')}}"
        name="{{$product['name']}}"
        amount="{{$product['amount']}}"
        description="{{$product['description']}}">
    </stripe-form>
</form>