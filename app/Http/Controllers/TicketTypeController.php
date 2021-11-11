<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\TicketType;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class TicketTypeController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$ticketTypes = TicketType::get();
    	return view('ticket_type.index', compact('ticketTypes'));
    }

    public function create()
    {
    	return view('ticket_type.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:ticket_types'
	    ];
	    $messages = [
            'name.required' => 'The Ticket Type field is required.',
            'name.unique' => 'The Ticket Type already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $ticketType = new TicketType;
        $ticketType->name = $request->name;
        $ticketType->created_by = Auth::id();
        $ticketType->save();
        flash()->success($ticketType->name.' Ticket Type created successfully');
    	return redirect('ticket-type');
    }

    public function edit($id)
    {
    	$ticketType = TicketType::find($id);
    	return view('ticket_type.edit', compact('ticketType'));
    }
    
    public function update(Request $request, $id)
    {
    	$ticketType = TicketType::find($id);
    	$input = Input::all();
	    $rules = [
	    	'name' => 'required|unique:ticket_types,name,'.$ticketType->id,
	    	'status' => 'required',
	    ];
	    $messages = [
            'name.required' => 'The Ticket Type field is required.',
            'name.unique' => 'The Ticket Type already exist.'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $ticketType->name = $request->name;
        $ticketType->status = $request->status;
        $ticketType->updated_by = Auth::id();
        $ticketType->save();
        flash()->success($ticketType->name.' Ticket Type updated successfully');
    	return redirect('ticket-type');
    }
}
