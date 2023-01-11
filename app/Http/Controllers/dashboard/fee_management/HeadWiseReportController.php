<?php

namespace App\Http\Controllers\dashboard\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\Payapply;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HeadWiseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.fee_management.report.head.index',compact(
            'users',
            'startups'
        ));
    }

    public function search(Request $request)
    {
        $users = User::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $from = $request->from;
        $to = $request->to;
        $startDate = Carbon::createFromFormat('Y-m-d', $request->from);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->to);
        
        if($request->class == 'cls')
        {
            $payapplies = Payapply::where('institute_id', Auth::user()->institute_id)
                            ->where('academic_year_id', $request->academic_year_id)
                            ->whereBetween('updated_at',[$startDate, $endDate])
                            // ->where('updated_at', '>=', $startDate)
                            // ->where('updated_at', '<=', $endDate)
                            ->get();
            foreach($payapplies as $payapplie)
            {
                $qc_data = [];
                $data = "";
                $total_amount = 0;

                if($payapplie->payment_state == 200 || $payapplie->payment_state == 10)
                {
                    $data = DB::table('payapplies')
                                ->where('institute_id', Auth::user()->institute_id)
                                ->where('academic_year_id', $request->academic_year_id)
                                ->select([DB::raw("SUM(total_amount) as total"),'class_id', 'feehead_id'])
                                ->groupBy(['class_id', 'feehead_id'])
                                ->get();
                }
                
                elseif($payapplie->payment_state == 11)
                {
                    
                    $qc_infos = json_decode($payapplie->paid_amount,true);
                    
                    foreach($qc_infos as $qc_info)
                    {
                        if($startDate->lte($qc_info['qc_date']) && $endDate->gte($qc_info['qc_date']))
                        {
                            $total_amount += $qc_info['qc_amount'];
                           
                        }
                    }
                    $qc = ['total'=> $total_amount, 'class_id'=>$payapplie->class_id, 'feehead_id'=> $payapplie->feehead_id];
                    array_push($qc_data, $qc);
                }
                
            }
            return view('layouts.dashboard.fee_management.report.head.index',compact(
                'users',
                'startups',
                'data',
                'qc_data'
            )); 
        }
                              
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
