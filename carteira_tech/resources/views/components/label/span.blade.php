
@if (session()->get('device'))
    @if (isset($icon))
        <x-label.span-default {{ $attributes->merge(['title' => '','data-bs-toggle' => '','id' => '','class' => 'd-sm-block d-md-none d-lg-none']) }} icon="{{$icon}}"></x-label.span-default>
    @else
        <x-label.span-default {{ $attributes->merge(['title' => '','data-bs-toggle' => '','id' => '','class' => 'd-sm-block d-md-none d-lg-none']) }} >{{$slot}}</x-label.span-default>
    @endif
@else
    <x-label.span-default {{ $attributes->merge(['title' => '','data-bs-toggle' => '','id' => '','class' => 'd-none d-sm-none d-md-block d-lg-block']) }} icon="{{$icon}}">{{$slot}}</x-label.span-default>
@endif



