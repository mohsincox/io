<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Crm;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Excel;

class ExcelReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function crmFormExcel()
    {

        return view('report.crm.form_excel');
    }

    public function crmShowExcel(Request $request)
    {
        // return $request->all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';
        $type = $request->type;
        $callType = $request->camp_in_or_out;

        // return $crms = Crm::with(['district', 'division'])->where('camp_in_or_out', $callType)->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

        Excel::create('CRM_'.$callType.'_'.$startDate.'to'.$endDate, function($excel) use ($callType, $startDateTime, $endDateTime, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($callType, $startDateTime, $endDateTime, $type) {
                
                $crms = Crm::with(['district', 'division'])->where('camp_in_or_out', $callType)->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

                $arr =array();
                foreach($crms as $crm) {
                    if (isset($crm->district->name)) {
                        $district = $crm->district->name;
                    } else {
                        $district = null;
                    }

                    if (isset($crm->division->name)) {
                        $division = $crm->division->name;
                    } else {
                        $division = null;
                    }
                   
                    $data =  array($crm->customer_name, $crm->phone_number, $crm->gender, $crm->date_of_birth, $crm->marriage_day, $crm->profession, $crm->customer_email, $crm->customer_address, $crm->customer_area, $district, $crm->type_of_customer, $crm->query_type, $crm->product_model, $crm->product_price, $crm->client_discount, $crm->remarks, $crm->customer_order, $crm->create_ticket, $crm->area_assigned, $crm->call_remarks, $crm->camp_in_or_out, $crm->agent, $crm->created_at);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Customer Name', 'Phone Number', 'Gender', 'Date of Birth', 'Marriage Day', 'Profession', 'Customer Email', 'Customer Address', 'Customer Area', 'District', 'Type of Customer', 'Query Type', 'Product Detail', 'Product Price', 'Client & Dis', 'Conversation Detail', 'Customer Order', 'Create Ticket', 'Area Assigned Person', 'Call Remarks', 'Call Type', 'Agent', 'Created At'
                    )

                );

            });

        })->export($type);
    }

    public function ticketFormExcel()
    {
        return view('report.ticket.form_excel');
    }

    public function ticketShowExcel(Request $request)
    {   //return $request->all();
        $startDate = $request->start_date.' 00:00:00';
        $endDate = $request->end_date.' 23:59:59';
        $type = $request->type;
        Excel::create('Ticket_from_'.$request->start_date.'_to_'.$request->end_date, function($excel) use ($startDate,  $endDate, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($startDate,  $endDate, $type) {

                $adminIdNorth = [15];
                $adminIdSouth = [16];

                // if (in_array(Auth::id(), $adminIdNorth)) {
                if (Auth::user()->zone == 'Dhaka North') {

                    $tickets = Ticket::with(['assigned', 'ticketType', 'ticketStatus'])->whereIn('sv_assigned_id', $adminIdNorth)->whereBetween('created_at', [$startDate, $endDate])->get();

                // } else if (in_array(Auth::id(), $adminIdSouth)) {
                } else if (Auth::user()->zone == 'Dhaka South') {

                    $tickets = Ticket::with(['assigned', 'ticketType', 'ticketStatus'])->whereIn('sv_assigned_id', $adminIdSouth)->whereBetween('created_at', [$startDate, $endDate])->get();

                } else {
                    
                    $tickets = Ticket::with(['assigned', 'ticketType', 'ticketStatus'])->whereBetween('created_at', [$startDate, $endDate])->get();
                }
                

                $arr =array();
                foreach($tickets as $ticket) {
                    if (isset($ticket->assigned->name)) {
                        $assigned = $ticket->assigned->name;
                    } else {
                        $assigned = null;
                    }
                    if (isset($ticket->ticketType->name)) {
                        $ticketType = $ticket->ticketType->name;
                    } else {
                        $ticketType = null;
                    }
                    if (isset($ticket->ticketStatus->name)) {
                        $ticketStatus = $ticket->ticketStatus->name;
                    } else {
                        $ticketStatus = null;
                    }
                    if (isset($ticket->createdBy->name)) {
                        $createdBy = $ticket->createdBy->name;
                    } else {
                        $createdBy = null;
                    }
                    if (isset($ticket->updatedBy->name)) {
                        $updatedBy = $ticket->updatedBy->name;
                    } else {
                        $updatedBy = null;
                    }
                    if (isset($ticket->panelFeedBackBy->name)) {
                        $panelFeedBackBy = $ticket->panelFeedBackBy->name;
                    } else {
                        $panelFeedBackBy = null;
                    }
                    if (isset($ticket->agentClosedBy->name)) {
                        $agentClosedBy = $ticket->agentClosedBy->name;
                    } else {
                        $agentClosedBy = null;
                    }
                    if (isset($ticket->division->name)) {
                        $division = $ticket->division->name;
                    } else {
                        $division = null;
                    }
                    if (isset($ticket->district->name)) {
                        $district = $ticket->district->name;
                    } else {
                        $district = null;
                    }

                    if (isset($ticket->dbAssigned->name)) {
                        $dbAssigned = $ticket->dbAssigned->name;
                    } else {
                        $dbAssigned = null;
                    }

                    $data =  array($ticket->id, $ticket->subject, $assigned, $ticketType, $ticketStatus, $ticket->phone_number, $ticket->customer_name, $ticket->customer_address, $ticket->product_model, $ticket->product_detail, $ticket->product_price, $ticket->total_price, $ticket->online_payment, $ticket->client_discount, $dbAssigned, $ticket->remarks, $ticket->created_at, $ticket->updated_at, $createdBy, $updatedBy);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'TID', 'Subject', 'Assigned', 'Ticket Type', 'Ticket Status', 'Phone Number', 'Customer Name', 'Customer Address', 'Product old', 'Product Detail', 'Product Price', 'Total Price', 'Online', 'Client & Dis', 'DB Assigned', 'Remarks', 'Created At', 'Updated At', 'Created By', 'Updated By'
                    )

                );

            });

        })->export($type);
    }
}
