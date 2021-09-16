@extends('layouts.search')

@section('title', '| Ricerca')


@section('content')

<div id="app" class="py-5">
    <index-component :selected="{{ $selected }}" :specializations="{{ $specializations }}"></index-component>
</div>

@endsection