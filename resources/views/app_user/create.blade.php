@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-8 col-sm-offset-2">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">App User Create</h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-pencil"></i> Create Form of <code><b>App User</b></code> </h3>
    							</div>
    							<div class="card-body">
    						  		
    								@include('app_user._form')

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