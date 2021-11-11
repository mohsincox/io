@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<section class="content">
	    <div class="row">
	    	<div class="col-md-12">
	        	<div class="box box-primary">
	            	<div class="box-header">
	                	<h3 class="box-title">Online Payment Wise Ticket Information From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3>
	            	</div>
	            	<div class="box-body">
	                    <div class="table-responsive"> 
	                        <table id="example" class="table table-bordered table-striped">
	                            <thead>
	                                <tr>
                                        <!-- <th>SL</th> -->
                                        <th>TID</th>
                                        <th>Assigned</th>
                                        <th>Subject</th>
                                        <th>Ticket Type</th>
                                        <th>Ticket Status</th>
                                        <th>Delivery Status</th>
                                        <th>Delivery Boy</th>
                                        <th>Delivery Time</th>
                                        <th>Online</th>
                                        <th>Cus. Name</th>
                                        <th>Phone No</th>
                                        <th>Cus. Address</th>
                                        <!-- <th>Edit</th> -->
                                        <th>CreatedBy</th>
                                        <th>CreatedAt</th>
                                        <th>TicketAge</th>
                                        
                                    </tr>
	                            </thead>
	                            <tbody>
	                            <?php
	                                $i = 0;
	                            ?>
	                            @foreach($tickets as $ticket)
	                            	<?php
                                        $interval = date_diff(date_create(), date_create($ticket->created_at));
                                        $ticketAge = $interval->format("%yy, %mm, %dd");

                                        if ($ticket->delivery_status == 'Order collected from depot') {
                                            $bgCSS = 'background-color: #FFA500;';
                                        } else if ($ticket->delivery_status == 'On the way for order deliver') {
                                            $bgCSS = 'background-color: #FFFF00;';
                                        } else if ($ticket->delivery_status == 'Order delivered (cash payment)') {
                                            $bgCSS = 'background-color: #008000;';
                                        } else if ($ticket->delivery_status == 'Order delivered (card payment)') {
                                            $bgCSS = 'background-color: #008000;';
                                        } else if ($ticket->delivery_status == 'Order cancelled') {
                                            $bgCSS = 'background-color: #FF0000;';
                                        } else {
                                            $bgCSS = '';
                                        }

                                        if ($ticket->ticket_status_id == 3) {
                                            $bgTsCSS = 'background-color: #008000;';
                                        } else if ($ticket->ticket_status_id == 5) {
                                            $bgTsCSS = 'background-color: #FF0000;';
                                        } else {
                                            $bgTsCSS = '';
                                        }
                                    ?>
                                    <tr>
                                        <!-- <td>{{ ++$i }}</td> -->
                                        <td><a class="btn btn-primary btn-xs" href="{{ url('/ticket/' . $ticket->id) }}">{{ $ticket->id }}</a></td>
                                        @if(isset($ticket->assigned->name))
                                            <td>{{ $ticket->assigned->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $ticket->subject }}</td>
                                        @if(isset($ticket->ticketType->name))
                                            <td>{{ $ticket->ticketType->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if(isset($ticket->ticketStatus->name))
                                            <td style="{{ $bgTsCSS }}">{{ $ticket->ticketStatus->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td style="{{ $bgCSS }}">{{ $ticket->delivery_status }}</td>
                                        @if(isset($ticket->dbAssigned))
                                            <td>{{ $ticket->dbAssigned->name }}</td>
                                        @else
                                            <td class="text-red">Doesn't assigned</td>
                                        @endif
                                        <td>{{ $ticket->delivery_time }}</td>
                                        <td>{{ $ticket->online_payment }}</td>
                                        <td>{{ $ticket->customer_name }}</td>
                                        <td>{{ $ticket->phone_number }}</td>
                                        <td>{{ $ticket->customer_address }}</td>
                                        <!-- <td>{!! Html::link("ticket/$ticket->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-primary btn-xs']) !!}</td> -->
                                        @if(isset($ticket->createdBy->name))
                                            <td>{{ $ticket->createdBy->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $ticket->created_at }}</td>
                                        <td>{{ $ticketAge }}</td>
                                        
                                    </tr>
	                            @endforeach
	                            </tbody>
	                        </table>
	                    </div>
	            	</div>
	      		</div>
	    	</div>
	  	</div>
	</section>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection