<?php

namespace App\Http\Controllers\dashboard\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\SectionAssign;
use App\Models\Student;
use App\Models\FeeHead;
use App\Models\FeeMaping;
use App\Models\Feeheadremove;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\StudentTraits;
use Illuminate\Support\Facades\Session;

class RemoveController extends Controller
{
    use StudentTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function feeheadindex()
    {
        $users = User::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        return view('layouts/dashboard/fee_management/remove/feehead/index', compact('users', 'startups', 'sectionAssignes'));
    }
    public function feeheadsearch(Request $request)
    {
        $this->validate($request, [
            'academic_year_id' => 'required',
            'section_id' => 'required',
        ]);

        $users = User::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $students = Student::where('section_id', 'LIKE', '%' . $request->section_id . '%')
            ->where('academic_year_id', 'LIKE', '%' . $request->academic_year_id . '%')
            ->paginate(100);
        return view('layouts/dashboard/fee_management/remove/feehead/index', compact('users', 'startups', 'sectionAssignes', 'students'));
    }

    public function feeheadremove($id)
    {
        $users = User::all();
        $feeheads = FeeHead::all();
        $students = Student::find($id);
        return view('layouts/dashboard/fee_management/remove/feehead/remove', compact('users', 'students', 'feeheads'));
    }
    public function feeheadstore(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'feehead_id' => 'required',
        ]);

        $students = Student::where('institute_id', Auth::user()->institute_id)->get();
        try {
            foreach ($students as $student) {
                if ($student->std_id == $request->student_id) {
                    DB::table('payapplies')
                        ->where(['student_id' => $request->student_id, 'feehead_id' => $request->feehead_id])
                        ->update(
                            array(
                                'payment_state' => 3
                            )
                        );

                    return redirect(route('fee.remove.index'))->with('message', 'Data Upload Successfully');
                }
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                // houston, we have a duplicate entry problem
                return redirect(route('fee.remove.index'))->with('message', 'Data Upload Successfully');
            }
        }
    }

    // Fee head reassign start
    
    public function feeheadassign($id)
    {
        $users = User::all();
        $feeheads = FeeHead::all();
        $students = Student::find($id);
        return view('layouts/dashboard/fee_management/remove/feehead/assign', compact('users', 'students', 'feeheads'));
    }
    public function feeheadassignstore(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'feehead_id' => 'required',
        ]);

        $students = Student::where('institute_id', Auth::user()->institute_id)->get();
        try {
            foreach ($students as $student) {
                if ($student->std_id == $request->student_id) {
                    DB::table('payapplies')
                        ->where(['student_id' => $request->student_id, 'feehead_id' => $request->feehead_id])
                        ->update(
                            array(
                                'payment_state' => 0
                            )
                        );

                    return redirect(route('fee.remove.index'))->with('message', 'Data Upload Successfully');
                }
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                // houston, we have a duplicate entry problem
                return redirect(route('fee.remove.index'))->with('message', 'Data Upload Successfully');
            }
        }
    }
    // //////////////////Fee Sub Head Remove Start/////////////////////

    public function feesubheadindex()
    {
        $users = User::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        return view('layouts/dashboard/fee_management/remove/feesubhead/index', compact('users', 'startups', 'sectionAssignes'));
    }

    public function feesubheadsearch(Request $request)
    {
        $this->validate($request, [
            'academic_year_id' => 'required',
            'section_id' => 'required',
        ]);

        $users = User::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $students = Student::where('section_id', 'LIKE', '%' . $request->section_id . '%')
            ->where('academic_year_id', 'LIKE', '%' . $request->academic_year_id . '%')
            ->paginate(100);
        return view('layouts/dashboard/fee_management/remove/feesubhead/index', compact('users', 'startups', 'sectionAssignes', 'students'));
    }

    public function feesubheadremove($id)
    {
        $users = User::all();
        $feeheads = FeeHead::all();
        $students = Student::find($id);
        return view('layouts/dashboard/fee_management/remove/feesubhead/remove', compact('users', 'students', 'feeheads'));
    }
    public function getsubheadforremove(Request $request)
    {
        $data = FeeMaping::with('feesubhead')->distinct()->select('feesubhead_id')->where('feehead_id', $request->id)->get();
        return response()->json($data);
    }
    public function feesubheadstore(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'feehead_id' => 'required',
            'feesubhead_id' => 'required'
        ]);

        $students = Student::where('institute_id', Auth::user()->institute_id)->get();
        try {
            foreach ($students as $student) {
                if ($student->std_id == $request->student_id) {
                    DB::table('payapplies')
                        ->where(['student_id' => $request->student_id, 'feehead_id' => $request->feehead_id, 'feesubhead_id' => $request->feesubhead_id])
                        ->update(
                            array(
                                'payment_state' => 3
                            )
                        );

                    return redirect(route('feesub.remove.index'))->with('message', 'Data Upload Successfully');
                }
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                // houston, we have a duplicate entry problem
                return redirect(route('feesub.remove.index'))->with('message', 'Data Upload Successfully');
            }
        }
    }
    // Fee sub head reassign start
    public function feesubheadassign($id)
    {
        $users = User::all();
        $feeheads = FeeHead::all();
        $students = Student::find($id);
        return view('layouts/dashboard/fee_management/remove/feesubhead/assign', compact('users', 'students', 'feeheads'));
    }
    public function feesubheadassignstore(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'feehead_id' => 'required',
            'feesubhead_id' => 'required'
        ]);

        $students = Student::where('institute_id', Auth::user()->institute_id)->get();
        try {
            foreach ($students as $student) {
                if ($student->std_id == $request->student_id) {
                    DB::table('payapplies')
                        ->where(['student_id' => $request->student_id, 'feehead_id' => $request->feehead_id, 'feesubhead_id' => $request->feesubhead_id])
                        ->update(
                            array(
                                'payment_state' => 0
                            )
                        );

                    return redirect(route('feesub.remove.index'))->with('message', 'Data Upload Successfully');
                }
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                // houston, we have a duplicate entry problem
                return redirect(route('feesub.remove.index'))->with('message', 'Data Upload Successfully');
            }
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
