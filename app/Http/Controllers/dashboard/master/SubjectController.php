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
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\StudentTraits;

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
        $startups = Startup::all();
        $subjecttypes = Subjecttype::all();
        $subjects = Subject::all();
        return view('layouts/dashboard/master_setting/subject/index', compact('users', 'startups', 'subjecttypes', 'subjects'));
    }

    public function subjectadd(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $subname = strtolower($request->name);
        $subjects = Subject::create(['name'=>$subname]);

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
            'class_id' => 'required',
            'group_id' => 'required',
            'subject_id' => 'required',
            'type' => 'required',
            'serial' => 'required',
            'merge' => 'nullable',
        ]);
        foreach($request->subject_id as $key=>$subject_id)
        {
            $input = new Subjectmap();
            $input->institute_id = Auth::user()->institute_id;
            $input->class_id = $request->class_id;
            $input->group_id = $request->group_id;
            $input->subject_id = $subject_id;
            $input->type = $request->type[$key];
            $input->serial = $request->serial[$key];
            $input->merge = $request->merge[$key];
            
            if($input->save())
            {
                $this->assign_subject(Auth::user()->institute_id, null, $request->class_id, $request->group_id);
            }
            
        }
        return redirect(route('subject.index'))->with('success', 'Subject Configure Success.');
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
        $startups = Startup::all();
        $subjecttypes = Subjecttype::all();
        $subjects = Subject::all();
        $sectionAssignes = SectionAssign::all();
        return view('layouts/dashboard/master_setting/subject/foursubject', 
        compact('users', 'startups', 'subjecttypes', 'subjects', 'sectionAssignes'));
    }
    public function search(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required',
            'section_id' => 'required',
        ]);

        $users = User::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $students = Student::where('section_id', 'LIKE', '%' . $request->section_id . '%')
            ->where('group_id', 'LIKE', '%' . $request->group_id . '%')
            ->paginate(50);
        return view('layouts/dashboard/master_setting/subject/foursubject', compact('users', 'startups', 'sectionAssignes', 'students'));
    }
    public function singleedit($id)
    {
        $users = User::all();
        $students = Student::find($id);
        return view('layouts/dashboard/master_setting/subject/singleupdate', compact('students', 'users'));
    }
    public function multipleedit($id)
    {
        $users = User::all();
        $students = Student::find($id);
        return view('layouts/dashboard/master_setting/subject/multipleupdate', compact('students', 'users'));
    }
}
