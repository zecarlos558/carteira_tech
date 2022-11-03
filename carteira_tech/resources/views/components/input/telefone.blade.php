<input type="text" {{ $attributes->merge(['class' => 'form-control']) }} onclick="{{$onclick}}" value="{{ $value ? $value : ''  }}" name="{{$name}}" id="{{$id}}" placeholder="{{ $placeholder ? $placeholder : '+5586912345678'   }}"
data-mask="+55860000-0000" pattern="+[5-5]{2}[0-9]{2}[9-9]{1}[0-9]{4}[0-9]{4}">
<small>Formato: +5586912345678</small>
