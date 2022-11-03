@if (isset($icon))
    <x-button.button-default {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn btn-lg d-sm-block d-md-none d-lg-none']) }} icon="{{$icon}}" ></x-button.button-default>
@else
    <x-button.button-default {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn btn-lg d-sm-block d-md-none d-lg-none']) }}>{{$slot}}</x-button.button-default>
@endif
    <x-button.button-default {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn d-none d-sm-none d-md-block d-lg-block']) }} icon="{{$icon}}" >{{$slot}}</x-button.button-default>

