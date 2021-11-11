<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Config;
use App\Models\Ticket;

class ApiController extends Controller
{
    public function getTicketInfo(Request $request)
    {
        $ADMIN_LOGIN = Config::get('constants.ADMIN_LOGIN');
        $ADMIN_PASSWORD = Config::get('constants.ADMIN_PASSWORD');
        
        // define('ADMIN_LOGIN','tel.bd.com'); 
        // define('ADMIN_PASSWORD','TxL=890'); // Could be hashed too.

        // For Igloo
        // Key: Authorization
        // Value: Basic SWdsb29JY2VDcmVhbTpteW9sYmRhbWxiZA==
          
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != $ADMIN_LOGIN) || ($_SERVER['PHP_AUTH_PW'] != $ADMIN_PASSWORD)) { 
            header('HTTP/1.1 401 Unauthorized'); 
            header('WWW-Authenticate: Basic realm="Password For Blog"'); 
            exit("Access Denied: Username and password required."); 
        } else {
            $ticketID = $request->ticketID; 
            
            $ticket = Ticket::with(['assigned', 'ticketType','ticketStatus'])->find($ticketID);
    
            $data = null;
            
            if (isset($ticket)) {
                $ticketInfo = [
                    'ticketID' => $ticket->id,
                    'subject' => $ticket->subject,
                    'assignedPerson' => $ticket->assigned->name,
                    'ticketType' => $ticket->ticketType->name,
                    'ticketStatus' => $ticket->ticketStatus->name,
                    'customerNumber' => $ticket->phone_number,
                    'customerName' => $ticket->customer_name,
                    'customerAddress' => $ticket->customer_address,
                    'product' => $ticket->product_detail,
                    'price' => $ticket->total_price,
                    'areaAssigned' => $ticket->area_assigned,
                    'createdAt' => $ticket->created_at->toDateTimeString(),
                    'createdBy' => $ticket->createdBy->name
                ];

                $data = $ticketInfo;

                // for_Array

                // $data = [
                //  'ticketInfo' => $ticketInfo
                // ];

            } else {

                $data = 'Ticket ID does not exist';
            }

            return json_encode($data);
        }
    }
}
