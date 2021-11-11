<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\District;
use App\Models\Division;
use App\Models\TicketType;
use App\Models\TicketStatus;
use App\Models\Ticket;
use App\Models\TicketDetail;
use App\Models\Option;
use App\Models\AppUser;
use App\User;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $adminIdNorth = [15];
        $adminIdSouth = [16];

        // if (in_array(Auth::id(), $adminIdNorth)) {
        if (Auth::user()->zone == 'Dhaka North') {

            $tickets = Ticket::with(['ticketDetails'])->whereIn('sv_assigned_id', $adminIdNorth)->orderBy('id', 'desc')->paginate(20);

        // } else if (in_array(Auth::id(), $adminIdSouth)) {
        } else if (Auth::user()->zone == 'Dhaka South') {

            $tickets = Ticket::with(['ticketDetails'])->whereIn('sv_assigned_id', $adminIdSouth)->orderBy('id', 'desc')->paginate(20);

        } else {
            
            $tickets = Ticket::with(['ticketDetails'])->orderBy('id', 'desc')->paginate(20);
        }
        
        // $tickets = Ticket::with(['ticketDetails'])->orderBy('id', 'desc')->get();

        return view('ticket.index', compact('tickets'));
    }

    public function create()
    {
        if( (Auth::user()->role == 'ticket_admin') || (Auth::user()->role == 'agent') ) {

            
            $divisionList = Division::orderBy('name', 'asc')->pluck('name', 'id');
            $ticketTypeList = TicketType::pluck('name', 'id');
            $userList = User::where('role', '<>', 'agent')->pluck('name', 'id');
            $subjectList  = Option::where('select_id', 1)->where('status', 'Active')->pluck('name', 'name');
            $productModelList = Option::where('select_id', 2)->where('status', 'Active')->orderBy('name', 'asc')->pluck('name', 'name');
            // $areaAssignedList = Option::where('select_id', 3)->where('status', 'Active')->orderBy('name', 'asc')->pluck('name', 'name');
            // $areaAssigned = User::where('role', 'app_user')->orderBy('depot_app_user', 'asc')->pluck('depot_app_user', 'id')->toArray();
            $areaAssigned = User::whereIn('id', [15, 16])->orderBy('depot_app_user', 'asc')->pluck('depot_app_user', 'id')->toArray();
            $a2 = array("999" => "N/A");
            $areaAssignedList = $areaAssigned + $a2;
            
            $clientDiscountList = Option::where('select_id', 10)->where('status', 'Active')->orderBy('name', 'asc')->pluck('name', 'name');
            

            return view('ticket.create', compact('divisionList', 'ticketTypeList', 'userList', 'subjectList', 'productModelList', 'areaAssignedList', 'clientDiscountList'));
        } else {
            flash()->error('No permission to create Ticket');
            return redirect()->back();
        }

        
    }

    public function store(Request $request)
    {
        // return $request->all();

        // $appUser = User::find($request->sv_assigned_id);

        // if(isset($appUser)) {
        //     echo $appUser->phone_number;
        // } else {
        //     echo "nai";
        // }
        // exit();

        $input = Input::all();
    
        $rules = [
            'phone_number' => 'required|numeric|digits_between:11,11',
            'subject' => 'required',
            'customer_name' => 'required',
            'customer_address' => 'required',
            'sv_assigned_id' => 'required',
            'ticket_type_id' => 'required',
            'assigned_id' => 'required',
            'cc_to' => 'required',
            "product_name.*"  => "required|distinct",
            "product_qty.*"  => "required",
            "product_unit.*"  => "required",
            'remarks' => 'required',
            'total_price' => 'required|numeric',
            'delivery_time' => 'required',
            'discount' => 'required',
            'gift' => 'required',
            'payment_status' => 'required',
        ];
        $messages = [
            'phone_number.required' => 'The Phone Number field is required.',
            'subject.required' => 'The Subject field is required.',
            'customer_name.required' => 'The Customer Name field is required.',
            'customer_address.required' => 'The Customer Address field is required.',
            'sv_assigned_id.required' => 'The Area Assigned Person field is required.',
            'ticket_type_id.required' => 'The Ticket Type field is required.',
            'assigned_id.required' => 'The Assigned Person field is required.',
            'cc_to.required' => 'The CC To field is required.',
            'remarks.required' => 'The Remarks field is required.',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput(Input::except(['ticket_type_id', 'total_price']));
        }
        
        // return $request->all();

        $productCount = count($request->product_name);
        
        $productArray = [];
        for ($i=0; $i < $productCount; $i++) { 
            
            array_push($productArray, [
                'Name' => $request->product_name[$i],
                'Qty' => $request->product_qty[$i],
                'Unit' => $request->product_unit[$i]
            ]);
        }
        $productJSON = json_encode($productArray);

        $ticket = new Ticket;
        $ticket->phone_number = $request->phone_number;
        $ticket->subject = $request->subject;
        $ticket->customer_name = $request->customer_name;
        $ticket->division_id = $request->division_id;
        $ticket->district_id = $request->district_id;
        $ticket->customer_address = $request->customer_address;
        $ticket->sv_assigned_id = $request->sv_assigned_id;
        $ticket->ticket_status_id = 1;
        $ticket->ticket_type_id = $request->ticket_type_id;
        $ticket->assigned_id = $request->assigned_id;
        if ($request->cc_to == null) {
            $ticket->cc_to = $request->cc_to;
        } else {
            $strCcTo = implode(", ",$request->cc_to);
            //print_r (explode(", ",$strCcTo));
            $ticket->cc_to = $strCcTo;
        }
        
        // if ($request->product_model == null) {
        //     $ticket->product_model = $request->product_model;
        // } else {
        //     $strProductModel = implode(", ",$request->product_model);
        //     $ticket->product_model = $strProductModel;
        // }
        $ticket->remarks = $request->remarks;
        $ticket->client_discount = $request->client_discount;
        $ticket->product_price = $request->product_price;
        $ticket->total_price = $request->total_price;
        $ticket->product_detail = $productJSON;
        $ticket->delivery_time = $request->delivery_time;
        $ticket->discount = $request->discount;
        $ticket->gift = $request->gift;
        $ticket->payment_status = $request->payment_status;
        if ($request->ticket_type_id == 7) {
            $ticket->delivery_status = 'Order confirmed';
        }
        $ticket->created_by = Auth::id();
        $ticket->save();

        $ticketDetail = new TicketDetail;
        $ticketDetail->ticket_id = $ticket->id;
        $ticketDetail->ticket_status_id = 1;
        $ticketDetail->remarks = $request->remarks;
        $ticketDetail->app_user = $request->sv_assigned_id;
        $ticketDetail->created_by = Auth::id();
        $ticketDetail->save();

        //return "success";
        

        $ticketFind = Ticket::with(['assigned', 'ticketType', 'ticketStatus'])->find($ticket->id);

        if ($ticketFind->ticket_type_id == 7) {
            $user = "igloo";
            $pass = "95a?4A92";
            $sid = "iglooEng";

            $ticSmsID = $ticketFind->id;
            $encodedID = base64_encode($ticSmsID);

            $customerSMS = "Thank you for placing order. Your Order ID is " . $ticketFind->id . ", please call 16556 for further query or support. Online Payment Link: https://igloobd.com/pay/?i=".$encodedID;

            $adminSMS = "New order received. ID: " . $ticketFind->id . ", Name: " . $ticketFind->customer_name . ", Mob: " . $ticketFind->phone_number . ", Add:" . $ticketFind->customer_address . ". Please open App";

            $appUser = User::find($request->sv_assigned_id);

            // old
            // if(isset($appUser)) {
            //     $str = "sms[0][0]=".$ticketFind->phone_number."&sms[0][1]=".urlencode($customerSMS)."&sms[0][2]=123456789&sms[1][0]=01772040568&sms[1][1]=".urlencode($adminSMS)."&sms[1][2]=123456790&sms[2][0]=01812724128&sms[2][1]=".urlencode($adminSMS)."&sms[2][2]=123456790&sms[3][0]=".$appUser->phone_number."&sms[3][1]=".urlencode($adminSMS)."&sms[3][2]=123456790";
            // } else {
            //     $str = "sms[0][0]=".$ticketFind->phone_number."&sms[0][1]=".urlencode($customerSMS)."&sms[0][2]=123456789&sms[1][0]=01772040568&sms[1][1]=".urlencode($adminSMS)."&sms[1][2]=123456790&sms[2][0]=01812724128&sms[2][1]=".urlencode($adminSMS)."&sms[2][2]=123456790";
            // }      

            // old
            // $url="http://sms.sslwireless.com/pushapi/dynamic/server.php";
            // $param="user=$user&pass=$pass&".$str."&sid=$sid";
            // $crl = curl_init();
            // curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE);
            // curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2);
            // curl_setopt($crl,CURLOPT_URL,$url);
            // curl_setopt($crl,CURLOPT_HEADER,0);
            // curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
            // curl_setopt($crl,CURLOPT_POST,1);
            // curl_setopt($crl,CURLOPT_POSTFIELDS,$param);
            // $response = curl_exec($crl);
            // curl_close($crl);
            // echo $response;

            // me
            // $curl = curl_init();
            // curl_setopt($curl, CURLOPT_URL, "https://smsplus.sslwireless.com/api/v3/send-sms?api_token=3768cecd-b47d-4358tkn-9e64-395288340fa9&sid=IGLOO&sms=".urlencode($customerSMS)."&msisdn=01873051953&csms_id=123456789");
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // $output = curl_exec($curl);
            // curl_close($curl);

            // customer SMS
            $curlCus = curl_init();
            curl_setopt($curlCus, CURLOPT_URL, "https://smsplus.sslwireless.com/api/v3/send-sms?api_token=3768cecd-b47d-4358tkn-9e64-395288340fa9&sid=IGLOO&sms=".urlencode($customerSMS)."&msisdn=".$ticketFind->phone_number."&csms_id=123456789");
            curl_setopt($curlCus, CURLOPT_RETURNTRANSFER, 1);
            $outputCus = curl_exec($curlCus);
            curl_close($curlCus);


            if(isset($appUser)) {
                // zone admin SMS
                $curlZone = curl_init();
                curl_setopt($curlZone, CURLOPT_URL, "https://smsplus.sslwireless.com/api/v3/send-sms?api_token=3768cecd-b47d-4358tkn-9e64-395288340fa9&sid=IGLOO&sms=".urlencode($adminSMS)."&msisdn=".$appUser->phone_number."&csms_id=012345678");
                curl_setopt($curlZone, CURLOPT_RETURNTRANSFER, 1);
                $outputZone = curl_exec($curlZone);
                curl_close($curlZone);
            }
        }
        


        $mailUser = User::find($request->assigned_id);
        $ccUsers = User::whereIn('id', $request->cc_to)->get();
        //$ccUsers = User::whereIn('id', [13])->get();

        $mail = new PHPMailer(true);                             
        try {
                                       
            $mail->isSMTP();                                      
            $mail->Host = 'mail.myolbd.com';  
            $mail->SMTPAuth = true;                               
            $mail->Username = 'igloo@myolbd.com';                 
            $mail->Password = 'IG_MY990';                          
            $mail->SMTPSecure = 'tls';                            
            $mail->Port = 2525;  

            
            $mail->setFrom('igloo@myolbd.com', 'igloo@myolbd.com');
            
            $mail->addAddress($mailUser->email, $mailUser->name);
            

            $mail->addReplyTo('igloo@myolbd.com', 'igloo@myolbd.com');
            
            foreach($ccUsers as $ccUser)
            {
               $mail->addCC($ccUser->email, $ccUser->name);
            }

           
            $mail->isHTML(true);                                 
            $mail->Subject = 'Ticket_' . $ticketFind->id . '_' . $ticketFind->ticketType->name . '_' . $ticketFind->subject;
            $mail->Body    = '<html>
                                <head>
                                <style>
                                table, th, td {
                                    border: 1px solid black;
                                    border-collapse: collapse;
                                }
                                th, td {
                                    padding: 5px;
                                }
                                </style>
                                </head>
                                <body>
                                <h2>Solve This Ticket</h2>
                                <table>
                                  <tr>
                                    <td>Type</td>
                                    <td><b>'.$ticketFind->ticketType->name.'</b></td>
                                    <td>Status</td>
                                    <td><b>'.$ticketFind->ticketStatus->name.'</b></td>
                                  </tr>
                                  <tr>
                                    <td>PIC</td>
                                    <td><b>'.$ticketFind->assigned->name.'</b></td>
                                    <td>Customer Name</td>
                                    <td><b>'.$ticketFind->customer_name.'</b></td>
                                  </tr>
                                  <tr>
                                    <td>Phone No</td>
                                    <td><b>'.$ticketFind->phone_number.'</b></td>
                                    <td>Address</td>
                                    <td><b>'.$ticketFind->customer_address.'</b></td>
                                  </tr>
                                  
                                  <tr>
                                    <td>Product Detail</td>
                                    <td><b>'.$ticketFind->product_detail.'</b></td>
                                    <td>Area Assigned</td>
                                    <td><b>'.$ticketFind->delivery_time.'</b></td>
                                  </tr>

                                  <tr>
                                    <td>Product Price</td>
                                    <td><b>'.$ticketFind->product_price.'</b></td>
                                    <td>Corporate Client & Discount</td>
                                    <td><b>'.$ticketFind->client_discount.'</b></td>
                                  </tr>
                                  
                                  <tr>
                                    <td>Remarks</td>
                                    <td colspan="4"><b>'.$ticketFind->remarks.'</b></td>
                                  </tr>
                                </table>
                                </body>
                                </html>';
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }


        flash()->success('Ticket ID '.$ticket->id.' created successfully');
        return redirect('ticket');
    }

    public function getDistrict(Request $request)
    {   
        $districts = District::where('division_id', $request->division_id)->pluck('name', 'id');

        return response()->json($districts);
    }

    public function getAssigned(Request $request)
    {   
        $ticketType = $request->ticket_type_id;
        if ($ticketType == 1) {
            $user = User::find(2);
        } else if ($ticketType == 2) {
            $user = User::find(2);
        } else if ($ticketType == 3) {
            $user = User::find(2);
        } else if ($ticketType == 4) {
            $user = User::find(2);
        } else if ($ticketType == 5) {
            $user = User::find(3);
        } else if ($ticketType == 6) {
            $user = User::find(2);
        } else if ($ticketType == 7) {
            $user = User::find(3);
        } else if ($ticketType == 8) {
            $user = User::find(4);
        } else if ($ticketType == 9) {
            $user = User::find(3);
        } else {
            $user  = null;  
        }
        

        return response()->json($user);
    }


    public function getCC(Request $request)
    {   
        // $ticketType = 1;
        $ticketType = $request->ticket_type_id;
        
        
        if ($ticketType == 1) {
            // $ccUserList = User::whereIn('id',[1])->pluck('name', 'id');
            $ccUserList = User::whereIn('id',[3, 5, 6, 1])->pluck('name', 'id');
            
        } else if ($ticketType == 2) {
            $ccUserList = User::whereIn('id',[3, 5, 6, 1])->pluck('name', 'id');
            
        } else if ($ticketType == 3) {
            $ccUserList = User::whereIn('id',[3, 5, 6, 1])->pluck('name', 'id');
            
        } else if ($ticketType == 4) {
            $ccUserList = User::whereIn('id',[3, 5, 6, 1])->pluck('name', 'id');
            
        } else if ($ticketType == 5) {
            $ccUserList = User::whereIn('id',[2, 5, 6, 1])->pluck('name', 'id');
            
        } else if ($ticketType == 6) {
            $ccUserList = User::whereIn('id',[3, 5, 6, 1])->pluck('name', 'id');
            
        } else if ($ticketType == 7) {
            $ccUserList = User::whereIn('id',[6, 1])->pluck('name', 'id');
            
        } else if ($ticketType == 8) {
            $ccUserList = User::whereIn('id',[3, 5, 6, 1])->pluck('name', 'id');
            
        } else if ($ticketType == 9) {
            $ccUserList = User::whereIn('id',[2, 5, 6, 1])->pluck('name', 'id');
            
        } else {
            $ccUserList  = [];
            
        }
        
        return response()->json($ccUserList);
    }





     public function edit($id)
    {
        $ticket = Ticket::find($id);
        if ( ($ticket->ticket_status_id == 3) || ($ticket->ticket_status_id == 5) ) {
            flash()->error('The Ticket has been CLOSED or CANCELLED!');
            return redirect()->back();
        }
        if( (Auth::user()->role == 'ticket_admin') || (Auth::user()->role == 'agent') ) {
            $ticketStatusList = TicketStatus::whereNotIn('id', [1, 6])->pluck('name', 'id');
        } else {
            $ticketStatusList = TicketStatus::whereNotIn('id', [1, 3, 5, 6])->pluck('name', 'id');
        }
        // $ticketStatusList = TicketStatus::whereNotIn('id', [1])->pluck('name', 'id');
        
        return view('ticket.edit', compact('ticket', 'ticketStatusList'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $input = Input::all();
        $rules = [
            'ticket_status_id' => 'required',
            'remarks_update' => 'required'
        ];
        $messages = [
            'ticket_status_id.required' => 'The Ticket Status field is required.',
            'remarks_update.required' => 'The Remarks field is required.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $ticket->ticket_status_id = $request->ticket_status_id;
        if ( ($request->ticket_status_id == 5) && ($ticket->ticket_type_id == 7) ) {
            $ticket->delivery_status = 'Order cancelled';
        }
        $ticket->remarks = $request->remarks_update;
        $ticket->updated_by = Auth::id();
        $ticket->save();

        $ticketDetail = new TicketDetail;
        $ticketDetail->ticket_id = $ticket->id;
        $ticketDetail->ticket_status_id = $request->ticket_status_id;
        $ticketDetail->remarks = $request->remarks_update;
        $ticketDetail->created_by = Auth::id();
        $ticketDetail->save();

        
        flash()->success('Ticket ID '.$ticket->id.' updated successfully');
        return redirect('/ticket');
    }

    public function show($id)
    {
        $ticket = Ticket::with(['assigned', 'ticketType', 'ticketStatus'])->find($id);
        return view('ticket.show', compact('ticket'));
    }

    public function getProduct(Request $request)
    {
        
        $products = Option::where('select_id', 2)->where('status', 'Active')->orderBy('name', 'asc')->pluck('name', 'name');

        return response()->json($products);

    }
}
