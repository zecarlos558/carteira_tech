@props(['disabled' => false,
        'checked' => false
])

    <input type="checkbox" {{ $attributes->merge(['class' => 'form-check-input']) }} name="{{@$name}}" id="{{@$id}}" {{ @$checked ? 'checked' : '' }} {{ @$disabled ? 'disabled' : '' }} value="{{@$value}}"  onclick="{{ @$onclick ? $onclick : ''}}">
