<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\SmsSend;

class SmsSendController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        $messages = SmsSend::with('createdBy')->orderBy('created_at', 'desc')->get();
        return view('sms_send.index', compact('messages'));
    }

    public function create()
    {
    	return view('sms_send.create');
    }

    public function store(Request $request)
    {
    	$input = Input::all();
        $rules = [
        	'phone_number' => 'required|numeric|digits_between:11,11',
            'message' => 'required|max:120'
        ];
        $messages = [

       	];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $smsPhoneNumber = $request->phone_number;
        $smsBody = $request->message;

        // $client = new \GuzzleHttp\Client();
        // $res = $client->request('GET', 'http://api.rankstelecom.com/api/v3/sendsms/plain?user=nte&password=Anoor10203040&sender=044XXXXXXXX&SMSText='. $smsBody .'&GSM=88'.$smsPhoneNumber);

        // $a = $res->getBody();

        


        $sms = new SmsSend;
        $sms->phone_number = $smsPhoneNumber;
        $sms->message = $smsBody;
        $sms->created_by = Auth::id();
        $sms->save();

        flash()->success('SMS sent successfully to '.$smsPhoneNumber);
        //flash()->success(', message sent successfully');
        return redirect('sms-send');
    }
}
