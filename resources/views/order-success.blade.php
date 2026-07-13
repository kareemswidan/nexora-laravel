@extends('layouts.app')@section('title',__('ui.confirmed'))@section('content')<main class="success reveal"><i>✓</i><span>ORDER CONFIRMED</span><h1>{{ __('ui.confirmed') }}</h1><p>{{ __('ui.ready') }}</p><h2>{{ $order->order_number }}</h2><a href="{{ route('orders.track') }}">{{ __('ui.track') }} ↗</a></main>@endsection

