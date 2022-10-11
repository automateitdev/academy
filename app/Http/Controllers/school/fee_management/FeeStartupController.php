<?php

namespace App\Http\Controllers\school\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeHead;
use App\Models\Feesubhead;
use App\Models\Waiver;
use App\Models\Fund;
use App\Models\AccountCategory;
use App\Models\AccountGroup;
use App\Models\Ledger;

class FeeStartupController extends Controller
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
        $waivers = Waiver::all();
        $funds = Fund::all();
        $accountcategories = AccountCategory::all();
        $accountgroups = AccountGroup::all();
        $ledgers = Ledger::all();
        return view('layouts.dashboard.fee_management.startup.index',
         compact('feeheads','feesubheads','waivers','funds','accountcategories','accountgroups','ledgers'));
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
    public function headstore(Request $request)
    {
        $this->validate($request,[
            'institute_id' => 'required',
            'head_name' => 'required',
        ]);
        $feeheads = FeeHead::create($request->all());
        
        return redirect(route('fee.startup.index'));
    }
    public function subheadstore(Request $request)
    {
        $this->validate($request,[
            'institute_id' => 'required',
            'subhead_name' => 'required',
        ]);
        $feesubheads = Feesubhead::create($request->all());
        
        return redirect(route('fee.startup.index'));
    }

    public function waiverstore(Request $request)
    {
        $this->validate($request,[
            'institute_id' => 'required',
            'waiver_name' => 'required',
        ]);
        $waivers = Waiver::create($request->all());
        
        return redirect(route('fee.startup.index'));
    }
    public function fundstore(Request $request)
    {
        $this->validate($request,[
            'institute_id' => 'required',
            'fund_name' => 'required',
        ]);
        $funds = Fund::create($request->all());
        
        return redirect(route('fee.startup.index'));
    }

    public function getAccountCategory(Request $request)
    {
        $data = AccountGroup::select('account_group', 'id')->where('account_category_id', $request->id)->take(100)->get();
        return response()->json($data);
    }

    public function ledgerstore(Request $request)
    {
        $this->validate($request,[
            'institute_id' => 'required',
            'account_subcat_id' => 'required',
            'ledger_name' => 'required',
            'note' => 'nullable',
        ]);
        $ledgers = Ledger::create($request->all());
        
        return redirect(route('fee.startup.index'));
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
        FeeHead::find($id)->delete();
        return redirect()->back();
    }
    public function subhead_destroy($id)
    {
        Feesubhead::find($id)->delete();
        return redirect()->back();
    }
    public function waiver_destroy($id)
    {
        Waiver::find($id)->delete();
        return redirect()->back();
    }
    public function fund_destroy($id)
    {
        Fund::find($id)->delete();
        return redirect()->back();
    }
    public function ledger_destroy($id)
    {
        Ledger::find($id)->delete();
        return redirect()->back();
    }
}
