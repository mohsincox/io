<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Option;
use App\Models\Division;
use App\Models\District;
use App\Models\Crm;

class CrmController extends Controller
{
    public function create(Request $request)
    {
        
        $productModelList  = Option::where('select_id', 2)->where('status', 'Active')->orderBy('name', 'asc')->pluck('name', 'name');
        $areaAssignedList  = Option::where('select_id', 3)->where('status', 'Active')->orderBy('name', 'asc')->pluck('name', 'name');
        $genderList  = Option::where('select_id', 4)->where('status', 'Active')->pluck('name', 'name');
        $professionList  = Option::where('select_id', 5)->where('status', 'Active')->pluck('name', 'name');
        $typeOfCustomerList  = Option::where('select_id', 6)->where('status', 'Active')->pluck('name', 'name');
        $queryTypeList  = Option::where('select_id', 7)->where('status', 'Active')->pluck('name', 'name');
        $yesNoList  = Option::where('select_id', 8)->where('status', 'Active')->pluck('name', 'name');
        $callRemarksList  = Option::where('select_id', 9)->where('status', 'Active')->pluck('name', 'name');
        $clientDiscountList  = Option::where('select_id', 10)->where('status', 'Active')->pluck('name', 'name');
        // $divisionList = Division::orderBy('name', 'asc')->pluck('name', 'id');
        $districtList = District::orderBy('name', 'asc')->pluck('name', 'id');
        $phone_number = substr($request->phone_number, -11);
        $phoneNumber = $phone_number;
        $agent = $request->agent;

        $crmLast = Crm::whereIn('phone_number', [substr($request->phone_number, -11), substr($request->phone_number, -10)])->orderBy('id', 'desc')->first();

        return view('crm.create', compact('productModelList', 'areaAssignedList', 'genderList', 'professionList', 'typeOfCustomerList', 'queryTypeList', 'yesNoList', 'callRemarksList', 'clientDiscountList', 'districtList', 'phoneNumber', 'agent', 'crmLast'));
    }

    public function getDistrict(Request $request)
    {   
        $districts = District::where('division_id', $request->division_id)->pluck('name', 'id');

        return response()->json($districts);
    }

    public function store(Request $request)
    {
        $crm = new Crm;
        $crm->phone_number = $request->phone_number;
        $crm->agent = $request->agent;
        $crm->customer_name = $request->customer_name;
        
        $crm->district_id = $request->district_id;
        $crm->customer_address = $request->customer_address;
        $crm->customer_area = $request->customer_area;
        $crm->customer_email = $request->customer_email;
        // $crm->product_model = $request->product_model;
        if ($request->product_model == null) {
            $crm->product_model = $request->product_model;
        } else {
            $strProductModel = implode(", ",$request->product_model);
            $crm->product_model = $strProductModel;
        }
        $crm->gender = $request->gender;
        $crm->profession = $request->profession;
        if ($request->date_of_birth == null) {
            $crm->date_of_birth = null;
        } else {
            $crm->date_of_birth = $request->date_of_birth;
        }
        if ($request->marriage_day == null) {
            $crm->marriage_day = null;
        } else {
            $crm->marriage_day = $request->marriage_day;
        }
        $crm->type_of_customer = $request->type_of_customer;
        $crm->area_assigned = $request->area_assigned;
        
        
        $crm->query_type = $request->query_type;
        $crm->customer_order = $request->customer_order;
        $crm->create_ticket = $request->create_ticket;
        $crm->remarks = $request->remarks;
        $crm->call_remarks = $request->call_remarks;
        $crm->camp_in_or_out = $request->in_or_out;
        $crm->client_discount = $request->client_discount;
        $crm->product_price = $request->product_price_blank;
        
        $crm->save(); 

        flash()->success($request->phone_number.' information created successfully');
        
        return redirect()->back();
    }
}
