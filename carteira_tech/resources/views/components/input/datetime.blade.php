<x-div.input class="" >
    <input {{ $attributes->merge(['class' => "form-control"]) }} {{ $attributes->merge(['type' => "datetime-local"]) }}
    value = "{{ date('Y-m-d\TH:i') }}"  id="{{$id}}" name="{{$name}}"
    />
</x-div.input>
