@if (session()->get('device'))
    @if (isset($icon))
        <x-button.reset-default {{ $attributes->merge(['data-bs-toggle' => '','type' => 'reset','class' => 'btn btn-lg']) }} icon="{{$icon}}"></x-button.reset-default>
    @else
        <x-button.reset-default  {{ $attributes->merge(['data-bs-toggle' => '','type' => 'reset','class' => 'btn btn-lg']) }} icon="{{$icon}}" >{{$slot}}</x-button.reset-default>
    @endif
@else
    <x-button.reset-default  {{ $attributes->merge(['data-bs-toggle' => '','type' => 'reset','class' => 'btn']) }} icon="{{$icon}}" >{{$slot}}</x-button.reset-default>
@endif
