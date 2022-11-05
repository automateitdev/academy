<?php

namespace App\Http\Controllers\school\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\SectionAssign;
use App\Models\GroupAssign;
use App\Models\Student;
use App\Models\FeeHead;
use App\Models\Waiver;
use App\Models\Feeamount;
use App\Models\Waivermapping;
use Illuminate\Support\Facades\Auth;

class WaiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $groupassigns = GroupAssign::all();
        return view('layouts.dashboard.fee_management.waiver.index', compact('users', 'startups', 'sectionAssignes', 'groupassigns'));
    }

    public function getSectionForWaiver(Request $request)
    {
        // $data = AccountGroup::select('account_group', 'id')->where('account_category_id', $request->id)->take(100)->get();
        // return response()->json($data);
    }
    public function search(Request $request)
    {
        // $this->validate($request,[
        //     'section_id' => 'required',
        //     'group_id' => 'required',
        //     'academic_year_id' => 'required',
        //     'stdcategory_id' => 'required',
        // ]);
        $users = User::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $groupassigns = GroupAssign::all();
        $students = Student::where('section_id','LIKE','%'.$request->section_id.'%')
                    ->where('group_id','LIKE','%'.$request->group_id.'%')
                    ->where('academic_year_id','LIKE','%'.$request->academic_year_id.'%')
                    ->where('std_category_id','LIKE','%'.$request->stdcategory_id.'%')
                    ->paginate(120);
        return view('layouts.dashboard.fee_management.waiver.index', compact('users', 'startups', 'sectionAssignes', 'groupassigns','students'));
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
    public function store(Request $request, $id)
    {
        // dd($request);
        $this->validate($request,[
            'student_id' => 'required',
            'feehead_id' => 'required',
            'waiver_category_id' => 'required',
            'amount' => 'required',
        ]);
        $input = new Waivermapping();
        $input->institute_id = Auth::user()->institute_id ;
        $input->student_id = $request->student_id ;
        $input->feehead_id = $request->feehead_id ;
        $input->waiver_category_id = $request->waiver_category_id ;
        $input->amount = $request->amount ;
        $input->save();
        
        return redirect(route('waiver.index'))->with('message', 'Data Upload Successfully');
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
        $students = Student::find($id);
        $users = User::all();
        $startups = Startup::all();
        $feeheads = FeeHead::all();
        $waivers = Waiver::all();
        return view('layouts.dashboard.fee_management.waiver.edit', compact('students', 'startups', 'users', 'feeheads', 'waivers'));
    }

    public function getfeeheadForWaiver(Request $request)
    {
        $data = Feeamount::distinct()->select('feeamount')->where('feehead_id', $request->id)->get();
        $alldata = $data->values();
        return response()->json($alldata);
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
