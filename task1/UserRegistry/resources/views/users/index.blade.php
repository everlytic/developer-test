@extends('layout')

@section('title', 'Page Title')

@section('heading', 'Page HEading')

@section('content')
    <p>This is my body content.</p>
    <add-user-button></add-user-button>

    @foreach ($users as $user)
        {{ $user->name }}
    @endforeach
@endsection