<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\TicketStatus;
use App\Models\Option;
use App\Models\AppUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCount = User::whereNotIn('id', [10, 11])->whereNotIn('role', ['app_admin', 'app_user'])->count();
        $ticketCount = Ticket::count();
        $ticketTypeCount = TicketType::count();
        $ticketType1CountMar = Ticket::where('ticket_type_id', 1)->count();
        $ticketType2CountRet = Ticket::where('ticket_type_id', 2)->count();
        $ticketType3CountDis = Ticket::where('ticket_type_id', 3)->count();
        $ticketType4CountProQua = Ticket::where('ticket_type_id', 4)->count();
        $ticketType5CountTrans = Ticket::where('ticket_type_id', 5)->count();
        $ticketType6CountDisShip = Ticket::where('ticket_type_id', 6)->count();
        $ticketType7CountOrder = Ticket::where('ticket_type_id', 7)->count();
        $ticketType8CountSpon = Ticket::where('ticket_type_id', 8)->count();
        $ticketType9CountOrderRe = Ticket::where('ticket_type_id', 9)->count();
        $ticketStatusCount = TicketStatus::count();
        $ticketStatus1CountNew = Ticket::where('ticket_status_id', 1)->count();
        $ticketStatus2CountFG = Ticket::where('ticket_status_id', 2)->count();
        $ticketStatus3CountClosed = Ticket::where('ticket_status_id', 3)->count();
        $ticketStatus4CountDP = Ticket::where('ticket_status_id', 4)->count();
        $ticketStatus5CountCancelled = Ticket::where('ticket_status_id', 5)->count();
        $area = Option::where('select_id', 3)->count();
        $appUserCount = User::whereIn('role', ['app_admin', 'app_user'])->count();

        //return view('home');

        //return view('home', compact('userCount', 'ticketTypeCount', 'ticketCount', 'ticketStatusCount', 'ticketType1CountLog', 'ticketType2CountSal', 'ticketType3CountAC', 'ticketType4CountEle', 'ticketType5CountApp', 'ticketType6CountSB', 'ticketType7CountMYOL', 'ticketStatusAnsweredCount', 'ticketStatusPendingCount', 'ticketStatusClosedCount', 'ticketInvoiceCallCount', 'ticketServiceCallCount'));
        return view('home', compact('userCount', 'ticketTypeCount', 'ticketCount', 'ticketStatusCount', 'ticketType1CountMar', 'ticketType2CountRet', 'ticketType3CountDis', 'ticketType4CountProQua', 'ticketType5CountTrans', 'ticketType6CountDisShip', 'ticketType7CountOrder', 'ticketType8CountSpon', 'ticketType9CountOrderRe', 'area', 'ticketStatus1CountNew', 'ticketStatus2CountFG', 'ticketStatus3CountClosed', 'ticketStatus4CountDP', 'ticketStatus5CountCancelled', 'appUserCount'));
    
    }
}
