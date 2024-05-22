<input type="email" {{ $attributes->merge(['class' => 'form-control']) }} onclick="{{@$onclick}}" value="{{ @$value ? $value : ''  }}" name="{{@$name}}" id="{{@$id}}" placeholder="{{ @$placeholder ? $placeholder : 'email@email.com'   }}">
<small>Formato: email@email.com</small>
