<?php

namespace App\Http\Controllers\dashboard\examManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\Examcode;
use App\Models\Examstartup;
use App\Models\Subjectmap;
use App\Models\Examconfig;
use App\Models\GroupAssign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class MarkConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $groupassigns = GroupAssign::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.exam_management.settings.markconfig.index', compact('users', 'startups', 'groupassigns'));
    }

    public function search(Request $request)
    {
        $class_id = $request->class_id;
        $group_id = $request->group_id;
       
        $academic_year_id = $request->academic_year_id;
        $examcodes = Examcode::where('class_id', $request->class_id)
            ->where('institute_id', Auth::user()->institute_id)
            ->get();
        $examstartups = Examstartup::where('class_id', $request->class_id)
            ->where('institute_id', Auth::user()->institute_id)
            ->get();
        $subjectmaps = Subjectmap::where('institute_id', $request->institute_id)
            ->where('class_id', $request->class_id)
            ->where('group_id', $request->group_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->get();
        // $user_id = User::select('id')->where('institute_id',Auth::user()->institute_id)->first();
        $examconfiges = Examconfig::where('institute_id', Auth::user()->institute_id)
            ->where('class_id', $request->class_id)
            ->where('group_id', $request->group_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->get();
        $users = User::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.exam_management.settings.markconfig.index', compact('users', 'startups', 'examcodes', 'examstartups', 'subjectmaps', 'class_id', 'group_id', 'examconfiges', 'academic_year_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'subjectmap_id' => 'required',
            'examstartups_id' => 'required',
            'examcode_id' => 'required',
            'total_marks' => 'required',
            'pass_mark' => 'required',
            'acceptance' => 'required'
        ]);

        try {
            // $user_id = User::select('id')->where('institute_id',Auth::user()->institute_id)->first();
            foreach ($request->examstartups_id as $examstartups_id) {
                foreach ($request->subjectmap_id as $key => $subjectmap_id) {

                    $input = new Examconfig();

                    $input->institute_id = Auth::user()->institute_id;
                    $input->academic_year_id = $request->academic_year_id;
                    $input->class_id = $request->class_id;
                    $input->group_id = $request->group_id;
                    $input->subjectmap_id = $subjectmap_id;
                    $input->examstartups_id = $examstartups_id;
                    $input->examcode_id = $request->examcode_id[$key];
                    $input->total_marks = $request->total_marks[$key];
                    $input->pass_mark = $request->pass_mark[$key];
                    $input->acceptance = $request->acceptance[$key];
                    $input->save();
                }
            }

            return redirect(route('markconfig'))->with('message', 'Data Upload Successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect(route('markconfig'))->with('error', 'This Subject is already configured.');
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
    public function update(Request $request)
    {
        
        $this->validate($request, [

            'subjectmap_id' => 'nullable',
            'examstartups_id' => 'nullable',
            'examcode_id' => 'nullable',
            'total_marks' => 'nullable',
            'pass_mark' => 'nullable',
            'acceptance' => 'nullable'
        ]);

        try {
                foreach ($request->subjectmap_id as $key => $subjectmap_id) {

                    DB::table('examconfigs')
                        ->where(
                            ['institute_id' => Auth::user()->institute_id,
                            'academic_year_id' => $request->academic_year_id,
                            'class_id'=> $request->class_id,
                            'group_id' => $request->group_id,
                            'subjectmap_id' => $subjectmap_id,
                            'examstartups_id' => $request->examstartups_id[$key],
                            'examcode_id' => $request->examcode_id[$key]]
                        )
                        ->update(
                            ['total_marks' => $request->total_marks[$key],
                            'pass_mark' => $request->pass_mark[$key],
                            'acceptance' => $request->acceptance[$key]]
                        );
                }

            return redirect(route('markconfig'))->with('message', 'Data Upload Successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect(route('markconfig'))->with('error', 'This Subject is already configured.');
            }
        }
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
