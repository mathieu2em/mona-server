@extends('layouts.app')

@section('navbar')
<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/artworks') }}">{{ __('Artworks') }}</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ url('admin/users') }}">{{ __('Users') }}</a>
</li>
@endsection

@section('content')
<artwork-grid v-bind:artworks="{{ $artworks }}"></artwork-grid>
@endsection
