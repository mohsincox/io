@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
            	<div class="box box-primary">
                	<div class="box-header">
                    	<h3 class="box-title">List of Sent SMS & Mobile No.</h3> 
                    	<div class="box-tools pull-right">
                    		<a href="{{ url('sms-send/create') }}" class="btn btn-primary btn-flat"> <i class="fa fa-plus"></i> Create <code><b>SMS to send</b></code></a>
                    	</div>
                	</div>
                	<div class="box-body">
                        <div class="table-responsive"> 
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
			                            <th>Mobile No</th>
			                            <th>Message</th>
			                            <th>CreatedBy</th>
			                            <th>CreatedAt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
		                        	$i = 0;
			                    ?>
			                    @foreach($messages as $sms)
			                        <tr>
			                            <td>{{ ++$i }}</td>
			                            <td>{{ $sms->phone_number }}</td>
			                            <td>{{ $sms->message }}</td>
			         					<td>{{ $sms->createdBy->name }}</td>
			         					<td>{{ $sms->created_at }}</td>
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