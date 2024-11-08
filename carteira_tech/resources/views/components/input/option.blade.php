@props(['selected' => false])

<option {{ $attributes->merge(['id' => '','class' => '']) }} {{ @$selected ? 'selected' : '' }} value="{{@$value}}" {{$other}}>{{$slot}}</option>
