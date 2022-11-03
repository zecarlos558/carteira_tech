@props(['multiple'=>false])

<select {{ $attributes->merge(['class' => 'form-select','multiselect-search' => '','multiselect-select-all' => '','multiselect-max-items' => '']) }} {{ $multiple ? 'multiple' : '' }} onchange="{{ $onchange ? $onchange : ''}}" name="{{$name}}" id="{{$id}}">
    {{$slot}}
</select>
