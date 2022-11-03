
@if (session()->get('device'))
    @if (isset($icon))
        <x-button.a-default {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn btn-lg d-sm-block d-md-none d-lg-none']) }} icon="{{$icon}}" ></x-button.a-default>
    @else
        <x-button.a-default {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn btn-lg d-sm-block d-md-none d-lg-none']) }}>{{$slot}}</x-button.a-default>
    @endif
@else
    <x-button.a-default {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn d-none d-sm-none d-md-block d-lg-block']) }} icon="{{$icon}}" >{{$slot}}</x-button.a-default>
@endif
