<?php

namespace App\Http\Controllers\dashboard\stdManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\Student;
use App\Models\SectionAssign;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{

    public function with_merit_index()
    {
        $users = User::all();
        return view('layouts/dashboard/std_management/promotion/with_merit/index', compact('users'));
    }
    public function without_merit_index()
    {
        $users = User::all();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts/dashboard/std_management/promotion/without_merit/index', compact(
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
        return view('layouts/dashboard/std_management/promotion/without_merit/index', compact(
            'users',
            'sectionAssignes',
            'startups',
            'students'
        ));
    }
    public function without_merit_post(Request $request)
    {
        dd($request);
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
