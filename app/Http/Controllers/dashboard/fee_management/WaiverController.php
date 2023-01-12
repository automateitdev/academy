<?php

namespace App\Http\Controllers\dashboard\fee_management;

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
use App\Http\Traits\StudentTraits;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class WaiverController extends Controller
{
    use StudentTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $groupassigns = GroupAssign::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.fee_management.waiver.index', compact('users', 'startups', 'sectionAssignes', 'groupassigns'));
    }

    public function getSectionForWaiver(Request $request)
    {
        // $data = AccountGroup::select('account_group', 'id')->where('account_category_id', $request->id)->take(100)->get();
        // return response()->json($data);
    }
    public function search(Request $request)
    {
        $this->validate($request,[
            'section_id' => 'required',
            'group_id' => 'required',
            'academic_year_id' => 'required',
            'stdcategory_id' => 'required',
        ]);
        $academic_year_id = $request->academic_year_id;
        Session::put('academic_year_id', $academic_year_id);

        $users = User::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $groupassigns = GroupAssign::where('institute_id', Auth::user()->institute_id)->get();
        $students = Student::where('section_id','LIKE','%'.$request->section_id.'%')
                    ->where('group_id','LIKE','%'.$request->group_id.'%')
                    ->where('academic_year_id','LIKE','%'.$request->academic_year_id.'%')
                    ->where('std_category_id','LIKE','%'.$request->stdcategory_id.'%')
                    ->paginate(100);
        return view('layouts.dashboard.fee_management.waiver.index', compact('users', 'startups', 'sectionAssignes', 'groupassigns','students','academic_year_id'));
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
        $academic_year_id = Session::get('academic_year_id');
        try{
            $input = Waivermapping::updateOrCreate(
                ['student_id' => $request->student_id, 'feehead_id' => $request->feehead_id, 'waiver_category_id' => $request->waiver_category_id ],
                [
                    'institute_id' => Auth::user()->institute_id,
                    'student_id' => $request->student_id,
                    'feehead_id' => $request->feehead_id,
                    'waiver_category_id' => $request->waiver_category_id,
                    'amount' => $request->amount
                ]
            );
                if($input->save())
                {
                    $this->assign_fee($request->student_id,Auth::user()->institute_id, $academic_year_id);
                }
                return redirect(route('waiver.index'))->with('message', 'Data Upload Successfully');
          }
          catch (QueryException $e){
              $errorCode = $e->errorInfo[1];
              if($errorCode == 1062){
                  // houston, we have a duplicate entry problem
                  return redirect(route('waiver.edit'.'/'.$id))->with('error', 'Waiver is already assigned');
              }
          }
        
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
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $feeheads = FeeHead::where('institute_id', Auth::user()->institute_id)->get();
        $waivers = Waiver::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.fee_management.waiver.edit', compact('students', 'startups', 'users', 'feeheads', 'waivers'));
    }

    public function getfeeheadForWaiver(Request $request)
    {
        $class_id = SectionAssign::select("class_id")->where('id', $request->class_id)->first();
        
        $data = Feeamount::distinct()->select('feeamount')
                        ->where('feehead_id', $request->id)
                        ->where('class_id', $class_id->class_id)
                        ->get();
        // return $data;
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
