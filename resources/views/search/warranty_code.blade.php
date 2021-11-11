@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content">
	    <div class="row">
	    	<div class="col-md-12">
	        	<div class="box box-primary">
	            	<div class="box-header">
	                	<h3 class="box-title">Ticket Details Information of <i><code>{{ $mobileOrCode }}</code></i></h3> 
	            	</div>
	            	<div class="box-body">
	                    <div class="table-responsive"> 
	                        <table id="example" class="table table-bordered table-striped">
	                            <thead>
	                                <tr>
	                                    <th>SL</th>
	                                    <th>TID</th>
	                                    <th>warranty_code</th>
	                                    <th>product_serial</th>
	                                    
	                                    <th>Assigned</th>
	                                    <th>Ticket Type</th>
	                                    <th>Ticket Status</th>
	                                    <th>Cus. Name</th>
	                                    <th>Phone No</th>
	                                    <th>Cus. Address</th>
	                                    <th>CreatedBy</th>
			                            <th>CreateAt</th>
			                            <th>TicketAge</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            <?php
	                                $i = 0;
	                            ?>
	                            @foreach($warrantyDetails as $warranty)
	                            	<?php
										$interval = date_diff(date_create(), date_create($warranty->created_at));
										$ticketAge = $interval->format("%yy, %mm, %dd");
									?>
	                                <tr>
	                                    <td>{{ ++$i }}</td>
	                                    <td><b><a href="{{ url('/ticket/' . $warranty->ticket_id) }}">{{ $warranty->ticket_id }}</a></b></td>
	                                    <td>{{ $warranty->warranty_code }}</td>
	                                    <td>{{ $warranty->product_serial }}</td>
	                                    
	                                    
	                                    @if(isset($warranty->ticket->assigned->name))
                                            <td>{{ $warranty->ticket->assigned->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if(isset($warranty->ticket->ticketType->name))
                                            <td>{{ $warranty->ticket->ticketType->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        @if(isset($warranty->ticket->ticketStatus->name))
                                            <td>{{ $warranty->ticket->ticketStatus->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
	                                    <td>{{ $warranty->ticket->customer_name }}</td>
	                                    <td>{{ $warranty->ticket->phone_number }}</td>
	                                    <td>{{ $warranty->ticket->customer_address }}</td>
	                                    @if(isset($warranty->ticket->createdBy->name))
	                                        <td>{{ $warranty->ticket->createdBy->name }}</td>
	                                    @else
	                                        <td></td>
	                                    @endif
	                                    <td>{{ $warranty->created_at }}</td>
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
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}"> -->
@endsection

@section('script')
    <!-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script> -->
@endsection