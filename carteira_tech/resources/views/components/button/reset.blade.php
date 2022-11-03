@if (isset($icon))
<x-button.reset-default {{ $attributes->merge(['data-bs-toggle' => '','type' => 'reset','class' => 'btn btn-lg d-sm-block d-md-none d-lg-none']) }} icon="{{$icon}}"></x-button.reset-default>
@else
<x-button.reset-default  {{ $attributes->merge(['data-bs-toggle' => '','type' => 'reset','class' => 'btn btn-lg d-sm-block d-md-none d-lg-none']) }} icon="{{$icon}}" >{{$slot}}</x-button.reset-default>
@endif
<x-button.reset-default  {{ $attributes->merge(['data-bs-toggle' => '','type' => 'reset','class' => 'btn d-none d-sm-none d-md-block d-lg-block']) }} icon="{{$icon}}" >{{$slot}}</x-button.reset-default>
