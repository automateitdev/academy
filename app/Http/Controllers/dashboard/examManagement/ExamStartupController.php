<?php

namespace App\Http\Controllers\dashboard\examManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\Meritprocess;
use App\Models\Examstartup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ExamStartupController extends Controller
{
    public function index()
    {
        $users = User::all();
        $startups = Startup::all();
        $meritprocesses = Meritprocess::all();
        return view('layouts.dashboard.exam_management.settings.examstartup.index', compact('users','startups','meritprocesses'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'class_id'=> 'required',
            'exam_id'=> 'required',
            'merit_id'=> 'required',
        ]);
        // var_dump($request->exam_id);
        
            
            try{
                foreach ($request->exam_id as $key => $exam_id) {
           
                    $input = new Examstartup();
                    $input->institute_id = Auth::user()->institute_id;
                    $input->class_id = $request->class_id;
                    $input->exam_id = $exam_id;
                    $input->merit_id = $request->merit_id;
                    $input->save();
                }
                return redirect(route('examstartup'))->with('message', 'Data Upload Successfully');
              }
              catch (QueryException $e){
                  $errorCode = $e->errorInfo[1];
                  if($errorCode == 1062){
                    return redirect(route('examstartup'))->with('error', 'Exam data is already assign');
                  }
              }
            
    }
}
