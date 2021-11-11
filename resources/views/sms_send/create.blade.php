@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-8 col-sm-offset-2">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">SMS Send </h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-edit"></i> Form of <code><b>SMS Send</b></code> </h3>
    							</div>
                                
    							<div class="card-body">
    						  		
                                    {!! Form::open(['url' => 'sms-send', 'method' => 'post', 'class' => 'form-horizontal']) !!}
                                    
                                    <div class="row">
                                        
                                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
										    {!! Form::label('phone_number', 'Phone Number', ['class' => 'required col-3 col-sm-3 control-label']) !!}
										    <div class="col-xs-9 col-sm-9">
										        {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'autocomplete' => 'off']) !!}
										        <span class="text-danger">
												    {{ $errors->first('phone_number') }}
											    </span>
										    </div>
										</div>

                                        <div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
                                            {!! Form::label('message', 'Message', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                            <div class="col-xs-9 col-sm-9">
                                                {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Enter Message', 'autocomplete' => 'off', 'rows' => 3]) !!}
                                                <span class="text-danger">
                                                    {{ $errors->first('message') }}
                                                </span>
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="box-footer">
                                        <!-- <button type="button" class="btn btn-default">Cancel</button> -->
                                        <a href="{{ url('/sms-send') }}" class="btn btn-default">Cancel</a>
                                       
                                         {!! Form::button('Submit', ['class' => 'btn btn-success pull-right', 'data-toggle' => 'modal', 'data-target' => '#sms_create']) !!}
                                    </div>

                                    <div class="modal modal-success fade" id="sms_create">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">Confirmation Message</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Want to send SMS?</h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline">Send SMS</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {!! Form::close() !!}
    								
    							</div>
    						</div>
    					</div>

                	</div>
          		</div>
        	</div>
      	</div>
    </section>
</div>
@endsection