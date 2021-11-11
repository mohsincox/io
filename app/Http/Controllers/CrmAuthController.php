<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Crm;

class CrmAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$crms = Crm::orderBy('id', 'desc')->paginate(15);

    	return view('crm.index', compact('crms'));
    }
}
