@props([
    'selected' => false,
    'checked' => false
])

<input type="radio" {{ $attributes->merge(['onclick' => '']) }} class="{{ $class ? $class : "{{!! $attributes->merge(['class' => 'form-control']) !!}}"  }}" {{ $checked ? 'checked' : '' }} {{ $selected ? 'selected' : '' }} value="{{ $value ? $value : ''  }}" name="{{$name}}" id="{{$id}}">{{$slot}}
