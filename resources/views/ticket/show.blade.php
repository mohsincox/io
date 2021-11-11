@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <!-- <div class="box-header">
                        <h3 class="box-title">Ticket List</h3> 
                        <div class="box-tools pull-right">
                            <a href="{{ url('ticket/create') }}" class="btn btn-primary btn-flat"> <i class="fa fa-plus"></i> Create Ticket</a>
                        </div>
                    </div> -->
                    <div class="box-body">
                        
                        

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
                                                <!-- <tr>
                                                    <td><b>Product Detail</b></td>
                                                    <td>{{ $ticket->product_model }}</td>
                                                    <td><b>Area Assigned</b></td>
                                                    <td>{{ $ticket->area_assigned }}</td>
                                                </tr> -->
                                                <?php
                                                    $productDetail = str_replace( ['[', ']', '{', '}', '"'], "", $ticket->product_detail );
                                                ?>
                                                <tr>
                                                    <td><b>Product Detail</b></td>
                                                    <td colspan="3">{{ $productDetail }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Delivery DateTime</b></td>
                                                    <td>{{ $ticket->delivery_time }}</td>
                                                    <td><b>Delivery Stauts</b></td>
                                                    <td>{{ $ticket->delivery_status }}</td>
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
                                                <tr>
                                                    <td><b>Total Price</b></td>
                                                    <td>{{ $ticket->total_price }} Taka</td>
                                                    <td><b>Online P. Done</b></td>
                                                    <td>{{ $ticket->online_payment }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Discount</b></td>
                                                    <td>{{ $ticket->discount }}</td>
                                                    <td><b></b></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Payment Status</b></td>
                                                    <td>{{ $ticket->payment_status }}</td>
                                                    <td><b>Gift</b></td>
                                                    <td>{{ $ticket->gift }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Delivery Boy</b></td>
                                                    @if(isset($ticket->dbAssigned))
                                                        <td>{{ $ticket->dbAssigned->name .': '.$ticket->dbAssigned->depot_app_user }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td><b>Supervisor</b></td>
                                                    @if(isset($ticket->svAssigned))
                                                        <td>{{ $ticket->svAssigned->name .': '.$ticket->svAssigned->depot_app_user }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                   <div class="row">
                                        <div class="col-md-offset-3 col-md-6">
                                            @if(isset($ticket->product_detail))

                                                <?php
                                                    $productDecode = json_decode($ticket->product_detail);
                                                ?>

                                                @if(json_last_error() == JSON_ERROR_NONE)
                                                <h4><code>Product Details</code></h4> 
                                                <div class="table-responsive"> 
                                                    <table id="" class="table table-bordered table-striped table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Qty</th>
                                                                <th>Unit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($productDecode as $value)
                                                        <tr>
                                                            <td>{{ $value->Name }}</td>
                                                            <td>{{ $value->Qty }}</td>
                                                            @if(isset($value->Unit))
                                                                <td>{{ $value->Unit }}</td>
                                                            @else
                                                                <td></td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @endif
                                            @endif
                                        </div>
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

                                    <div class="box-footer">
                                        <!-- <a href="#" class="btn btn-default">Cancel</a> -->
                                       
                                        <a href="{{ url('/ticket/'.$ticket->id.'/edit') }}" class="btn btn-success btn-xs btn-block">Update This Ticket</a>
                                        
                                    </div>

                                    <hr>
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
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}"> -->
    <style type="text/css">
        hr {
            margin-top: 0px;
            margin-bottom: 0px;
            border: 0;
            border-top: 2px solid #000;
        }

        .panel-heading {
            padding: 0px 15px;
        }
    </style>
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