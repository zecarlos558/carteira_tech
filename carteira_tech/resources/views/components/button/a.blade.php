@if (session()->get('device'))
    @if (isset($icon))
        <x-button.a-default {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn btn-lg']) }} icon="{{$icon}}" ></x-button.a-default>
    @else
        <x-button.a-default {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn btn-lg']) }}>{{$slot}}</x-button.a-default>
    @endif
@else
    <x-button.a-default {{ $attributes->merge(['data-bs-toggle' => '','href' => '','class' => 'btn ']) }} icon="{{$icon}}" >{{$slot}}</x-button.a-default>
@endif
