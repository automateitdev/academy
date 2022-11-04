<?php

namespace App\Http\Controllers\school\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\SectionAssign;
use App\Models\GroupAssign;
use App\Models\Student;

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
        $users = User::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $groupassigns = GroupAssign::all();
        $students = Student::where('section_id','LIKE','%'.$request->section_id.'%')
                    ->where('group_id','LIKE','%'.$request->group_id.'%')
                    ->where('academic_year_id','LIKE','%'.$request->academic_year_id.'%')
                    ->where('std_category_id','LIKE','%'.$request->stdcategory_id.'%')
                    ->paginate(120);
        return view('layouts.dashboard.fee_management.waiver.query', compact('users', 'startups', 'sectionAssignes', 'groupassigns','students'));
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
