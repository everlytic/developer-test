@extends('layouts.app')
@section('content')

<!-- Header section -->
<section id="header">
	<div class="container">
		<header>
			<h1><a href="/">User Listing</a></h1>
		</header>
	</div>
</section>

<!-- Flash message -->
<section id="flashmessage">
	<div class="container">
		<div class="content">
			<div class="flash-message">
				@foreach (['danger', 'warning', 'success', 'info'] as $msg)
					@if(Session::has('alert-' . $msg))
						<p class="alert alert-{{ $msg }}">
							{{ Session::get('alert-' . $msg) }} 
							<a href="#" class="dismiss" data-dismiss="alert" aria-label="dismiss"><i class="fas fa-times fa-fw"></i></a>
						</p>
					@endif
				@endforeach
			</div> <!-- end .flash-message -->
		</div>
	</div>
</section>

<!-- Users list section -->
<section id="users">
	<div class="container">
		<div class="content">
			<div class="user-save-button">
				<button type="button" name="save" value="1" id="user-save-button">
					Add new user
				</button>
			</div>

			<table cellpadding="0" cellspacing="0">
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>{{ $user -> firstname }} {{ $user -> lastname }}</td>
							<td>{{ $user -> email }}</td>
							<td class="actions">
								<a class="delete user-delete" data-id="{{ $user->id }}"><i class="fas fa-trash-alt fa-fw"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<!-- Pagination -->
			<div class="pagination-wrapper">
				{{ $users->links() }}
				<br class="clear" />
			</div>
		</div>
	</div>
</section>

<!-- Footer section -->
<section id="footer">
	<div class="container">
		<div class="footer">
			Copyright User Listing App
		</div>
	</div>
</section>

@include('users.save')
@include('users.delete')

@endsection