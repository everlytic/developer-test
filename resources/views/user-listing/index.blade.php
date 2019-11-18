<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            width: 100%;
            text-align: center;
        }

        .content-body{
            width:60%;
            float: center;
            margin-left: auto;
            margin-right: auto;

        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            /*border: 1px solid #ddd;*/
        }

        th, td {
            text-align: left;
            padding: 16px;
            color: #636b6f;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .fa-trash{
            color: red;
        }

        .pull-right{
            float: right;
        }

        .btn-delete {
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}

.w3-button{
    margin-bottom: 20px;
}

.form-control{
    width:100%;
}

.form-group{
    margin-top: 10px;
}

.header-site{
   
}

.user-title{
    font-size: 44px;
}

.pagination {
  padding-left: 0;
  list-style: none;
}

.pagination > li {
  display: inline-block;
}
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md header-site" style="background: #000000 {{ asset('images/background.jpg')}} 100% 100% no-repeat;">
            <div class="user-title"> User Listing </div>
        </div>
        <div class="content-body">
        <div>
            <table>
                <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black pull-right">Add New User</button>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name ." " .$user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        <td><form method="POST" action="{{route('user-listings.destroy', $user->id)}}"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button class="btn-delete" type="submit" onclick="return confirm('Please confirm that you would like to delete this user')"><i class="fa fa-trash"></i></button></form></td>
                    </tr>
                @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
    </div>
</div>

<div class="w3-container">

    <div id="id01" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>

                <h3> Add New User</h3>
                {!! Form::open(['url' => 'user-listings', 'method' => 'post']) !!}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" value="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="position">Position</label>
                    <input type="text" name="position" value="" class="form-control" required>
                </div>
                <div class="form-group">
                    {{ Form::submit('Save', array('class' => 'w3-button w3-black')) }}
                </div>
                {!! Form::close() !!}


            </div>
        </div>
    </div>
</div>

</body>
</html>
