<?php

namespace App\Http\Controllers\dashboard\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Startup;
use App\Models\SectionAssign;
use App\Models\GroupAssign;
use App\Models\StartupCategory;
use App\Models\StartupSubcategory;
use App\Models\User;

class ClassSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startups = Startup::all();
        $sectionassigns = SectionAssign::all();
        $groupassigns = GroupAssign::all();
        $startupsubcategories = StartupSubcategory::all();
        $users = User::all();
        return view('layouts.dashboard.master_setting.class_setup.index', compact('startups', 'sectionassigns', 'groupassigns','startupsubcategories','users'));
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
    public function section_store(Request $request)
    {
        $this->validate($request, [
            'institute_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'shift_id' => 'required',
        ]);
        $sectionassigns = SectionAssign::create($request->all());

        return redirect(route('class.index'));
    }
    public function group_store(Request $request)
    {
        $this->validate($request, [
            'institute_id' => 'required',
            'class_id' => 'required',
            'group_id' => 'required',
        ]);
        $groupassigns = GroupAssign::create($request->all());

        return redirect(route('class.index'));
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
