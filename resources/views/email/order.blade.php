@component('mail::message')
Dear {{ $order->billing->first_name }},
<p>Your order {{ $order->reference  }} has been received.</p>

@component('mail::table')
| Items |      |
| :--- | :----|
@foreach ($order->orderItems as $item)
| {{$item->product->name}} x {{$item->quantity}} | {{$item->currency}}{{number_format($item->total)}} |
@endforeach
| <strong>Total</strong> | <strong>{{ $order->currency }}{{number_format($order->totalAmount)}}</strong>
@endcomponent

@component('mail::table')
| Billing |      |
| :--------- | ---: |
| Name | {{$order->billing->first_name}} {{$order->billing->last_name}}
| Address | {{$order->billing->address->address}}
| City | {{$order->billing->address->city->name}}
| State | {{$order->billing->address->state->name}}
| Country | {{$order->billing->address->country->name}}
@endcomponent


@component('mail::table')
| Shipping |      |
| :---------- | ---: |
| Name | {{$order->shipping->first_name}} {{$order->shipping->last_name}}
| Address | {{$order->shipping->address->address}}
| City | {{$order->shipping->address->city->name}}
| State | {{$order->shipping->address->state->name}}
| Country | {{$order->shipping->address->country->name}}
@endcomponent

@component('mail::button', ['url' => route('order.view', [$order->reference])])
    View Order
@endcomponent

Regards,

{{ config('business.name') }}
@endcomponent
