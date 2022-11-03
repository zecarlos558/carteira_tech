<x-div.label>
    <label {{ $attributes->merge(['class' => '']) }} for="{{ $for ? $for : ''  }}" >{{$slot}}</label>
</x-div.label>
