@extends('layout')

@section('title', 'Page Title')

@section('heading', 'User Listing')

@section('content')
    <add-user-button class="form-group"></add-user-button>

    {{-- <table>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name . ' ' . $user->surname}}</td>
                <td>{{ $user->position }}</td>
                <td><delete-user-button :user_id="{{ $user->id }}"></delete-user-button></td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
    <list-users-table :users="{{ $users }}"></list-users-table>
@endsection