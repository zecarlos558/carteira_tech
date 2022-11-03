@props(['disabled' => false])

    <input type="number" {{ $attributes->merge(['class' => 'form-control']) }}
    step="{{ $step ? $step : 'any'  }}" min="{{ $min ? $min : '0'  }}" max="{{ $max ? $max : ''  }}"
        value="{{ $value>=0 ? $value : '' }}" name="{{$name}}" id="{{$id}}"
        placeholder="{{ $placeholder ? $placeholder : '' }}" {{ $disabled ? 'disabled' : '' }}
    >
