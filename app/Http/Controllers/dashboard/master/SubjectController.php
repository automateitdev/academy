<?php

namespace App\Http\Controllers\dashboard\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\Subjecttype;
use App\Models\Subject;
use App\Models\Subjectmap;
use App\Models\SectionAssign;
use App\Models\Student;
use App\Models\GroupAssign;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\StudentTraits;
use App\Models\StudentSubjectMap;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
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
        $subjecttypes = Subjecttype::all();
        $subjects = Subject::all();
        return view('layouts.dashboard.master_setting.subject.index', compact('users', 'startups', 'subjecttypes', 'subjects'));
    }

    public function subjectadd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $subname = ucfirst(strtolower($request->name));
        $subjects = Subject::create(['name' => $subname]);

        return redirect(route('subject.index'));
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
        $this->validate($request, [
            'academic_year_id' => 'required',
            'class_id' => 'required',
            'group_id' => 'required',
            'subject_id' => 'required',
            'type' => 'required',
            'serial' => 'required',
            'merge' => 'nullable',
        ]);
        
        try {
            foreach ($request->subject_id as $key => $subject_id) {
                $input = new Subjectmap();
                $input->institute_id = Auth::user()->institute_id;
                $input->academic_year_id = $request->academic_year_id;
                $input->class_id = $request->class_id;
                $input->group_id = $request->group_id;
                $input->subject_id = $subject_id;
                $input->type = $request->type[$key];
                $input->serial = $request->serial[$key];
                $input->merge = $request->merge[$key];

                if ($input->save()) {
                    $this->assign_subject(Auth::user()->institute_id, null, $request->class_id, $request->group_id, $request->academic_year_id);
                } else {
                    return redirect(route('subject.index'))->with('error', 'Try Again Letter.');
                }
            }

            return redirect(route('subject.index'))->with('message', 'Data Upload Successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect(route('subject.index'))->with('error', 'This Subject is already configured.');
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



    public function fourthsubject()
    {
        $users = User::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $subjecttypes = Subjecttype::all();
        $subjects = Subject::all();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        return view(
            'layouts.dashboard.master_setting.subject.foursubject',
            compact('users', 'startups', 'subjecttypes', 'subjects', 'sectionAssignes')
        );
    }
    public function search(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required',
            'section_id' => 'required',
            'academic_year_id' => 'required'
        ]);

        $users = User::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $sectionId = SectionAssign::where('institute_id', Auth::user()->institute_id)
            ->where('id', $request->section_id)
            ->first();
        $groupId = GroupAssign::where('institute_id', Auth::user()->institute_id)
            ->where('group_id', $request->group_id)
            ->first();
        $stdudentSubjectMap = StudentSubjectMap::where('class_id', $sectionId->id)
            ->where('academic_year_id', $request->academic_year_id)
            ->where('group_id', $groupId->group_id)
            ->where('institute_id', Auth::user()->institute_id)
            ->paginate(50);

        return view('layouts.dashboard.master_setting.subject.foursubject', compact('users', 'startups', 'sectionAssignes', 'stdudentSubjectMap'));
    }
    public function singleedit($student_id)
    {
        $users = User::all();
        $subjecttypes = Subjecttype::all();
        $stdSubMaps = StudentSubjectMap::where('student_id', $student_id)
            ->where('institute_id', Auth::user()->institute_id)
            ->get();
        return view('layouts.dashboard.master_setting.subject.singleupdate', compact('stdSubMaps', 'users', 'subjecttypes'));
    }

    public function foursubjectupdate(Request $request)
    {
        // dd($request);

        foreach ($request->id as $key => $id) {
            DB::table('student_subject_maps')
                ->where('id', $id)
                ->update(["subject_type_id" => $request->subject_type_id[$key]]);
        }
        return redirect(route('fourthsubject.index'))->with('success', 'Data Update Successfully');
    }

    public function multipleedit($std_id)
    {
        $users = User::all();
        $students = Student::find($std_id);
        return view('layouts.dashboard.master_setting.subject.multipleupdate', compact('students', 'users'));
    }
}
