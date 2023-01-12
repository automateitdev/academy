<?php

namespace App\Http\Controllers\dashboard\stdManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\Student;
use App\Models\SectionAssign;
use App\Http\Traits\StudentTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class PromotionController extends Controller
{
    use StudentTraits;
    public function with_merit_index()
    {
        $users = User::all();
        return view('layouts.dashboard.std_management.promotion.with_merit.index', compact('users'));
    }
    public function without_merit_index()
    {
        $users = User::all();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.std_management.promotion.without_merit.index', compact(
            'users',
            'sectionAssignes',
            'startups'
        ));
    }
    public function without_merit_search(Request $request)
    {
        $users = User::all();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $students = Student::where('institute_id', Auth::user()->institute_id)
            ->where('section_id', $request->class_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->orderBy('roll', 'ASC')
            ->get();
        // dd($students);
        return view('layouts.dashboard.std_management.promotion.without_merit.index', compact(
            'users',
            'sectionAssignes',
            'startups',
            'students'
        ));
    }
    public function without_merit_post(Request $request)
    {
        $this->validate($request, [
            'std_id' => 'required',
            'academic_year_id' => 'required',
            'session_id' => 'required',
            'section_id' => 'required',
            'std_category_id' => 'required',
            'group_id' => 'required',
            'roll' => 'required',
            'name' => 'required',
            'gender_id' => 'nullable',
            'father_name' => 'required',
            'mother_name' => 'required',
            'mobile_no' => 'required',
        ]);
        
        try {
            foreach ($request->std_details as $key => $std_id) {
                    
                    $input = new Student();
                    $input->institute_id = Auth::user()->institute_id;
                    $input->std_id = $std_id;
                    $input->academic_year_id = $request->academic_year_id;
                    $input->session_id = $request->session_id;
                    $input->section_id = $request->section_id;
                    $input->std_category_id = $request->std_category_id[$std_id];
                    $input->group_id = $request->group_id;
                    $input->roll = $request->roll[$std_id];
                    $input->name = $request->name[$std_id];
                    $input->gender_id = $request->gender_id[$std_id];
                    $input->religion_id = $request->religion_id[$std_id];
                    $input->father_name = $request->father_name[$std_id];
                    $input->mother_name = $request->mother_name[$std_id];
                    $input->mobile_no = $request->mobile_no[$std_id];
                    if ($input->save()) {
                        $this->assign_fee($std_id, Auth::user()->institute_id, $request->academic_year_id);
                        $this->assign_subject(Auth::user()->institute_id, $std_id, $request->section_id, $request->group_id, $request->academic_year_id);
                    } else {
                        return redirect(route('without_merit.index'))->with('error', 'Try again later.');
                    }
            }
            return redirect(route('without_merit.index'))->with('message', 'Data Upload Successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect(route('without_merit.index'))->with('error', 'This Student is already registered.');
            }
        }
    }

    public function pushback_index()
    {
        $users = User::all();
        return view('layouts/dashboard/std_management/promotion/pushback/index', compact('users'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
