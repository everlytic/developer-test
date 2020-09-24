@extends('layouts.app')

@section('content')
    <div class="container">


        @if(session('error'))
            <div class="well danger">
                {{ session()->get('error') }}
            </div>
        @elseif(session('success'))
            <div class="well success">
                {{ session()->get('success') }}
            </div>
        @endif


        <div id="adminwell">
            <button class="button" id="adduser">Add new user</button>
        </div>

        @if(count($users))
            <table id="userstable">
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{{ $user['firstname'] }}} {{{ $user['lastname'] }}}</td>
                            <td>{{{ $user['email'] }}}</td>
                            <td><i data-id="{{{ $user['id'] }}}" class="fas fa-trash-alt deletebutton"></i></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="well danger">Sorry, there are no users to display.</div>
        @endif
    </div>

    <div class="modal" id="newusermodal">
        <div class="modalbox">
            <h1>Add new user</h1>

            @if(session('modalerror'))
                <div class="well danger">
                    {{ session()->get('modalerror') }}
                </div>
                <script>
                    window.addEventListener('load', function () {
                        showModal('newusermodal');
                    });
                </script>
            @endif

            <form action="create" enctype="multipart/form-data" method="post">
                <div class="inputwrapper">
                    <label for="firstname">Name</label>
                    <input type="text" name="firstname" value="{{ old('firstname') }}">
                </div>
                <div class="inputwrapper">
                    <label for="lastname">Surname</label>
                    <input type="text" name="lastname" value="{{ old('lastname') }}">
                </div>
                <div class="inputwrapper">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="inputwrapper">
                    <label for="position">Position</label>
                    <input type="text" name="position" value="{{ old('position') }}">
                </div>
                <div id="adminwell">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="button secondary" id="closeuser">Cancel</div>
                    <input type="submit" class="button" name="submit" value="Save">
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="deletemodal">
        <div class="modalbox">
            <h1>Confirm delete</h1>

            <form action="create" enctype="multipart/form-data" method="post">
                <p>Please confirm that you would like to delete this user.</p>
                <div id="adminwell">
                    <div class="button secondary" id="canceldelete">Cancel</div>
                    <button class="button" id="confirmdelete">Confirm</button>
                </div>
            </form>
        </div>
    </div>

@endsection
