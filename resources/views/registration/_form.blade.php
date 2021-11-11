@if(isset($regUser))
    {!! Form::model($regUser, ['url' => "user-registration/$regUser->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'user-registration', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Username', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Username', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('email') }}
	    </span>
    </div>
</div>

@if(isset($regUser))
    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
	    {!! Form::label('password', 'Password', ['class' => 'required col-3 col-sm-3 control-label']) !!}
	    <div class="col-xs-9 col-sm-9">
	        {!! Form::text('password', base64_decode($regUser->secret), ['class' => 'form-control', 'placeholder' => 'Enter Password', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('password') }}
		    </span>
	    </div>
	</div>
@else
    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
	    {!! Form::label('password', 'Password', ['class' => 'required col-3 col-sm-3 control-label']) !!}
	    <div class="col-xs-9 col-sm-9">
	        {!! Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Enter Password', 'autocomplete' => 'off']) !!}
	        <span class="text-danger">
			    {{ $errors->first('password') }}
		    </span>
	    </div>
	</div>
@endif

<!-- <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Password', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Enter Password', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('password') }}
	    </span>
    </div>
</div> -->

<!-- <div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    {!! Form::label('role', 'Role', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::select('role', ['app_admin' => 'Order Manager', 'app_user' => 'Delivery Boy'], null, ['class' => 'form-control', 'placeholder' => 'Select Role']) !!}
        <span class="text-danger">
		    {{ $errors->first('role') }}
	    </span>
    </div>
</div> -->

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('name') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
    {!! Form::label('phone_number', 'Phone Number', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('phone_number') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('depot_app_user') ? 'has-error' : ''}}">
    {!! Form::label('depot_app_user', 'Area/Depot/Mobile Detail', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('depot_app_user', null, ['class' => 'form-control', 'placeholder' => 'Area - Mobile No.', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('depot_app_user') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('zone') ? 'has-error' : ''}}">
    {!! Form::label('zone', 'Zone', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        <!-- {!! Form::select('zone', ['All Zone' => 'All Zone', 'Dhaka North' => 'Dhaka North', 'Dhaka South' => 'Dhaka South'], null, ['class' => 'form-control', 'placeholder' => 'Select Zone']) !!} -->
        {!! Form::select('zone', ['Dhaka North' => 'Dhaka North', 'Dhaka South' => 'Dhaka South'], null, ['class' => 'form-control', 'placeholder' => 'Select Zone']) !!}
        <span class="text-danger">
		    {{ $errors->first('zone') }}
	    </span>
    </div>
</div>


<div class="box-footer">
	<a href="{{ url('/user-registration') }}" class="btn btn-default">Cancel</a>
	@if(isset($regUser))
	    {!! Form::button('Submit', ['class' => 'btn btn-success pull-right', 'data-toggle' => 'modal', 'data-target' => '#app_user_update']) !!}
	@else
	    {!! Form::button('Submit', ['class' => 'btn btn-primary pull-right', 'data-toggle' => 'modal', 'data-target' => '#app_user_create']) !!}
	@endif
	
</div>

<div class="modal modal-info fade" id="app_user_create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Confirmation Message</h4>
			</div>
			<div class="modal-body">
				<h3>Want to Create App User?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-outline">Create App User</button>
			</div>
		</div>
	</div>
</div>


<div class="modal modal-warning fade" id="app_user_update">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Confirmation Message</h4>
			</div>
			<div class="modal-body">
				<h3>Want to Update App User?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-outline">Update App User</button>
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}