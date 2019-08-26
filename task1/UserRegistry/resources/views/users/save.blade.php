<!-- Save User Modal -->

<div class="modal" id="user-save-modal" style="display:{{ $errors->any() ? 'block' : 'none' }};">
	<div class="modal-content">
		<h1>Add New User</h1>

        <form action="/users" method="POST" id="save-user-form">
            @if ($errors->any())
	            <div class="alert alert-danger" role="alert">
	                <i class="fas fa-exclamation fa-fw"></i> Please fix the following errors
	            </div>
	        @endif

	        {!! csrf_field() !!}

            <!-- First Name field -->
            <p class="{{ $errors->has('firstname') ? ' has-error' : '' }}">
	            <label for="firstname">Name</label>
	            <input type="text" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="Enter your first name" required />
	            @if($errors->has('firstname'))
                    <span class="help-block">{{ $errors->first('firstname') }}</span>
                @endif
	        </p>
	        
	        <!-- Last Name Field -->
	        <p class="{{ $errors->has('lastname') ? ' has-error' : '' }}">
	           	<label for="last_name">Surname</label>
	            <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Enter your last name" required />
	            @if($errors->has('lastname'))
                    <span class="help-block">{{ $errors->first('lastname') }}</span>
                @endif
	        </p>

	        <!-- Email Address Field -->
	        <p class="{{ $errors->has('email') ? ' has-error' : '' }}">
	            <label for="email">Email</label>
	            <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required />
	            @if($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
	        </p>
	        
	        <!-- Position Field -->
	        <p class="{{ $errors->has('position') ? ' has-error' : '' }}">  
	            <label for="position">Position</label>
	            <input type="text" id="position" name="position" value="{{ old('position') }}" placeholder="Enter your job position" required />
	            @if($errors->has('position'))
                    <span class="help-block">{{ $errors->first('position') }}</span>
                @endif
	        </p>
            
            <p class="submit">
            	<button type="button" name="cancel" value="1" id="savecancelbutton">
            		Cancel
            	</button>
	            <button type="submit" name="save" value="1" id="savebutton">
	            	Save User
	            </button>
        	</p>
        </form>
	</div>
</div>