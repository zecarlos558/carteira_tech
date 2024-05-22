
<x-div.input>
    <textarea {{ $attributes->merge(['class' => 'form-control']) }}
        name="{{@$name}}" id="{{@$id}}" rows="{{ @$rows ? $rows : '5'  }}"
        placeholder="{{ @$placeholder ? $placeholder : ''   }}">
        {{$slot}}
    </textarea>
</x-div.input>
