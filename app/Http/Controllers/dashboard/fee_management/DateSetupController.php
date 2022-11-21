<?php

namespace App\Http\Controllers\dashboard\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\FeeHead;
use App\Models\Feesubhead;
use App\Models\Datesetup;
use App\Models\FeeMaping;
use Illuminate\Support\Facades\Auth;
use App\Models\SectionAssign;
use App\Models\Student;
use App\Http\Traits\StudentTraits;

class DateSetupController extends Controller
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
        $startups = Startup::all();
        $feeheads = FeeHead::all();
        return view('layouts.dashboard.fee_management.date.index', compact('users','startups','feeheads'));
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

    public function getFeesubheadfromFeehead(Request $request)
    {
        $data = FeeMaping::with('feesubhead')->select('feesubhead_id', 'id')->where('feehead_id', $request->id)->get();
        $alldata = $data->unique('feesubhead_id');
        $alldata = $alldata->values()->all();
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
        // dd($request->class_id);
        $this->validate($request,[
            'academic_year_id' => 'required',
            'class_id' => 'nullable',
            'feehead_id' => 'nullable',
            'feesubhead_id' => 'nullable',
            'payable_date' => 'nullable',
            'fineactive_date' => 'nullable',
        ]);

    foreach ($request->class_id as $key => $class_id) {
        $input = [ 
        'institute_id' => Auth::user()->institute_id,
        'academic_year_id' => $request->academic_year_id,
        'class_id' => $class_id,
        'feehead_id' => $request->feehead_id,
        'feesubhead_id' => null,
        'payable_date' => null,
        'fineactive_date' => null,
        ];
        
        foreach($request->feesubhead_id as $key => $feesubhead_id)
        {
            $input['feesubhead_id'] = $feesubhead_id;
            $input['payable_date'] = $request->payable_date[$key];
            $input['fineactive_date'] = $request->fineactive_date[$key];
            if($data = Datesetup::insert($input))
            {
                $sectionAssign = SectionAssign::where('class_id', $class_id)->get();
                foreach($sectionAssign as $section){
                    
                    if($section->class_id == $class_id)
                    {
                        $students = Student::where('section_id', $section->id)->get();
                        foreach($students as $student)
                        {
                            $this->assign_fee($student->std_id, $student->institute_id);
                        }
                    }
                }
            }
        } 
           
    }
        // return redirect(route('date.index'))->with('message', 'Data Upload Successfully');
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
