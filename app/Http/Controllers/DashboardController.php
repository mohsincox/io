<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function dsDashboard()
    {
        if (isset(Auth::user()->zone)) {
        $zone = Auth::user()->zone;
        if ($zone == 'Dhaka North') {

            return redirect('north-dashboard');
        } else if ($zone == 'Dhaka South') {

            return redirect('south-dashboard');
        }

        }

    	$totalToday = Ticket::whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->count();

    	$total09 = Ticket::whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
    	$total10 = Ticket::whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
    	$total11 = Ticket::whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
    	$total12 = Ticket::whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
    	$total13 = Ticket::whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
    	$total14 = Ticket::whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
    	$total15 = Ticket::whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
    	$total16 = Ticket::whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
    	$total17 = Ticket::whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
    	$total18 = Ticket::whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
    	$total19 = Ticket::whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
    	$total20 = Ticket::whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

    	$hourWiseArrTotal = [$total09, $total10, $total11, $total12, $total13, $total14, $total15, $total16, $total17, $total18, $total19, $total20];

    	$pending09 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
    	$pending10 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
    	$pending11 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
    	$pending12 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
    	$pending13 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
    	$pending14 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
    	$pending15 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
    	$pending16 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
    	$pending17 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
    	$pending18 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
    	$pending19 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
    	$pending20 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

    	$hourWiseArrPending = [$pending09, $pending10, $pending11, $pending12, $pending13, $pending14, $pending15, $pending16, $pending17, $pending18, $pending19, $pending20];
        
        $completed09 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
    	$completed10 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
    	$completed11 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
    	$completed12 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
    	$completed13 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
    	$completed14 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
    	$completed15 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
    	$completed16 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
    	$completed17 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
    	$completed18 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
    	$completed19 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
    	$completed20 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

    	$hourWiseArrCompleted = [$completed09, $completed10, $completed11, $completed12, $completed13, $completed14, $completed15, $completed16, $completed17, $completed18, $completed19, $completed20];

    	return view('dashboard.delivery_status', compact('totalToday', 'hourWiseArrTotal', 'hourWiseArrPending', 'hourWiseArrCompleted'));
    }

    public function northDashboard()
    {
        $totalToday = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->count();

        $total09 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $total10 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $total11 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $total12 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $total13 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $total14 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $total15 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $total16 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $total17 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $total18 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $total19 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $total20 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrTotal = [$total09, $total10, $total11, $total12, $total13, $total14, $total15, $total16, $total17, $total18, $total19, $total20];

        $pending09 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $pending10 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $pending11 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $pending12 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $pending13 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $pending14 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $pending15 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $pending16 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $pending17 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $pending18 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $pending19 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $pending20 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrPending = [$pending09, $pending10, $pending11, $pending12, $pending13, $pending14, $pending15, $pending16, $pending17, $pending18, $pending19, $pending20];
        
        $completed09 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $completed10 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $completed11 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $completed12 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $completed13 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $completed14 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $completed15 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $completed16 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $completed17 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $completed18 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $completed19 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $completed20 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrCompleted = [$completed09, $completed10, $completed11, $completed12, $completed13, $completed14, $completed15, $completed16, $completed17, $completed18, $completed19, $completed20];

        return view('dashboard.north_dashboard', compact('totalToday', 'hourWiseArrTotal', 'hourWiseArrPending', 'hourWiseArrCompleted'));
    }

    public function southDashboard()
    {
        $totalToday = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->count();

        $total09 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $total10 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $total11 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $total12 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $total13 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $total14 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $total15 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $total16 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $total17 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $total18 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $total19 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $total20 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrTotal = [$total09, $total10, $total11, $total12, $total13, $total14, $total15, $total16, $total17, $total18, $total19, $total20];

        $pending09 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $pending10 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $pending11 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $pending12 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $pending13 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $pending14 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $pending15 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $pending16 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $pending17 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $pending18 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $pending19 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $pending20 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrPending = [$pending09, $pending10, $pending11, $pending12, $pending13, $pending14, $pending15, $pending16, $pending17, $pending18, $pending19, $pending20];
        
        $completed09 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $completed10 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $completed11 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $completed12 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $completed13 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $completed14 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $completed15 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $completed16 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $completed17 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $completed18 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $completed19 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $completed20 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrCompleted = [$completed09, $completed10, $completed11, $completed12, $completed13, $completed14, $completed15, $completed16, $completed17, $completed18, $completed19, $completed20];

        return view('dashboard.south_dashboard', compact('totalToday', 'hourWiseArrTotal', 'hourWiseArrPending', 'hourWiseArrCompleted'));
    }

    public function dsDashboardOld()
    {
        if (isset(Auth::user()->zone)) {
            $zone = Auth::user()->zone;
        
            if ($zone == 'Dhaka North') {

                return redirect('north-dashboard');
            } else if ($zone == 'Dhaka South') {

                return redirect('south-dashboard');
            }
        }

        $totalToday = Ticket::whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->count();
        $totalTodayNorth = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->count();
        $totalTodaySouth = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->count();

        $total09 = Ticket::whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $total10 = Ticket::whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $total11 = Ticket::whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $total12 = Ticket::whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $total13 = Ticket::whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $total14 = Ticket::whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $total15 = Ticket::whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $total16 = Ticket::whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $total17 = Ticket::whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $total18 = Ticket::whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $total19 = Ticket::whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $total20 = Ticket::whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrTotal = [$total09, $total10, $total11, $total12, $total13, $total14, $total15, $total16, $total17, $total18, $total19, $total20];

        $confirmed09 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $confirmed10 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $confirmed11 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $confirmed12 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $confirmed13 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $confirmed14 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $confirmed15 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $confirmed16 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $confirmed17 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $confirmed18 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $confirmed19 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $confirmed20 = Ticket::where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrConfirmed = [$confirmed09, $confirmed10, $confirmed11, $confirmed12, $confirmed13, $confirmed14, $confirmed15, $confirmed16, $confirmed17, $confirmed18, $confirmed19, $confirmed20];

        $depot09 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $depot10 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $depot11 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $depot12 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $depot13 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $depot14 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $depot15 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $depot16 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $depot17 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $depot18 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $depot19 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $depot20 = Ticket::where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrDepot = [$depot09, $depot10, $depot11, $depot12, $depot13, $depot14, $depot15, $depot16, $depot17, $depot18, $depot19, $depot20];


        $deliver09 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $deliver10 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $deliver11 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $deliver12 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $deliver13 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $deliver14 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $deliver15 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $deliver16 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $deliver17 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $deliver18 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $deliver19 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $deliver20 = Ticket::where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrDeliver = [$deliver09, $deliver10, $deliver11, $deliver12, $deliver13, $deliver14, $deliver15, $deliver16, $deliver17, $deliver18, $deliver19, $deliver20];

        $cancelled09 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $cancelled10 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $cancelled11 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $cancelled12 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $cancelled13 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $cancelled14 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $cancelled15 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $cancelled16 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $cancelled17 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $cancelled18 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $cancelled19 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $cancelled20 = Ticket::where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrCancelled = [$cancelled09, $cancelled10, $cancelled11, $cancelled12, $cancelled13, $cancelled14, $cancelled15, $cancelled16, $cancelled17, $cancelled18, $cancelled19, $cancelled20];


        // $pending09 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        // $pending10 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        // $pending11 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        // $pending12 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        // $pending13 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        // $pending14 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        // $pending15 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        // $pending16 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        // $pending17 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        // $pending18 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        // $pending19 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        // $pending20 = Ticket::whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        // $hourWiseArrPending = [$pending09, $pending10, $pending11, $pending12, $pending13, $pending14, $pending15, $pending16, $pending17, $pending18, $pending19, $pending20];


        
        $completed09 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $completed10 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $completed11 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $completed12 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $completed13 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $completed14 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $completed15 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $completed16 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $completed17 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $completed18 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $completed19 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $completed20 = Ticket::whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrCompleted = [$completed09, $completed10, $completed11, $completed12, $completed13, $completed14, $completed15, $completed16, $completed17, $completed18, $completed19, $completed20];

        return view('dashboard.delivery_status_new', compact('totalToday', 'totalTodayNorth', 'totalTodaySouth', 'hourWiseArrTotal', 'hourWiseArrConfirmed', 'hourWiseArrDepot', 'hourWiseArrDeliver', 'hourWiseArrCancelled', 'hourWiseArrCompleted'));
    }



    public function northDashboardOld()
    {
        // return $totalToday = Ticket::groupBy('delivery_status')->select('delivery_status', DB::raw('count(*) as statusCount'))->whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->get();


        // $totalToday = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->count();

        // $total09 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        // $total10 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        // $total11 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        // $total12 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        // $total13 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        // $total14 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        // $total15 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        // $total16 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        // $total17 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        // $total18 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        // $total19 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        // $total20 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        // $hourWiseArrTotal = [$total09, $total10, $total11, $total12, $total13, $total14, $total15, $total16, $total17, $total18, $total19, $total20];

        // $pending09 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        // $pending10 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        // $pending11 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        // $pending12 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        // $pending13 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        // $pending14 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        // $pending15 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        // $pending16 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        // $pending17 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        // $pending18 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        // $pending19 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        // $pending20 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order Confirmed', 'Order collected from depot', 'On the way for order deliver'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        // $hourWiseArrPending = [$pending09, $pending10, $pending11, $pending12, $pending13, $pending14, $pending15, $pending16, $pending17, $pending18, $pending19, $pending20];
        
        // $completed09 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        // $completed10 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        // $completed11 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        // $completed12 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        // $completed13 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        // $completed14 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        // $completed15 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        // $completed16 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        // $completed17 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        // $completed18 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        // $completed19 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        // $completed20 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        // $hourWiseArrCompleted = [$completed09, $completed10, $completed11, $completed12, $completed13, $completed14, $completed15, $completed16, $completed17, $completed18, $completed19, $completed20];

        // return view('dashboard.north_dashboard', compact('totalToday', 'hourWiseArrTotal', 'hourWiseArrPending', 'hourWiseArrCompleted'));


        $totalToday = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->count();

        $total09 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $total10 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $total11 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $total12 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $total13 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $total14 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $total15 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $total16 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $total17 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $total18 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $total19 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $total20 = Ticket::whereIn('sv_assigned_id', [15])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrTotal = [$total09, $total10, $total11, $total12, $total13, $total14, $total15, $total16, $total17, $total18, $total19, $total20];

        $confirmed09 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $confirmed10 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $confirmed11 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $confirmed12 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $confirmed13 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $confirmed14 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $confirmed15 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $confirmed16 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $confirmed17 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $confirmed18 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $confirmed19 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $confirmed20 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrConfirmed = [$confirmed09, $confirmed10, $confirmed11, $confirmed12, $confirmed13, $confirmed14, $confirmed15, $confirmed16, $confirmed17, $confirmed18, $confirmed19, $confirmed20];

        $depot09 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $depot10 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $depot11 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $depot12 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $depot13 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $depot14 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $depot15 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $depot16 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $depot17 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $depot18 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $depot19 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $depot20 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrDepot = [$depot09, $depot10, $depot11, $depot12, $depot13, $depot14, $depot15, $depot16, $depot17, $depot18, $depot19, $depot20];


        $deliver09 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $deliver10 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $deliver11 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $deliver12 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $deliver13 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $deliver14 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $deliver15 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $deliver16 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $deliver17 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $deliver18 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $deliver19 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $deliver20 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrDeliver = [$deliver09, $deliver10, $deliver11, $deliver12, $deliver13, $deliver14, $deliver15, $deliver16, $deliver17, $deliver18, $deliver19, $deliver20];

        $cancelled09 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $cancelled10 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $cancelled11 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $cancelled12 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $cancelled13 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $cancelled14 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $cancelled15 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $cancelled16 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $cancelled17 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $cancelled18 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $cancelled19 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $cancelled20 = Ticket::whereIn('sv_assigned_id', [15])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrCancelled = [$cancelled09, $cancelled10, $cancelled11, $cancelled12, $cancelled13, $cancelled14, $cancelled15, $cancelled16, $cancelled17, $cancelled18, $cancelled19, $cancelled20];

        
        $completed09 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $completed10 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $completed11 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $completed12 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $completed13 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $completed14 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $completed15 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $completed16 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $completed17 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $completed18 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $completed19 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $completed20 = Ticket::whereIn('sv_assigned_id', [15])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrCompleted = [$completed09, $completed10, $completed11, $completed12, $completed13, $completed14, $completed15, $completed16, $completed17, $completed18, $completed19, $completed20];

        return view('dashboard.north_dashboard_new', compact('totalToday', 'hourWiseArrTotal', 'hourWiseArrConfirmed', 'hourWiseArrDepot', 'hourWiseArrDeliver', 'hourWiseArrCancelled', 'hourWiseArrCompleted'));

    }

    public function southDashboardOld()
    {

        $totalToday = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])->count();

        $total09 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $total10 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $total11 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $total12 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $total13 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $total14 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $total15 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $total16 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $total17 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $total18 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $total19 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $total20 = Ticket::whereIn('sv_assigned_id', [16])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrTotal = [$total09, $total10, $total11, $total12, $total13, $total14, $total15, $total16, $total17, $total18, $total19, $total20];

        $confirmed09 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $confirmed10 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $confirmed11 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $confirmed12 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $confirmed13 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $confirmed14 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $confirmed15 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $confirmed16 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $confirmed17 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $confirmed18 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $confirmed19 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $confirmed20 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order confirmed')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrConfirmed = [$confirmed09, $confirmed10, $confirmed11, $confirmed12, $confirmed13, $confirmed14, $confirmed15, $confirmed16, $confirmed17, $confirmed18, $confirmed19, $confirmed20];

        $depot09 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $depot10 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $depot11 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $depot12 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $depot13 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $depot14 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $depot15 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $depot16 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $depot17 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $depot18 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $depot19 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $depot20 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order collected from depot')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrDepot = [$depot09, $depot10, $depot11, $depot12, $depot13, $depot14, $depot15, $depot16, $depot17, $depot18, $depot19, $depot20];


        $deliver09 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $deliver10 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $deliver11 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $deliver12 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $deliver13 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $deliver14 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $deliver15 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $deliver16 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $deliver17 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $deliver18 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $deliver19 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $deliver20 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'On the way for order deliver')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrDeliver = [$deliver09, $deliver10, $deliver11, $deliver12, $deliver13, $deliver14, $deliver15, $deliver16, $deliver17, $deliver18, $deliver19, $deliver20];

        $cancelled09 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $cancelled10 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $cancelled11 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $cancelled12 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $cancelled13 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $cancelled14 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $cancelled15 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $cancelled16 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $cancelled17 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $cancelled18 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $cancelled19 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $cancelled20 = Ticket::whereIn('sv_assigned_id', [16])->where('delivery_status', 'Order cancelled')->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrCancelled = [$cancelled09, $cancelled10, $cancelled11, $cancelled12, $cancelled13, $cancelled14, $cancelled15, $cancelled16, $cancelled17, $cancelled18, $cancelled19, $cancelled20];

        
        $completed09 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 09:00:00"), date("Y-m-d 09:59:59")])->count();
        $completed10 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 10:00:00"), date("Y-m-d 10:59:59")])->count();
        $completed11 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 11:00:00"), date("Y-m-d 11:59:59")])->count();
        $completed12 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 12:00:00"), date("Y-m-d 12:59:59")])->count();
        $completed13 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 13:00:00"), date("Y-m-d 13:59:59")])->count();
        $completed14 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 14:00:00"), date("Y-m-d 14:59:59")])->count();
        $completed15 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 15:00:00"), date("Y-m-d 15:59:59")])->count();
        $completed16 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 16:00:00"), date("Y-m-d 16:59:59")])->count();
        $completed17 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 17:00:00"), date("Y-m-d 17:59:59")])->count();
        $completed18 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 18:00:00"), date("Y-m-d 18:59:59")])->count();
        $completed19 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 19:00:00"), date("Y-m-d 19:59:59")])->count();
        $completed20 = Ticket::whereIn('sv_assigned_id', [16])->whereIn('delivery_status', ['Order delivered (cash payment)', 'Order delivered (card payment)'])->whereBetween('created_at', [date("Y-m-d 20:00:00"), date("Y-m-d 20:59:59")])->count();

        $hourWiseArrCompleted = [$completed09, $completed10, $completed11, $completed12, $completed13, $completed14, $completed15, $completed16, $completed17, $completed18, $completed19, $completed20];

        return view('dashboard.south_dashboard_new', compact('totalToday', 'hourWiseArrTotal', 'hourWiseArrConfirmed', 'hourWiseArrDepot', 'hourWiseArrDeliver', 'hourWiseArrCancelled', 'hourWiseArrCompleted'));

    }

}
