@extends('layouts.layout')

@section('content')

    <x-titulo_central> {{@$tituloCentral}} </x-titulo_central>
    <div {{ $attributes->merge(['class' => '']) }} id="{{ @$id ? $id : 'tech-container' }}" >
        <x-confirm_request></x-confirm_request>
        {{$slot}}
    </div>

@endsection
