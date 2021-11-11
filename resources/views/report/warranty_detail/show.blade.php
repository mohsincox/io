@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content">
	    <div class="row">
	    	<div class="col-md-12">
	        	<div class="box box-primary">
	            	<div class="box-header">
	                	<h3 class="box-title">Ticket Details Information From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3> 
	            	</div>
	            	<div class="box-body">
	                    <div class="table-responsive"> 
	                        <table id="example" class="table table-bordered table-striped">
	                            <thead>
	                                <tr>
	                                    <th>SL</th>
	                                    <th>TID</th>
	                                    <th>product_serial</th>
	                                    <th>warranty_code</th>
	                                    <th>Create Time</th>
	                                    <th>Number</th>
	                                    <th>Name</th>
	                                    <th>Address</th>
	                                    <th>Assigned</th>
	                                    <th>Status</th>
	                                    <th>Purchase Date</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            <?php
	                                $i = 0;
	                            ?>
	                            @foreach($warrantyDetails as $warranty)
	                                <tr>
	                                    <td>{{ ++$i }}</td>
	                                    <td><b><a href="{{ url('/ticket/' . $warranty->ticket_id) }}">{{ $warranty->ticket_id }}</a></b></td>
	                                    <td>{{ $warranty->product_serial }}</td>
	                                    <td>{{ $warranty->warranty_code }}</td>
	                                    <td>{{ $warranty->created_at }}</td>
	                                    <td>{{ $warranty->ticket->phone_number }}</td>
	                                    <td>{{ $warranty->ticket->customer_name }}</td>
	                                    <td>{{ $warranty->ticket->customer_address }}</td>
	                                    @if(isset($warranty->ticket->assigned->name))
                                            <td>{{ $warranty->ticket->assigned->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
	                                    @if(isset($warranty->ticket->ticketStatus->name))
                                            <td>{{ $warranty->ticket->ticketStatus->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $warranty->ticket->date_of_purchase }}</td>
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