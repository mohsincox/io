<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\TicketStatus;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class TicketStatusController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$ticketStatuses = TicketStatus::get();
    	return view('ticket_status.index', compact('ticketStatuses'));
    }

    public function create()
    {
    	return view('ticket_status.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:ticket_statuses'
	    ];
	    $messages = [
            'name.required' => 'The Ticket Status field is required.',
            'name.unique' => 'The Ticket Status already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $ticketStatus = new TicketStatus;
        $ticketStatus->name = $request->name;
        $ticketStatus->created_by = Auth::id();
        $ticketStatus->save();
        flash()->success($ticketStatus->name.' Ticket Status created successfully');
    	return redirect('ticket-status');
    }

    public function edit($id)
    {
    	$ticketStatus = TicketStatus::find($id);
    	return view('ticket_status.edit', compact('ticketStatus'));
    }
    
    public function update(Request $request, $id)
    {
    	$ticketStatus = TicketStatus::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:ticket_statuses,name,'.$ticketStatus->id,
	    	'status' => 'required',
	    ];
	    $messages = [
            'name.required' => 'The Ticket Status field is required.',
            'name.unique' => 'The Ticket Status already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $ticketStatus->name = $request->name;
        $ticketStatus->status = $request->status;
        $ticketStatus->updated_by = Auth::id();
        $ticketStatus->save();
        flash()->success($ticketStatus->name.' Ticket Status updated successfully');
    	return redirect('ticket-status');
    }
}
