<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Listing</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="header-image">
    <h1>User Listing</h1>
</div>
<div class="main">
    <div class="user-list">
        <p>Please make sure you read my notes on why I did things, located in the root directory as notes.txt</p>
        <button id="open_form">Add New User</button>
        <table>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td><i class="fa fa-trash open_delete_form" aria-hidden="true"></i></td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="footer">
    Copyright User Listing App
</div>
<div id="create_user" class="modal">
    <div class="modal-content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        @endif
        <form action="/users" method="POST">
            {{ csrf_field() }}
            <label for="first_name">Name</label>
            <input type="text" id="first_name" name="first_name" value="Bob">
            <label for="last_name">Surname</label>
            <input type="text" id="last_name" name="last_name" value="Smith"><br>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="bob@example.com"><br>
            <label for="position">Position</label>
            <input type="text" id="position" name="position" value="CEO"><br>
            <button class="close" type="button">Cancel</button>
            <button>Submit</button>
        </form>
    </div>
</div>
<div id="delete_user" class="modal">
    <div class="modal-content">
        <form action="/users" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="delete"/>
            <input type="hidden" id="delete_form" name="id" value="">
            <h3>Confirm delete</h3>
            <p>Please confirm that you would like to delete this user</p>
            <button>Confirm</button>
            <button type="button" class="close">Cancel</button>
        </form>
    </div>
</div>
<script src="{{asset('js/main.js')}}"></script>
</body>
</html>