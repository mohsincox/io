@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content">
	    <div class="row">
	    	<div class="col-md-12">
	        	<div class="box box-primary">
	            	<div class="box-header">
	                	<h3 class="box-title">SKU Information From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3>
	            	</div>
	            	<div class="box-body">
	                    <div class="table-responsive"> 
	                        <table id="example" class="table table-bordered table-striped">
	                            <thead>
	                                <tr>
			                            <th>ID</th>
			                            <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>dbAssigned</th>
		                            </tr>
	                            </thead>
	                            <tbody>
	                            <?php
	                                $i = 0;
	                            ?>
	                            @foreach($tickets as $ticket)
	                            	<?php
                                        $productDecode = json_decode($ticket->product_detail);
                                    ?>
                                    @if(json_last_error() == JSON_ERROR_NONE)
                                        @if(isset($productDecode))     
			                                @foreach($productDecode as $value)
	                                        <tr>
	                                            <td>{{ $ticket->id }}</td>
	                                            <td>{{ $value->Name }}</td>
	                                            <td>{{ $value->Qty }}</td>
	                                            @if(isset($value->Unit))
	                                                <td>{{ $value->Unit }}</td>
	                                            @else
	                                                <td></td>
	                                            @endif
	                                            @if(isset($ticket->dbAssigned))
	                                                <td>{{ $ticket->dbAssigned->name }}</td>
	                                            @else
	                                                <td></td>
	                                            @endif
	                                        </tr>
	                                        @endforeach
                                        @endif

	                                @endif
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

    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js') }}"></script>
    
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('#example').DataTable();
        // } );
        $(document).ready(function() {
		    $('#example').DataTable( {
		        dom: 'Bfrtip',
		        buttons: [
		            'copy', 'csv', 'excel', 'pdf', 'print'
		        ]
		        // buttons: [
		        //     'excel'
		        // ]
		    } );
		} );
    </script>
@endsection