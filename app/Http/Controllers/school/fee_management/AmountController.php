<?php

namespace App\Http\Controllers\school\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeHead;
use App\Models\Feesubhead;
use App\Models\Ledger;
use App\Models\Fund;
use App\Models\FeeMaping;
use App\Models\FeeFineMaping;
use App\Models\User;
use App\Models\Startup;
use App\Models\StartupSubcategory;
use App\Models\Feeamount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeheads = FeeHead::all();
        $feesubheads = Feesubhead::all();
        $ledgers = Ledger::all();
        $funds = Fund::all();
        $users = User::all();
        $feemappings = FeeMaping::all();
        $feefinemappings = FeeFineMaping::all();
        $startups = Startup::all();
        $startupsubcategories = StartupSubcategory::all();
        $feeamounts = Feeamount::all();
        return view('layouts.dashboard.fee_management.amount.index',
         compact('feeheads','feesubheads','ledgers','funds','users','feemappings','feefinemappings','startups','startupsubcategories','feeamounts'));
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

    public function getFeeheadToFund(Request $request)
    {
        $data = Fund::select('fund_name', 'id')->where('fee_head_id',$request->id)->take(100)->get();
    	return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $this->validate($request,[
            'institute_id'=> 'required',
            'class_id'=> 'required',
            'group_id'=> 'required',
            'stdcategory_id'=> 'required',
            'feehead_id'=> 'required',
            'feeamount'=> 'required',
            'fineamount'=> 'nullable',
            'fund_id'=>'required',
            'fund_amount'=>'required',
        ]);
        foreach ($request->fund_amount as $key => $fund_amount) {
            
            $input = new Feeamount();
            $input->institute_id = Auth::user()->institute_id;
            $input->class_id = $request->class_id;
            $input->group_id = $request->group_id;
            $input->stdcategory_id = $request->stdcategory_id;
            $input->feehead_id = $request->feehead_id;
            $input->feeamount = $request->feeamount;
            $input->fineamount = $request->fineamount;
            $input->fund_id = $request->fund_id[$key];
            $input->fund_amount = $fund_amount;
            $input->save(); 
        }
        
        return redirect(route('amount.index'))->with('message', 'Data Upload Successfully');
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
        $this->validate($request,[
            'institute_id'=> 'required',
            'class_id'=> 'required',
            'group_id'=> 'required',
            'stdcategory_id'=> 'required',
            'feehead_id'=> 'required',
            'feeamount'=> 'required',
            'fineamount'=> 'nullable',
            'fund_id'=>'required',
            'fund_amount'=>'required',
        ]);
        foreach ($request->fund_amount as $key => $fund_amount) {
            
            $input = Feeamount::find($id);
            $input->institute_id = Auth::user()->institute_id;
            $input->class_id = $request->class_id;
            $input->group_id = $request->group_id;
            $input->stdcategory_id = $request->stdcategory_id;
            $input->feehead_id = $request->feehead_id;
            $input->feeamount = $request->feeamount;
            $input->fineamount = $request->fineamount;
            $input->fund_id = $request->fund_id[$key];
            $input->fund_amount = $fund_amount;
            $input->save(); 
        }
        
        return redirect(route('amount.index'))->with('message', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FeeMaping::find($id)->delete();
        return redirect()->back();
    }
    public function fine_destroy($id)
    {
        FeeFineMaping::find($id)->delete();
        return redirect()->back();
    }
}
