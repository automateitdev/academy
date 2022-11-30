<?php

namespace App\Http\Controllers\dashboard\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\Subjecttype;
use App\Models\Subject;
use App\Models\Subjectmap;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
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
                return redirect(route('subject.index'))->with('success', 'Subject Configure Success.');
            }
            else{
                return redirect(route('subject.index'))->with('success', 'Something wrong, try again.');
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
}
