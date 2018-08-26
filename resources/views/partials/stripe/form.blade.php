<form action="{{route('subscriptions.process_subscription')}}" method="POST">
    @csrf
    <input type="hidden" name="type" value="monthly">
    <input type="text" class="form-control" name="coupon" 
        placeholder="{{ __("Tienes un cupón?")}}"/>
    <input type="hidden" name="plan" value="prod_DTjVH9FJWpJmCV">
    <hr>
    <stripe-form
        stripe_key="{{env('STRIPE_KEY')}}"
        name="{{$product['name']}}"
        amount="{{$product['amount']}}"
        description="{{$product['description']}}">
    </stripe-form>
</form>