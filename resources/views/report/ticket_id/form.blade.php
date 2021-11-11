@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-8 col-sm-offset-2">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">Order ID Search Form</h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-chart-bar"></i> <code><b>Order ID</b></code> Search Form</h3>
    							</div>
    							<div class="card-body">
    						  		
    								
                                    {!! Form::open(['url' => 'report/ticket-id-show', 'method' => 'get', 'class' => 'form-horizontal']) !!}

                                    <div class="form-group {{ $errors->has('ticket_id') ? 'has-error' : ''}}">
                                        {!! Form::label('ticket_id', 'Order ID', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::number('ticket_id', null, ['class' => 'form-control', 'placeholder' => 'Enter Order ID', 'autocomplete' => 'off', 'required' => 'required']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('ticket_id') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        
                                        <!-- <a href="{{ url('/profile') }}" class="btn btn-default">Cancel</a> -->
                                        
                                        {!! Form::submit('Submit', ['class' => 'btn btn-success pull-right']) !!}
                              
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

@section('style')
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}"> -->
@endsection

@section('script')
	<!-- <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script> -->

    <script type="text/javascript">
    	 // $(function () {
      //       $('.select2').select2()
      //   })

      //   $('#start_date').datepicker({
      //       format:'yyyy-mm-dd',
      //       "autoclose": true
      //   }).datepicker("setDate",'now');

      //   $('#end_date').datepicker({
      //       format:'yyyy-mm-dd',
      //       "autoclose": true
      //   }).datepicker("setDate",'now');
    </script>
@endsection