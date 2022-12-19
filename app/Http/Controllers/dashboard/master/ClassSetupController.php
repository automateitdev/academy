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
use Illuminate\Database\QueryException;

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
        try {
            $groupassigns = GroupAssign::create($request->all());
            
            return redirect(route('class.index'))->with('message', 'Data Upload Successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect(route('class.index'))->with('error', 'This Group is already configured.');
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
    public function getgroupfromgroupassign(Request $request)
    {
        $startup_id = [];
        $groupname = [];
        $groupassign_id = [];
        $data = GroupAssign::select('id', 'group_id')->where('class_id', $request->id)->get();
        foreach($data as $d){
            $startups = Startup::select('startup_subcategory_id')->where('id', $d->group_id)->get();
            array_push($groupassign_id, $d->id);
            foreach($startups as $startup)
            {
                array_push($startup_id,$startup->startup_subcategory_id);
                $subName = StartupSubcategory::select('startup_subcategory_name')->where('id', $startup->startup_subcategory_id)->get();
                foreach($subName as $name)
                {
                    array_push($groupname, $name->startup_subcategory_name);
                }
            }
            
        }
        $groupdata = array_combine($groupassign_id, $groupname);
        return $groupdata;
    }
     
    public function destroy($id)
    {
        //
    }
    public function group_destroy($id)
    {
        GroupAssign::find($id)->delete();
        return redirect()->back();

    }
}
