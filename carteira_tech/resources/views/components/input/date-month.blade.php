<x-div.input class="" >
    <input {{ $attributes->merge(['class' => "form-control"]) }} {{ $attributes->merge(['type' => "month"]) }}
    value = "{{ date('Y-m-d') }}"  id="{{@$id}}" name="{{@$name}}"
    />
</x-div.input>
