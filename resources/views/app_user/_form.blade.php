@if(isset($appUser))
    {!! Form::model($appUser, ['url' => "app-user/$appUser->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'app-user', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif

<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
    {!! Form::label('username', 'Username', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter Username', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('username') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Password', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Enter Password', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('password') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    {!! Form::label('role', 'Role', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::select('role', ['admin' => 'Admin', 'user' => 'User'], null, ['class' => 'form-control', 'placeholder' => 'Select Role']) !!}
        <span class="text-danger">
		    {{ $errors->first('role') }}
	    </span>
    </div>
</div>

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

<div class="form-group {{ $errors->has('detail') ? 'has-error' : ''}}">
    {!! Form::label('detail', 'Short Form', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('detail', null, ['class' => 'form-control', 'placeholder' => 'Area - Mobile No.', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('detail') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
    {!! Form::label('designation', 'Designation', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('designation', null, ['class' => 'form-control', 'placeholder' => 'Enter Designation', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('designation') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('delivery_point') ? 'has-error' : ''}}">
    {!! Form::label('delivery_point', 'Delivery Point', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('delivery_point', null, ['class' => 'form-control', 'placeholder' => 'Enter Delivery Point', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('delivery_point') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('area_covered') ? 'has-error' : ''}}">
    {!! Form::label('area_covered', 'Delivery Point', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('area_covered', null, ['class' => 'form-control', 'placeholder' => 'Enter Area Covered', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('area_covered') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('remarks') ? 'has-error' : ''}}">
    {!! Form::label('remarks', 'Remarks', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('remarks', null, ['class' => 'form-control', 'placeholder' => 'Enter Remarks', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('remarks') }}
	    </span>
    </div>
</div>


<div class="box-footer">
	<!-- <button type="button" class="btn btn-default">Cancel</button> -->
	<a href="{{ url('/app-user') }}" class="btn btn-default">Cancel</a>
	@if(isset($appUser))
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