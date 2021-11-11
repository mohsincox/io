<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\AppUser;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class AppUserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$appUsers = AppUser::get();
    	return view('app_user.index', compact('appUsers'));
    }

    public function create()
    {
    	return view('app_user.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
	    	'username' => 'required|unique:app_users',
	    	'password' => 'required',
	    	'role' => 'required',
	    	'name' => 'required',
	    	'phone_number' => 'required|numeric|digits_between:11,11',
	    	'detail' => 'required|unique:app_users',
	    	'designation' => 'required',
	    	'delivery_point' => 'required',
	    	'area_covered' => 'required',
	    	'remarks' => 'required',
	    ];
	    $messages = [
            'username.required' => 'The App Username field is required.',
            'username.unique' => 'The App Useruame already exist.',
            'detail.required' => 'The Short Form field is required.',
            'detail.unique' => 'The Short Form already exist.',
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $appUser = new AppUser;
        $appUser->username = $request->username;
        $appUser->password = $request->password;
        $appUser->role = $request->role;
        $appUser->name = $request->name;
        $appUser->phone_number = $request->phone_number;
        $appUser->detail = $request->detail;
        $appUser->designation = $request->designation;
        $appUser->delivery_point = $request->delivery_point;
        $appUser->area_covered = $request->area_covered;
        $appUser->remarks = $request->remarks;
        $appUser->created_by = Auth::id();
        $appUser->save();
        flash()->success($appUser->name.' App User information created successfully');
    	return redirect('app-user');
    }

    public function edit($id)
    {
    	$appUser = AppUser::find($id);
    	return view('app_user.edit', compact('appUser'));
    }
    
    public function update(Request $request, $id)
    {
    	$appUser = AppUser::find($id);
    	$input = Input::all();
	    $rules = [
	    	'username' => 'required|unique:app_users,username,'.$appUser->id,
	    	'password' => 'required',
	    	'role' => 'required',
	    	'name' => 'required',
	    	'phone_number' => 'required|numeric|digits_between:11,11',
	    	'detail' => 'required|unique:app_users,detail,'.$appUser->id,
	    	'designation' => 'required',
	    	'delivery_point' => 'required',
	    	'area_covered' => 'required',
	    	'remarks' => 'required',
	    ];
	    $messages = [
            'username.required' => 'The App Username field is required.',
            'username.unique' => 'The App Username already exist.',
            'detail.required' => 'The Short Form field is required.',
            'detail.unique' => 'The Short Form already exist.',
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $appUser->username = $request->username;
        $appUser->password = $request->password;
        $appUser->role = $request->role;
        $appUser->name = $request->name;
        $appUser->phone_number = $request->phone_number;
        $appUser->detail = $request->detail;
        $appUser->designation = $request->designation;
        $appUser->delivery_point = $request->delivery_point;
        $appUser->area_covered = $request->area_covered;
        $appUser->remarks = $request->remarks;
        $appUser->updated_by = Auth::id();
        $appUser->save();
        flash()->success($appUser->name.' App User information updated successfully');
    	return redirect('app-user');
    }
}
