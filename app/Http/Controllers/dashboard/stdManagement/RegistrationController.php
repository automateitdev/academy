<?php

namespace App\Http\Controllers\dashboard\stdManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Startup;
use App\Models\Gender;
use App\Models\Religion;
use App\Models\SectionAssign;
use App\Models\User;
use App\Models\StartupSubcategory;
use App\Models\GroupAssign;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use App\Http\Traits\StudentTraits;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    use StudentTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genders = Gender::all();
        $religions = Religion::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $users = User::all();
        return view('layouts.dashboard.std_management.registration.enrollement.auto.index', compact('startups', 'genders', 'religions', 'sectionAssignes', 'users'));
    }

    public function excel_index()
    {
        $genders = Gender::all();
        $religions = Religion::all();
        $startups = Startup::all();
        $sectionAssignes = SectionAssign::all();
        $users = User::all();
        return view('layouts.dashboard.std_management.registration.excel.index', compact('startups', 'genders', 'religions', 'sectionAssignes', 'users'));
    }

    public function getgroupforenrollement(Request $request)
    {
        $startup_id = [];
        $groupname = [];
        $groupassign_id = [];
        $class = SectionAssign::select('class_id')->where('id',$request->id)->first();
        $data = GroupAssign::select('id', 'group_id')->where('class_id', $class->class_id)->get();
        // return $data;
        foreach($data as $d){
            $startups = Startup::select('id', 'startup_subcategory_id')->where('id', $d->group_id)->get();
            
            foreach($startups as $startup)
            {
                array_push($groupassign_id, $startup->id);
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
        $sectionassign_id = SectionAssign::select('section_id')->where('id', $request->section_id)->first();
        $startup_id = Startup::select('id')->where('id', $sectionassign_id->section_id)->first();

        try {

            foreach ($request->roll as $key => $roll) {
                $student = Student::where('institute_id', Auth::user()->institute_id)
                    ->where('std_id', $request->std_id[$key])
                    ->first();

                if (!empty($student)) {

                    return redirect(route('enrollment.auto.index'))->with('error', 'This Student is already registered');
                }
                $input = new Student();
                $input->institute_id = $request->institute_id;
                $input->std_id = $request->std_id[$key];
                $input->academic_year_id = $request->academic_year_id;
                $input->session_id = $request->session_id;
                $input->section_id = $request->section_id;
                $input->std_category_id = $request->std_category_id;
                $input->group_id = $request->group_id;
                $input->roll = $roll;
                $input->name = $request->name[$key];
                $input->gender_id = $request->gender_id[$key];
                $input->religion_id = $request->religion_id[$key];
                $input->father_name = $request->father_name[$key];
                $input->mother_name = $request->mother_name[$key];
                $input->mobile_no = $request->mobile_no[$key];

                if ($input->save()) {
                    $this->assign_fee($request->std_id[$key], $request->institute_id, $request->academic_year_id);
                    $this->assign_subject($request->institute_id, $request->std_id[$key], $request->section_id, $request->group_id, $request->academic_year_id);
                }
                else{
                    return redirect(route('enrollment.auto.index'))->with('error', 'Try again later.');
                }
            }

            return redirect(route('enrollment.auto.index'))->with('message', 'Data Upload Successfully');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect(route('enrollment.auto.index'))->with('error', 'This Student is already registered.');
            }
        }
    }

    public function excel_store(Request $request)
    {
        $request->validate(
            ['file' => ['required', 'file', 'mimes:xlsx']],
            ['file.required' => 'Please upload the file']
        );

        $import = new StudentImport(
            $request->institute_id,
            $request->academic_year_id,
            $request->session_id,
            $request->section_id,
            $request->std_category_id,
            $request->group_id
        );

        // Excel::import($import, $request->file('file'));

        try {
            Excel::import($import, $request->file('file'));

            if (!empty($import)) {
                $arr = Excel::toArray([], $request->file('file'));
                foreach ($arr[0] as $key => $student) {
                    if ($key == 0) {
                        continue;
                    };
                    $this->assign_fee($student[0], $request->institute_id,$request->academic_year_id);
                    $this->assign_subject($request->institute_id, $student[0], $request->section_id, $request->group_id, $request->academic_year_id);
                }
            }

            $error = Session()->get('error');
            if (empty($error)) {
                return redirect(route('enrollment.excel.index'))->with('message', 'Students are added successfully.');
            } else {
                return redirect(route('enrollment.excel.index'))->with('message', 'New students are added (duplicacy ignored).');
            }
        } catch (NoTypeDetectedException $e) {
            // $request->session()->forget('message');
            return redirect(route('enrollment.excel.index'))->with('error', 'Please, Only Upload Excel Sheet');
        }
    }




    public function download()
    {
        $file_path = storage_path('excel_form.xlsx');
        return response()->download($file_path);
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
