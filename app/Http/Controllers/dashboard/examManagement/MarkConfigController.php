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
        // $examconfiges = Examconfig::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.exam_management.settings.markconfig.index', compact('users', 'startups'));
    }

    public function search(Request $request)
    {
        $class_id = $request->class_id;
        $group_id = $request->group_id;
        $examcodes = Examcode::where('class_id', $request->class_id)
            ->where('institute_id', Auth::user()->institute_id)
            ->get();
        $examstartups = Examstartup::where('class_id', $request->class_id)
            ->where('institute_id', Auth::user()->institute_id)
            ->get();
        $subjectmaps = Subjectmap::where('class_id', $request->class_id)
            ->where('group_id', $request->group_id)
            ->where('institute_id', Auth::user()->institute_id)
            ->get();
        $examconfiges = Examconfig::where('institute_id', Auth::user()->institute_id)
                                ->where('class_id', $request->class_id)
                                ->where('group_id', $request->group_id)
                                ->get();
        $users = User::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        return view('layouts.dashboard.exam_management.settings.markconfig.index', compact('users', 'startups', 'examcodes', 'examstartups', 'subjectmaps', 'class_id', 'group_id', 'examconfiges'));
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
            foreach($request->examstartups_id as $examstartups_id){
                foreach ($request->subjectmap_id as $key=>$subjectmap_id) {
                    // $input = new Examconfig();                 
                    // $input->institute_id = Auth::user()->institute_id;
                    // $input->class_id = $request->class_id;
                    // $input->group_id = $request->group_id;
                    // $input->subjectmap_id = $subjectmap_id;
                    // $input->examcode_id = $request->examcode_id[$key];
                    // $input->total_marks = $request->total_marks[$key];
                    // $input->pass_mark = $request->pass_mark[$key];
                    // $input->acceptance = $request->acceptance[$key];
                    // $input->examstartups_id = $examstartups_id;
                    // $input->save();
                    // try{
                        // dd($request->class_id,$request->group_id,$examstartups_id,$subjectmap_id,$request->examcode_id[$key],$request->total_marks[$key]);
                    $input = Examconfig::updateOrCreate(
                       [
                            'class_id' => $request->class_id,
                            'group_id' => $request->group_id,
                            'subjectmap_id' => $subjectmap_id,
                            'examstartups_id' => $examstartups_id,
                            'examcode_id' => $request->examcode_id[$key]
                       ],
                       [
                            'institute_id' => Auth::user()->institute_id,
                            'class_id' => $request->class_id,
                            'group_id' => $request->group_id,
                            'subjectmap_id' => $subjectmap_id,
                            'examstartups_id' => $examstartups_id,
                            'examcode_id' => $request->examcode_id[$key],
                            'total_marks' => $request->total_marks[$key],
                            'pass_mark' => $request->pass_mark[$key],
                            'acceptance' => $request->acceptance[$key],
                            
                        ]
                    );
                    
//                 }catch(QueryException $e){
// dd($e);
//                 }
                
                }    

            }
            // dd($input);
            return redirect(route('markconfig'))->with('message', 'Data Upload Successfully');
        
        } 
        catch (QueryException $e) {
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
