@props(['readonly' => false])
<input type="text" {{ $attributes->merge(['class' => 'form-control moeda']) }} {{ @$readonly ? 'readonly' : '' }} onclick="{{@$onclick}}" value="{{ @$value ? $value : ''  }}" name="{{@$name}}" id="{{@$id}}" placeholder="{{ @$placeholder ? $placeholder : ''   }}">

<script>
    $(document).ready(function(){
        // Aplica a máscara para moeda brasileira (Real)
        $('.moeda').mask('###.##0,00', {
            reverse: true,
            placeholder: "R$ 0,00"
        });
    });
</script>