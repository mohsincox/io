@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
	    <div class="col-sm-12">
	        <h3 style="margin-top: 0px;">
	            <i class="fa fa-list-ul"></i>
	            List of <mark>Divisions</mark>
	            @can('ticket_admin-access')
		            <a href="{{ url('division/create') }}" class="btn btn-primary pull-right">
		                <i class="fa fa-plus"></i> Create <code><b>Division</b></code>
		            </a>
				@endcan
	        </h3>
	        <div class="panel panel-info">
	            <div class="panel-heading">
	                <h3 class="panel-title text-center"><i class="fa fa-list-ul"></i> List of <code><b>Divisions</b></code></h3>
	            </div>
	            <div class="panel-body">
	            	<div class="table-responsive">
		                <table id="myTable" class="table table-bordered table-striped table-hover">
		                    <thead>
		                        <tr class="success">
		                            <th>SL</th>
		                            <th>Division</th>
		                            @can('ticket_admin-access')
		                            	<th>Edit</th>
		                            @endcan
		                        </tr>
		                    </thead>
		                    <tbody>
		                    <?php
		                        $i = 0;
		                    ?>
		                    @foreach($divisions as $division)
		                        <tr>
		                            <td>{{ ++$i }}</td>
		                            <td><strong>{{ $division->name }}</strong></td>
		                            @can('ticket_admin-access')
		                            	<td>{!! Html::link("division/$division->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-primary btn-xs']) !!}</td>
		                            @endcan
		                        </tr>
		                    @endforeach
		                    </tbody>
		                </table>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('script')
	<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
    
	<script type="text/javascript">
	    $(document).ready(function(){
	        $('#myTable').DataTable();
	    });
	</script>
@endsection