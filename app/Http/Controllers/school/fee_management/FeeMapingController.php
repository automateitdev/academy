<?php

namespace App\Http\Controllers\school\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeHead;
use App\Models\Feesubhead;
use App\Models\Ledger;
use App\Models\Fund;
use App\Models\FeeMaping;

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
        return view('layouts.dashboard.fee_management.mapping.index', compact('feeheads','feesubheads','ledgers','funds'));
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
        foreach((array)$request->feesubhead_id as $key => $feesubhead_id)
        {
            $input = new FeeMaping();
            $input->institute_id = $request->institute_id;
            $input->feehead_id = $request->feehead_id;
            $input->feesubhead_id = $feesubhead_id;
            $input->ledger_id = $request->ledger_id;
            $input->fund_id = $request->fund_id;
            $input->save(); 
        }
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
        //
    }
}
