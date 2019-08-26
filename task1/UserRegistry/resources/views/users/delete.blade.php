<!-- Delete User Modal -->

<div class="modal" id="user-delete-modal">
	<div class="modal-content">
		<h1>Delete User</h1>

		<p>Please confirm that you would like to delete this user.</p>

		<form action="/users" method="POST" id="delete-user-form">
			{{ method_field('DELETE') }}
			{{ csrf_field() }}

			<input type="hidden" value="" id="user_id" />

			<p class="submit">
				<button type="button" name="deletecancel" value="1" id="deletecancelbutton">
					Cancel
				</button>
				<button type="submit" name="delete" value="1" id="delete">
					Confirm
				</button>
			</p>
		</form>
	</div>
</div>