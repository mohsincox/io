@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
            	<div class="box box-primary">
                	<div class="box-header">
                    	<h3 class="box-title">App Users List</h3> 
                    	<div class="box-tools pull-right">
                    		<a href="{{ url('app-user/create') }}" class="btn btn-primary btn-flat"> <i class="fa fa-plus"></i> Create App User</a>
                    	</div>
                	</div>
                	<div class="box-body">
                        <div class="table-responsive"> 
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>User</th>
                                        <th>Pass</th>
                                        <th>Role</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Short Form</th>
                                        <th>Designation</th>
                                        <th>Delivery Point</th>
                                        <th>Area Covered</th>
                                        <th>Remarks</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 0;
                                ?>
                                @foreach($appUsers as $appUser)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td><b>{{ $appUser->username }}</b></td>
                                        <td><b>{{ $appUser->password }}</b></td>
                                        <td class="text-capitalize">{{ $appUser->role }}</td>
                                        <td>{{ $appUser->name }}</td>
                                        <td>{{ $appUser->phone_number }}</td>
                                        <td>{{ $appUser->detail }}</td>
                                        <td>{{ $appUser->designation }}</td>
                                        <td>{{ $appUser->delivery_point }}</td>
                                        <td>{{ $appUser->area_covered }}</td>
                                        <td>{{ $appUser->remarks }}</td>
                                        <td>{!! Html::link("app-user/$appUser->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success btn-xs btn-flat']) !!}</td>
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