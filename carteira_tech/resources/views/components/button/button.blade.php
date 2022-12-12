@if (session()->get('device'))
    @if (isset($icon))
        @if (checkButton($icon))
        <x-button.button-default {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn btn-lg']) }} icon="{{$icon}}" ></x-button.button-default>
        @else
        <x-button.button-default {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn btn-lg']) }} icon="{{$icon}}" >{{$slot}}</x-button.button-default>
        @endif
    @else
        <x-button.button-default {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn btn-lg']) }}>{{$slot}}</x-button.button-default>
    @endif
@else
    <x-button.button-default {{ $attributes->merge(['style' => '','data-bs-target' => '','data-bs-toggle' => '','type' => '','class' => 'btn']) }} icon="{{$icon}}" >{{$slot}}</x-button.button-default>
@endif
