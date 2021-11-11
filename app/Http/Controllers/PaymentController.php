<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Ticket;
use App\Models\TicketDetail;

class PaymentController extends Controller
{
	public function payment(Request $request)
	{
		if (isset($request->ticketID)) {
			$ticketID = $request->ticketID;
			// echo "<br>";
			// echo $ticketID = base64_decode($request->ticketID);
			// exit();
			$ticket = Ticket::find($ticketID);

			if (isset($ticket)) {
				// $paymentCount = TicketDetail::where('ticket_id', $ticketID)->where('ticket_status_id', 6)->count();

				// if ($paymentCount < 1) {
					
        			$ticket->online_payment = 'Yes';
        			$ticket->save();

					$ticketDetail = new TicketDetail;
				    $ticketDetail->ticket_id = $ticketID;
				    $ticketDetail->ticket_status_id = 6;
				    $ticketDetail->remarks = 'Online Payment done by Card.';
				    $ticketDetail->save();

				    return response()->json([
						"code" => 200,
						"message" => "Request inserted successfully"
					]);
				// }
			}
		} 

	}
    
}
