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

class FeeMapingController extends Controller
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
        return view('layouts.dashboard.fee_management.mapping.index',
         compact('feeheads','feesubheads','ledgers','funds','users','feemappings','feefinemappings'));
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
        // dd($request->all());
        // dd($request->institute_id);
        foreach($request->feesubhead_id as $key => $feesubhead_id)
        {
            $input = new FeeMaping();
            $input->institute_id = $request->institute_id;
            $input->feehead_id = $request->feehead_id[0];
            $input->feesubhead_id = $feesubhead_id;
            $input->ledger_id = $request->ledger_id[0];
            $input->fund_id = $request->fund_id[$key];
            $input->save(); 
        }
        return redirect(route('fee.maping.index'));
    }

    public function fine_store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'institute_id' => 'required',
            'feehead_id' => 'nullable',
            'ledger_id' => 'nullable',
            'fund_id' => 'nullable',
        ]);
        $input = new FeeFineMaping();
        $input->institute_id = $request->institute_id;
        $input->feehead_id = $request->feehead_id;
        $input->ledger_id = $request->ledger_id;
        $input->fund_id = $request->fund_id;
        $input->save(); 
    
        return redirect(route('fee.maping.index'));
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
        FeeMaping::find($id)->delete();
        return redirect()->back();
    }
    public function fine_destroy($id)
    {
        FeeFineMaping::find($id)->delete();
        return redirect()->back();
    }
}
