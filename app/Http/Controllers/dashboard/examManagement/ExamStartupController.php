<?php

namespace App\Http\Controllers\dashboard\examManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Startup;
use App\Models\Meritprocess;
use App\Models\Examstartup;
use App\Models\Examcode;
use App\Models\Examgrade;
use App\Models\GlobalExamCode;
use App\Models\GlobalGrade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ExamStartupController extends Controller
{
    public function index()
    {
        // Session::put('navtab', $request->nav_tab);

        $users = User::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $meritprocesses = Meritprocess::all();
        $examcodes = Examcode::where('institute_id', Auth::user()->institute_id)->get();
        $examgrades = Examgrade::where('institute_id', Auth::user()->institute_id)->get();
        $globalexamcodes = GlobalExamCode::all();
        $globalgrades = GlobalGrade::all();
        return view(
            'layouts.dashboard.exam_management.settings.examstartup.index',
            compact('users', 'startups', 'meritprocesses', 'examcodes', 'examgrades', 'globalexamcodes', 'globalgrades')
        );
    }

    public function store(Request $request)
    {
        Session::put('navtab', $request->nav_tab);

        $this->validate($request, [
            'class_id' => 'required',
            'exam_id' => 'required',
            'merit_id' => 'required',
        ]);
        // var_dump($request->exam_id);


        try {
            foreach ($request->exam_id as $key => $exam_id) {

                $input = new Examstartup();
                $input->institute_id = Auth::user()->institute_id;
                $input->class_id = $request->class_id;
                $input->exam_id = $exam_id;
                $input->merit_id = $request->merit_id;
                $input->save();
            }
            return redirect(route('examstartup'))->with('message', 'Data Upload Successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect(route('examstartup'))->with('error', 'Exam data is already assign');
            }
        }
    }

    // exam code start
    public function examcode_store(Request $request)
    {
        // dd($request);
        Session::put('navtab', $request->nav_tab);

        $this->validate($request, [
            'class_id' => 'required',
            'globalcode' => 'required'
        ]);

        foreach ($request->globalcode as $key => $globalcode) {

            $input = new Examcode();
            $input->institute_id = Auth::user()->institute_id;
            $input->class_id = $request->class_id;
            $input->title = $globalcode;
            $input->save();
        }
        return redirect(route('examstartup'))->with('message', 'Data Upload Successfully');
    }

    public function examcode_update(Request $request)
    {
        // dd($request);
        Session::put('navtab', $request->nav_tab);

        $exampair =  array_combine($request->examcode_id, $request->title);
        foreach ($exampair as $key => $value) {
            DB::table('examcodes')
                ->where('id', $key)
                ->update(['title' => $value]);
        }
        return redirect(route('examstartup'))->with('message', 'Data Update Successfully');
    }
    // exam code end

    // exam grade
    public function examgrade_store(Request $request)
    {
        Session::put('navtab', $request->nav_tab);

        $grades = implode(',', $request->grade);

        $this->validate($request, [
            'class_id' => 'required',
            'grade' => 'required'
        ]);

        $input = new Examgrade();
        $input->institute_id = Auth::user()->institute_id;
        $input->class_id = $request->class_id;
        $input->grade = $grades;
        $input->save();

        return redirect(route('examstartup'))->with('message', 'Data Upload Successfully');
    }

    public function examgrade_update(Request $request)
    {
        Session::put('navtab', $request->nav_tab);

        
        $grades = [];
        foreach ($request->examgrades_id as $examgrade_id) {
            $grades = array_combine($request->grade_key[$examgrade_id], $request->grade_value[$examgrade_id]);
            
            $output = implode(', ', array_map(
                function ($v, $k) {
                    return sprintf("%s:%s", $k, $v);
                },
                $grades,
                array_keys($grades)
            ));
            
            DB::table('examgrades')
                ->where('id', $examgrade_id)
                ->update(['grade' => $output]);
        }
        return redirect(route('examstartup'))->with('message', 'Data Update Successfully');
    }
    // exam grade

}
