@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
     @guest
      	<div class="alert alert-danger" role="alert"><strong>Oh Snap!</strong>  You have been logged out</div>
     @else
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>User list</h4></div>

                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            	<span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            	<span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                    <div class="pull-right">
                    	<a class="btn btn-primary" data-toggle="modal" href="#modal-newuser">New user</a>
                    </div>
                    <table class="table table-borderless table-striped">
                    	<thead>
                    		<tr>
                    			<th>Name</th>
                    			<th>Email</th>
                    			<th>Position</th>
                    			<th>&nbsp;</th>
                    		</tr>
                    	</thead>
                    	<tbody>
		                    @foreach ($users as $user)
                    		<tr>
                    			<td>{{ $user->name }}</td>
                    			<td>{{ $user->email }}</td>
                    			<td>{{ $user->position }}</td>
                    			<td>
                    				@if ($user->id !== Auth::user()->id)
                    				<form id="delete_{{ $user->id }}" action="{{ url('users').'/'.$user->id }}" method="POST">
                    					{{ csrf_field() }}
	                    				<input name="_method" value="DELETE" type="hidden">
                    					<a class="btn btn-danger btn-xs btn-delete" data-id="{{ $user->id }}" data-toggle="modal" href="#modal-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    				</form>
                    				@endif
                    			</td>
                    		</tr>
		                    @endforeach
                    	</tbody>
                    </table>
                    {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endguest
    </div>
</div>
        <!-- New suer #modal-dialog -->
		<div class="modal" id="modal-newuser" aria-hidden="true" style="display: none;">
        	<div class="modal-dialog">
            	<div class="modal-content">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                        <h4 class="modal-title">Add new user</h4>
                    </div>
                    <div class="modal-body">
                    	<form class="form-horizontal" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" id="newuser-frm">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter your name" autofocus>
                                <span class="text-danger">
                                	<strong id="name-error"></strong>
                            	</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="surname" class="col-md-4 control-label">Surname</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" placeholder="Enter your surname">
                                <span class="text-danger">
                                	<strong id="surname-error"></strong>
                            	</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                                <span class="text-danger">
                                	<strong id="email-error"></strong>
                            	</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="position" class="col-md-4 control-label">Position</label>

                            <div class="col-md-6">
                                <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}" placeholder="Enter your position">
                                <span class="text-danger">
                                	<strong id="position-error"></strong>
                            	</span>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                    	<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                    	<a href="#" id="confirm-newuser" data-id="0" class="btn btn-sm btn-primary" data-dismiss="modal">Save</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete #modal-dialog -->
		<div class="modal fade" id="modal-delete" aria-hidden="true" style="display: none;">
        	<div class="modal-dialog">
            	<div class="modal-content">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                        <h4 class="modal-title">Confirm Delete</h4>
                    </div>
                    <div class="modal-body">
                    	Are you sure you want to delete this?
                    	<div>&nbsp;</div>
                    </div>
                    <div class="modal-footer">
                    	<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
                    	<a href="#" id="confirm-delete" data-id="0" class="btn btn-sm btn-danger" data-dismiss="modal">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- confirmed new user #modal-dialog -->
		<div class="modal fade" id="modal-confirm-new-user" aria-hidden="true" style="display: none;">
        	<div class="modal-dialog">
            	<div class="modal-content">
                	<div class="modal-header">
                    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                        <h4 class="modal-title">New user</h4>
                    </div>
                    <div class="modal-body">
                    	<div id="newuser-story"></div>
                    	<div>&nbsp;</div>
                    </div>
                    <div class="modal-footer">
                    	<a href="javascript:;" class="btn btn-sm btn-primary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('custom_scripts')
<script type="text/javascript">

	$(document).on("click", ".btn-delete", function () {
        var deleteId = $(this).data('id');
        $("#confirm-delete").attr('data-id', deleteId);
    });

	$('#confirm-delete').click(function(e) {
	    e.preventDefault();
    
        var deleteId = $(this).data('id');
        $('#delete_' + deleteId).submit();

    });
    
    $('#newuser-frm').on('change input', function(e) {
    	
    	var value = $('#newuser-frm #' + e.target.name).val();
    	
    	if ( value.length > 0 && value != undefined) {
    	
    		$('#' + e.target.name + '-error' ).html( '' );
    		
    	}
    	
    });
    
    $('#confirm-newuser').click(function(e){
    
    	e.preventDefault();
    	
    	$.ajaxSetup({
        	headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    	
    	$.ajax({
    		url: "{{ url('/users') }}",
    		method: 'post',
    		data: {
    			name: $('#name').val(),
    			surname: $('#surname').val(),
                email: $('#email').val(),
                position: $('#position').val(),
            },
            success: function(result) {
            	
            	// Show success message
                $('#newuser-story').html('New user successfully created.');
                
                $('#modal-confirm-new-user').modal('show');
                
            },
            error: function(result) {
            	
            	if(result.responseJSON.errors)
                {
                    $.each(result.responseJSON.errors, function(key, value){
                    	
                    	$( '#' + key + '-error' ).html( value[0] );
                    });
                    
                    $('#modal-newuser').modal('show');
                }
            }
    	});
    
    });
    
</script>
@endsection