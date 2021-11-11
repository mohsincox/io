@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-12 col-sm-offset-0">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">Ticket </h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-edit"></i> Update Form of <code><b>Ticket</b></code> </h3>
    							</div>
                                
    							<div class="card-body">
    						  		
                                    {!! Form::model($ticket, ['url' => "ticket/$ticket->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
                                    
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group {{ $errors->has('ticket_status_id') ? 'has-error' : ''}}">
                                                {!! Form::label('ticket_status_id', 'Ticket Status', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::select('ticket_status_id', $ticketStatusList, null, ['class' => 'form-control','placeholder' => 'Select Ticket Status']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('ticket_status_id') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('remarks_update') ? 'has-error' : ''}}">
                                                {!! Form::label('remarks_update', 'Remarks', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::textarea('remarks_update', null, ['class' => 'form-control', 'placeholder' => 'Enter Verbatim or Issue', 'autocomplete' => 'off', 'rows' => 3]) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('remarks_update') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <!-- <button type="button" class="btn btn-default">Cancel</button> -->
                                        <a href="{{ url('/ticket') }}" class="btn btn-default">Cancel</a>
                                       
                                         {!! Form::button('Submit', ['class' => 'btn btn-success pull-right', 'data-toggle' => 'modal', 'data-target' => '#ticket_update']) !!}
                                    </div>

                                    <div class="modal modal-warning fade" id="ticket_update">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">Confirmation Message</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Want to Update Ticket?</h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline">Update Ticket</button>
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



                <div class="panel panel-primary">
                            <div class="panel-heading text-center"><code>Ticket ID: <b>{{ $ticket->id }}</b></code> <code>Customer Number: <b>{{ $ticket->phone_number }}</b></code></div>
                                <div class="panel-body">
                            
                                    <h4><code>Ticket ID: <b><a href="{{ url('/ticket/' . $ticket->id) }}">{{ $ticket->id }}</a></b></code></h4> 
                                    <div class="table-responsive">          
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><b>Customer Number</b></td>
                                                    <td>{{ $ticket->phone_number }}</td>
                                                    <td><b>Customer Name</b></td>
                                                    <td>{{ $ticket->customer_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Subject</b></td>
                                                    <td>{{ $ticket->subject }}</td>
                                                    <td><b>Assigned Person</b></td>
                                                    @if(isset($ticket->assigned->name))
                                                        <td>{{ $ticket->assigned->name }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><b>Ticket Type</b></td>
                                                    @if(isset($ticket->ticketType->name))
                                                        <td>{{ $ticket->ticketType->name }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td><b>Ticket Status</b></td>
                                                    @if(isset($ticket->ticketStatus->name))
                                                        <td>{{ $ticket->ticketStatus->name }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><b>Customer Name</b></td>
                                                    <td>{{ $ticket->customer_name }}</td>
                                                    <td><b>Customer Address</b></td>
                                                    <td>{{ $ticket->customer_address }}</td>
                                                </tr>
                                                <!-- <tr>
                                                    <td><b>District</b></td>
                                                    @if(isset($ticket->district->name))
                                                        <td>{{ $ticket->district->name }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td><b>Division</b></td>
                                                    @if(isset($ticket->division->name))
                                                        <td>{{ $ticket->division->name }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                </tr> -->
                                                <tr>
                                                    <td><b>Product Detail</b></td>
                                                    <td>{{ $ticket->product_model }}</td>
                                                    <td><b>Area Assigned</b></td>
                                                    <td>{{ $ticket->area_assigned }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Product Price</b></td>
                                                    <td>{{ $ticket->product_price }}</td>
                                                    <td><b>Client & Discount</b></td>
                                                    <td>{{ $ticket->client_discount }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Created At</b></td>
                                                    <td>{{ $ticket->created_at }}</td>
                                                    <td><b>Updated At</b></td>
                                                    <td>{{ $ticket->updated_at }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Created By</b></td>
                                                    <td>{{ $ticket->createdBy->name }}</td>
                                                    <td><b>Updated By</b></td>
                                                    @if(isset($ticket->updatedBy->name))
                                                        <td>{{ $ticket->updatedBy->name }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                   

                                    <h4><code>Ticket Details</code></h4> 
                                    <div class="table-responsive"> 
                                        <table id="" class="table table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>Ticket Status</th>
                                                    <th>Remarks</th>
                                                    <th>Created By</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($ticket->ticketDetails as $ticketDetail)
                                            <tr>
                                                @if(isset($ticketDetail->ticketStatus->name))
                                                    <td>{{ $ticketDetail->ticketStatus->name }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                
                                                <td>{{ $ticketDetail->remarks }}</td>

                                                @if(isset($ticketDetail->createdBy->name))
                                                    <td>{{ $ticketDetail->createdBy->name }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ $ticketDetail->created_at }}</td>

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
    <style type="text/css">
       
        .panel-heading {
            padding: 0px 15px;
        }
    </style>
@endsection
