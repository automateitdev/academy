<?php

namespace App\Http\Controllers\dashboard\fee_management;

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
use App\Models\GroupAssign;
use App\Models\StartupSubcategory;
use App\Models\Feeamount;
use App\Models\Feefineamount;
use App\Models\SectionAssign;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeheads = FeeHead::where('institute_id', Auth::user()->institute_id)->get();
        $feesubheads = Feesubhead::where('institute_id', Auth::user()->institute_id)->get();
        $ledgers = Ledger::where('institute_id', Auth::user()->institute_id)->get();
        $funds = Fund::where('institute_id', Auth::user()->institute_id)->get();
        $users = User::all();
        $feemappings = FeeMaping::where('institute_id', Auth::user()->institute_id)->get();
        $feefinemappings = FeeFineMaping::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $startupsubcategories = StartupSubcategory::all();
        $feeamounts = Feeamount::where('institute_id', Auth::user()->institute_id)->get();
        $feefinemaounts = Feefineamount::where('institute_id', Auth::user()->institute_id)->get();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.fee_management.amount.index',
         compact('feeheads','feesubheads','ledgers','funds','users','feemappings','feefinemappings','startups','startupsubcategories','feeamounts','feefinemaounts','sectionAssignes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGroupForAmount(Request $request)
    {
        $startup_id = [];
        $groupname = [];
        $groupassign_id = [];
        // $class = SectionAssign::select('class_id')->where('id',$request->id)->first();
        $data = GroupAssign::select('id', 'group_id')->where('class_id', $request->id)->get();
        // return $data;
        foreach($data as $d){
            $startups = Startup::select('id', 'startup_subcategory_id')->where('id', $d->group_id)->get();
            
            foreach($startups as $startup)
            {
                array_push($groupassign_id, $startup->id);
                array_push($startup_id,$startup->startup_subcategory_id);
                $subName = StartupSubcategory::select('startup_subcategory_name')->where('id', $startup->startup_subcategory_id)->get();
                foreach($subName as $name)
                {
                    array_push($groupname, $name->startup_subcategory_name);
                }
            }
            
        }
        $groupdata = array_combine($groupassign_id, $groupname);
        return $groupdata;
    }

    public function create()
    {
        //
    }

    public function getFeeheadToFund(Request $request)
    {
        $data = FeeMaping::with('fund')->select('fund_id', 'id')->where('feehead_id',$request->id)->get();
        $alldata = $data->unique('fund_id');
        $alldata->values()->all();
    	return response()->json($alldata);
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
        Session::put('navtab', $request->nav_tab);

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
            'academic_year_id'=>'required'
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
            $input->academic_year_id = $request->academic_year_id;
            $input->save(); 
        }
        
        return redirect(route('amount.index'))->with('message', 'Data Upload Successfully');
    }

    public function fineStore(Request $request)
    {
        Session::put('navtab', $request->nav_tab);

        // dd($request->class_id);
        $this->validate($request,[
            'institute_id'=> 'required', 
            'class_id'=> 'required',
            'period_id'=> 'required',
            'amount'=>'required',
        ]);
        
        foreach ($request->class_id as $key => $class_id) {
            $input = [ 
            'institute_id' => Auth::user()->institute_id,
            'class_id' => $class_id,
            'amount' => $request->amount,
            'period_id' => null,
            ];
            
            foreach($request->period_id as $period)
            {
                $input['period_id'] = $period;
                $data = Feefineamount::create($input);
            }   
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
        Session::put('navtab', $request->nav_tab);

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
            'academic_year_id'=>'required'

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
            $input->academic_year_id = $request->academic_year_id;
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
        Feeamount::find($id)->delete();
        return redirect()->back();
    }
    public function absentdestroy($id)
    {
        Feefineamount::find($id)->delete();
        return redirect()->back();
    }
}
