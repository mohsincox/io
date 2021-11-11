<!DOCTYPE html>
<html>
<head>
	<title>MYOL</title>
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
   
	<style type="text/css">
		.box-header {
		    padding: 0px;
		}
		.box-body {
			padding: 0px;
		}
		.box-header .box-title {
			display: block;
		}
		.box-title {
			text-align: center;
		}

		.input-group-addon {
		    min-width:200px;
		    /*min-width:220px;*/
		    /*text-align:left;*/
		}
		.alert {
            padding: 2px; 
            margin-bottom: 5px;
        }

        .greenG {
        	background-color: #28a745; color: #FFFFFF;
        }
        .blue {
        	background-color: #007bff; color: #FFFFFF;
        	/*background-color: #59a3ef; color: #FFFFFF;*/
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #3c8dbc;
            border-color: #367fa9;
            padding: 1px 10px;
            color: #fff;
        }

	</style>
</head>
<body>
	<div class="container-fluid">

	    <div class="container">
	        <div class="col-sm-8 col-sm-offset-2">
	            @include('flash::message')
	        </div>
	    </div>

		<div class="box box-success">
	    	<div class="box-header with-border">
	        	<h3 class="box-title">IGLOO CRM <small>Phone Number:</small><code>{{ $phoneNumber }}</code> <small>Agent:</small> <code>{{ $agent }}</code>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://192.168.100.34/igloo-out-crm/?phone_number={{ $phoneNumber }}&agent={{ $agent }}" class="btn btn-danger btn-sm">OutBound CRM</a></h3> 
	    	</div>
	    	<div class="box-body">
	    		{!! Form::model($crmLast, ['url' => 'crm', 'method' => 'post']) !!}

				{{-- {!! Form::open(['url' => 'crm', 'method' => 'post', 'class' => '']) !!} --}}

				<input type="hidden" name="phone_number" value="{{ $phoneNumber }}" class="form-control">
				<input type="hidden" name="agent" value="{{ $agent }}" class="form-control">

				<div class="row">
		    		<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Customer Name</span>
			      			{!! Form::text('customer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Name', 'autocomplete' => 'off']) !!}
			    		</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Customer Address</span>
			      			{!! Form::text('customer_address', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Address', 'autocomplete' => 'off']) !!}
			    		</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Customer Area</span>
			      			{!! Form::text('customer_area', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Area', 'autocomplete' => 'off']) !!}
			    		</div>
					</div>
					<!-- <div class="col-sm-6">
			    		<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Division</span>
			      			{!! Form::select('division_id', $districtList, null, ['class' => 'form-control', 'placeholder' => 'Select Division', 'id' => 'division_id']) !!}
			    		</div>
					</div> -->
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">District</span>
			      			{!! Form::select('district_id', $districtList, null, ['class' => 'form-control select2', 'placeholder' => 'Select District', 'id' => 'district_id']) !!}
			    		</div>
					</div>
				</div>

				<div class="row">
					
		    		
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Customer Email</span>
			      			{!! Form::text('customer_email', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Email', 'autocomplete' => 'off']) !!}
			    		</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Gender</span>
			      			{!! Form::select('gender', $genderList, null, ['class' => 'form-control', 'placeholder' => 'Select Gender']) !!}
			    		</div>
					</div>

					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Profession</span>
			      			{!! Form::select('profession', $professionList, null, ['class' => 'form-control', 'placeholder' => 'Select Profession']) !!}
			    		</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
			    		<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Date of Birth</span>
			      			{!! Form::text('date_of_birth', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD', 'autocomplete' => 'off', 'id' => 'date_of_birth']) !!}
			    		</div>
					</div>
					<div class="col-sm-6">
			    		<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Marriage Day</span>
			      			{!! Form::text('marriage_day', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD', 'autocomplete' => 'off', 'id' => 'marriage_day']) !!}
			    		</div>
					</div>
				</div>

				<div class="row">
		    		<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Type of Customer</span>
			      			{!! Form::select('type_of_customer', $typeOfCustomerList, null, ['class' => 'form-control', 'placeholder' => 'Select Type of Customer']) !!}
			    		</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Area - Assigned</span>
			      			{!! Form::select('area_assigned', $areaAssignedList, null, ['class' => 'form-control select2', 'placeholder' => 'Select Area - Assigned Person - Mobile']) !!}
			    		</div>
					</div>

				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Query Type</span>
			      			{!! Form::select('query_type', $queryTypeList, null, ['class' => 'form-control', 'placeholder' => 'Select Query Type']) !!}
			    		</div>
					</div>
		    		<div class="col-sm-6">
			    		<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Product Model</span>
			      			{!! Form::select('product_model[]', $productModelList, null, ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
			    		</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Corporate Client & Discount</span>
			      			{!! Form::select('client_discount', $clientDiscountList, null, ['class' => 'form-control', 'placeholder' => 'Select Corporate Client & Discount']) !!}
			    		</div>
					</div>
		    		<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Product Price</span>
			      			{!! Form::text('product_price_blank', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Price', 'autocomplete' => 'off']) !!}
			    		</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Order</span>
			      			{!! Form::select('customer_order', $yesNoList, null, ['class' => 'form-control', 'placeholder' => 'Select Order']) !!}
			    		</div>
					</div>
		    		<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Call Type <span style="color: red; font-size: 18px;">*</span></span>
			      			{!! Form::select('in_or_out', ['InboundCall' => 'InboundCall', 'OutboundCall' => 'OutboundCall'], null, ['class' => 'form-control', 'placeholder' => 'Select InboundCall or OutboundCall', 'required' => 'required']) !!}
			    		</div>
					</div>
					
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Conversation Details</span>
			      			{!! Form::text('remarks', null, ['class' => 'form-control', 'placeholder' => 'Enter Remarks', 'autocomplete' => 'off']) !!}
			    		</div>
					</div>
				</div>

				<div class="row">
		    		<!-- <div class="col-sm-6">
			    		<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Source of Call</span>
			      			{!! Form::text('product_model', null, ['class' => 'form-control', 'placeholder' => 'Source of Call', 'list' => 'datalist_product_model']) !!}
			      			<datalist id="datalist_product_model">
                            	@foreach($productModelList as $productModel)
							    	<option value="{{ $productModel }}">
							    @endforeach
							</datalist>
			    		</div>
					</div> -->
					<div class="col-sm-6">
						<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Create Ticket</span>
			      			{!! Form::select('create_ticket', $yesNoList, null, ['class' => 'form-control', 'placeholder' => 'Select Create Ticket']) !!}
			    		</div>
					</div>
					<div class="col-sm-6">
			    		<div class="input-group" style="margin-top: 5px;">
			      			<span class="input-group-addon" style="background-color: #28a745; color: #FFFFFF;">Call Remarks</span>
			      			{!! Form::select('call_remarks', $callRemarksList, null, ['class' => 'form-control', 'placeholder' => 'Select Call Remarks']) !!}
			    		</div>
					</div>
				</div>

				{!! Form::button('Submit', ['class' => 'btn btn-primary btn-block btn-xs btn-flat', 'data-toggle' => 'modal', 'data-target' => '#crm_create', 'style' => 'margin-top: 10px;']) !!}

				<div class="modal modal-info fade" id="crm_create">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">Confirmation Message</h4>
                            </div>
                            <div class="modal-body">
                                <h3>Want to Store CRM Information?</h3>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
                                <button type="submit" class="btn btn-outline btn-block">Submit CRM Information</button>
                            </div>
                        </div>
                    </div>
                </div>

				{!! Form::close() !!}
	    	</div>
	    </div>
	        	
	    
	</div>

	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<!-- <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script> -->
	<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

	

	<script type="text/javascript">
		$('#date_of_birth').datepicker({
            format:'yyyy-mm-dd',
            autoclose: true
        });

        $('#marriage_day').datepicker({
            format:'yyyy-mm-dd',
            autoclose: true
        });

        

        // $(function() {
        //     $('#division_id').change(function() {
        //         var divisionId = $(this).val();
        //         getDistrict(divisionId);
        //     });
        // });


        // function getDistrict(divisionId) {
            
        //     resetField('district_id', 'Select District');
        //     var url = '{{ url("crm/get-district")}}';
        //     $.get(url+'?division_id='+divisionId, function (response) {
        //         $.map( response, function( name, id ) {
        //             $('#district_id').append('<option value="'+ id +'">' + name + '</option>');
        //         });
        //     });
        // }

        // function resetField(id, placeholder) {
        //     $('#' + id).empty();
        //     $('#' + id).append('<option value="">'+ placeholder +'</option>');
        // }


  //       @if(isset($crmLast))

		// 	var customerDivisionId = '{{ $crmLast->division_id }}';
		// 	var customerDistrictId = '{{ $crmLast->district_id }}';

		// 	jQuery.ajaxSetup({async:false});
			
		// 	getDistrict(customerDivisionId);
		// 	$('#district_id').val(customerDistrictId);

		// 	 jQuery.ajaxSetup({async:true});

		// @endif

		$(function () {
            $('.select2').select2();
        });

	</script>
</body>
</html>