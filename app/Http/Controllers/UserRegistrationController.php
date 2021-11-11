<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class UserRegistrationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$regUsers = User::whereIn('role', ['app_admin', 'app_user'])->get();
    	return view('registration.index', compact('regUsers'));
    }

    public function create()
    {
    	return view('registration.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'email' => 'required|unique:users',
	    	'password' => 'required|min:6',
	    	// 'role' => 'required',
	    	'name' => 'required|unique:users',
            'depot_app_user' => 'required',
	    	'phone_number' => 'required|numeric|digits_between:11,11',
            'zone' => 'required',
	    	
	    ];
	    $messages = [
            'email.required' => 'The Username field is required.',
            'email.unique' => 'The Username already exist.',
            'name.required' => 'The Name field is required.',
            'name.unique' => 'The Name already exist.',
            'depot_app_user.required' => 'The Area/Depot/Mobile field is required.',
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $regUser = new User;
        $regUser->email = $request->email;
        $regUser->password = bcrypt($request->password);
        $regUser->secret = base64_encode($request->password);
        $regUser->role = 'app_user';
        $regUser->name = $request->name;
        $regUser->depot_app_user = $request->depot_app_user;
        $regUser->phone_number = $request->phone_number;
        $regUser->zone = $request->zone;
        $regUser->created_by = Auth::id();
        $regUser->save();
        flash()->success($regUser->name.' User registration created successfully');
    	return redirect('user-registration');
    }

    public function edit($id)
    {
        $regUser = User::find($id);
        return view('registration.edit', compact('regUser'));
    }
    
    public function update(Request $request, $id)
    {
        $regUser = User::find($id);
        $input = Input::all();
        $rules = [
            'email' => 'required|unique:users,email,'.$regUser->id,
            'password' => 'required|min:6',
            // 'role' => 'required',
            'name' => 'required|unique:users,name,'.$regUser->id,
            'depot_app_user' => 'required',
            'phone_number' => 'required|numeric|digits_between:11,11',
            'zone' => 'required',
            
        ];
        $messages = [
            'email.required' => 'The Username field is required.',
            'email.unique' => 'The Username already exist.',
            'name.required' => 'The Name field is required.',
            'name.unique' => 'The Name already exist.',
            'depot_app_user.required' => 'The Area/Depot/Mobile field is required.',
        ];
        // $rules = [
        //     'name' => 'required|unique:ticket_statuses,name,'.$ticketStatus->id,
        //     'status' => 'required',
        // ];
        // $messages = [
        //     'name.required' => 'The Ticket Status field is required.',
        //     'name.unique' => 'The Ticket Status already exist.'
        // ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $regUser->email = $request->email;
        $regUser->password = bcrypt($request->password);
        $regUser->secret = base64_encode($request->password);
        // $regUser->role = 'app_user';
        $regUser->name = $request->name;
        $regUser->depot_app_user = $request->depot_app_user;
        $regUser->phone_number = $request->phone_number;
        $regUser->zone = $request->zone;
        $regUser->updated_by = Auth::id();
        $regUser->save();
        flash()->success($regUser->name.' User registration updated successfully');
        return redirect('user-registration');
    }
}
