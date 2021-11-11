@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-offset-0">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order </h3> 
                    </div>
                    <div class="box-body">

                        <div class="col-sm-12">
                            
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="text-center"><i class="fa fa-pencil"></i> Create Form of <code><b>Order</b></code> </h3>
                                </div>
                               
                                <div class="card-body">
                                    
                                    
                                    {!! Form::open(['url' => 'ticket', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'ticketForm']) !!}
                                   
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-6">

                                            <div class="form-group {{ $errors->has('ticket_type_id') ? 'has-error' : ''}}">
                                                {!! Form::label('ticket_type_id', 'Ticket Type', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9" id="ticket_type_disable">
                                                    {!! Form::select('ticket_type_id', $ticketTypeList, null, ['class' => 'form-control','placeholder' => 'Select Ticket Type', 'id' => 'ticket_type_id']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('ticket_type_id') }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('assigned_id') ? 'has-error' : ''}}">
                                                {!! Form::label('assigned_id', 'Assign, Mail To (PIC)', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9" style="pointer-events: none;">
                                                    <span id="type_to_assign_show">
                                                        {!! Form::select('assigned_id', [], null, ['class' => 'form-control','placeholder' => 'Select Assign To', 'id' => 'assigned_id']) !!}
                                                    </span>
                                                    <span class="text-danger">
                                                        {{ $errors->first('assigned_id') }}
                                                    </span>
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('cc_to') ? 'has-error' : ''}}">
                                                {!! Form::label('cc_to', 'CC To', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9" style="pointer-events: none;">
                                                    {!! Form::select('cc_to[]', [], null, ['class' => 'form-control select2', 'id' => 'cc_to', 'multiple' => 'multiple']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('cc_to') }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                                                {!! Form::label('phone_number', 'Customer Phone Number', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Phone Number', 'autocomplete' => 'off']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('phone_number') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
                                                {!! Form::label('subject', 'Subject', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::select('subject', $subjectList, null, ['class' => 'form-control','placeholder' => 'Select Subject', 'id' => 'subject']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('subject') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
                                                {!! Form::label('customer_name', 'Customer Name', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::text('customer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Name', 'autocomplete' => 'off']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('customer_name') }}
                                                    </span>
                                                </div>
                                            </div>

                                           
                                            <!-- <div class="form-group {{ $errors->has('division_id') ? 'has-error' : ''}}">
                                                {!! Form::label('division_id', 'Select Division', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::select('division_id', $divisionList, null, ['class' => 'form-control js-example-basic-single', 'placeholder' => 'Select Customer Division', 'id' => 'division_id']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('division_id') }}
                                                    </span>
                                                </div>
                                            </div>
                                       
                                            <div class="form-group {{ $errors->has('district_id') ? 'has-error' : ''}}">
                                                {!! Form::label('district_id', 'Select District', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::select('district_id', [], null, ['class' => 'form-control js-example-basic-single', 'placeholder' => 'Select Customer District', 'id' => 'district_id']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('district_id') }}
                                                    </span>
                                                </div>
                                            </div> -->

                                            <div class="form-group {{ $errors->has('sv_assigned_id') ? 'has-error' : ''}}">
                                                {!! Form::label('sv_assigned_id', 'Area - Assigned Person - Mobile', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::select('sv_assigned_id', $areaAssignedList, null, ['class' => 'form-control','placeholder' => 'Select Area - Assigned Person - Mobile', 'id' => 'sv_assigned_id']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('sv_assigned_id') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('customer_address') ? 'has-error' : ''}}">
                                                {!! Form::label('customer_address', 'Customer Address', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::text('customer_address', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Address', 'autocomplete' => 'off']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('customer_address') }}
                                                    </span>
                                                </div>
                                            </div>

                                            
                                            
                                        </div>

                                        <div class="col-xs-12 col-sm-6">

                                            <div class="input_fields_wrap">

                                                 <div class="form-group">
                                                    <label class="required control-label col-sm-2" for="product_detail">Product</label>
                                                    <div class="col-xs-5 col-sm-5">
                                                        {!! Form::select('product_name[]', $productModelList, null, ['class' => 'form-control', 'placeholder' => 'Select a Product', 'required' => 'required']) !!}
                                                    </div>
                                                    
                                                    <div class="col-xs-2 col-sm-2">
                                                        <input type="text" class="form-control" placeholder="Qty" name="product_qty[]" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                                    </div>

                                                    <div class="col-xs-2 col-sm-2">
                                                        {!! Form::select('product_unit[]', ['Cartoon' => 'Cartoon', 'Pack' => 'Pack'], null, ['class' => 'form-control', 'placeholder' => 'Unit', 'required' => 'required', 'style' => 'padding: 6px 0px;']) !!}
                                                    </div>

                                                   
                                                    <div class="col-xs-1 col-sm-1">
                                                        <button type="button" class="add_field_button btn btn-primary"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group {{ $errors->has('client_discount') ? 'has-error' : ''}}">
                                                {!! Form::label('client_discount', 'Corporate Client & Discount', ['class' => 'col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::select('client_discount', $clientDiscountList, null, ['class' => 'form-control','placeholder' => 'Select Corporate Client & Discount', 'id' => 'client_discount']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('client_discount') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('product_price') ? 'has-error' : ''}}">
                                                {!! Form::label('product_price', 'Product Price', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::text('product_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Price', 'autocomplete' => 'off']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('product_price') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('total_price') ? 'has-error' : ''}}">
                                                {!! Form::label('total_price', 'Total Price', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::text('total_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Total Price', 'autocomplete' => 'off', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('total_price') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('delivery_time') ? 'has-error' : ''}}">
                                                {!! Form::label('delivery_time', 'Delivery Time', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::text('delivery_time', null, ['class' => 'form-control', 'placeholder' => 'Enter Delivery Time', 'autocomplete' => 'off']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('delivery_time') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
                                                {!! Form::label('discount', 'Discount', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::text('discount', null, ['class' => 'form-control', 'placeholder' => 'Enter Discount', 'autocomplete' => 'off']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('discount') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('gift') ? 'has-error' : ''}}">
                                                {!! Form::label('gift', 'Gift', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::text('gift', null, ['class' => 'form-control', 'placeholder' => 'Enter Gift', 'autocomplete' => 'off']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('gift') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('payment_status') ? 'has-error' : ''}}">
                                                {!! Form::label('payment_status', 'Payment Status', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::text('payment_status', null, ['class' => 'form-control', 'placeholder' => 'Enter Payment Status', 'autocomplete' => 'off']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('payment_status') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('remarks') ? 'has-error' : ''}}">
                                                {!! Form::label('remarks', 'Remarks', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::textarea('remarks', null, ['class' => 'form-control', 'placeholder' => 'Enter Remarks (Conversation Details)', 'autocomplete' => 'off', 'rows' => 3]) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('remarks') }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <a href="{{ url('/ticket') }}" class="btn btn-default">Cancel</a>
                                       
                                        {!! Form::button('Submit', ['class' => 'btn btn-primary pull-right', 'data-toggle' => 'modal', 'data-target' => '#ticket_create']) !!}
                                    </div>

                                    <div class="modal modal-info fade" id="ticket_create">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">Confirmation Message</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Want to Create Ticket?</h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline submitBtnTicket">Create Ticket</button>
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

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #3c8dbc;
            border-color: #367fa9;
            padding: 1px 10px;
            color: #fff;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    
    <script type="text/javascript">
        $(function() {
            $('#division_id').change(function() {
                var divisionId = $(this).val();
                getDistrict(divisionId);
            });
        });

        function getDistrict(divisionId) {
            
            resetField('district_id', 'Select DISTRICT');
            var url = '{{ url("ticket/get-district")}}';
            $.get(url+'?division_id='+divisionId, function (response) {
                $.map( response, function( name, id ) {
                    $('#district_id').append('<option value="'+ id +'">' + name + '</option>');
                });
            });
        }

        function resetField(id, placeholder) {
            $('#' + id).empty();
            $('#' + id).append('<option value="">'+ placeholder +'</option>');
        }

        $(document).ready(function() {
            $("#ticket_type_id").change(function() {
                
                $('#ticket_type_disable').attr("style", "pointer-events: none;");
                var ticketTypeId = $("#ticket_type_id").val();
                var url = '{{ url("/ticket/get-assigned")}}';
                $.get(url+'?ticket_type_id='+ticketTypeId, function (data) {  
                    $('#type_to_assign_show').html('<select name="assigned_id" class="form-control"><option value="' + data.id + '">' + data.name + '</option></select>');
                });

                var url2 = '{{ url("/ticket/get-cc")}}';
                $.get(url2+'?ticket_type_id='+ticketTypeId, function (response) {
                    $.map( response, function( name, id ) {
                        $('#cc_to').append('<option selected  value="'+ id +'">' + name + '</option>');
                    });
                });
            });
        });

        $(function () {
            $('.select2').select2();
        });

        $(document).ready(function () {
            $("#ticketForm").submit(function () {
                $(".submitBtnTicket").attr("disabled", true);
                return true;
            });
        });
        
    </script>

    <script type="text/javascript">

        $(document).ready(function() {

            var strProduct = '';
            $.get('{{ url("/ticket/get-product")}}', function (response) {
                // console.log(response);
                $.map( response, function( name, id ) {
                   strProduct += '<option value="'+ id +'">' + name + '</option>';
                });

                var max_fields      = 10; 
                var wrapper         = $(".input_fields_wrap"); 
                var add_button      = $(".add_field_button"); 
                
                var x = 1; 
                $(add_button).click(function(e){ 
                    e.preventDefault();
                    if(x < max_fields){ 
                        x++; 
                        
                        $(wrapper).append('<div id="div1">'+ 
                                            '<div class="form-group">'+
                                                '<label class="required control-label col-sm-2" for="product_serial">Product</label>'+
                                                '<div class="col-xs-5 col-sm-5">'+
                                                    '<select class="form-control select2" name="product_name[]" required>'+                                             
                                                        '<option value="">Select a Product</option>'+strProduct+
                                                    '</select>'+
                                                '</div>'+
                                                '<div class="col-xs-2 col-sm-2">'+
                                                    '<input type="text" class="form-control" placeholder="Qty" name="product_qty[]" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>'+
                                                '</div>'+
                                                '<div class="col-xs-2 col-sm-2">'+
                                                    '<select class="form-control" name="product_unit[]" style="padding: 6px 0px;" required>'+                                             
                                                        '<option value="">Unit</option>'+
                                                        '<option value="Cartoon">Cartoon</option>'+
                                                        '<option value="Pack">Pack</option>'+
                                                    '</select>'+
                                                '</div>'+
                                                '<div class="col-xs-1 col-sm-1">'+
                                                    '<a href="#" class="remove_field btn btn-danger"><i class="fa fa-trash"></i></a>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>');
                    }
                });

                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text 
                    e.preventDefault(); $("#div1").remove(); x--;
                })

            });
  
        });
    </script>
@endsection