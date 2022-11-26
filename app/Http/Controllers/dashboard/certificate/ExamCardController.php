<?php

namespace App\Http\Controllers\dashboard\certificate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SectionAssign;
use App\Models\Startup;
use App\Models\StartupSubcategory;
use App\Models\Student;
use App\Models\Basic;
use App\Models\Signature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNan;

class ExamCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $sectionAssignes = SectionAssign::all();
        $startups = Startup::all();
        $signs = Signature::where('institute_id', Auth::user()->institute_id)->get();
        return view(
            'layouts.dashboard.layout_certificate.download.essentials.index',
            compact('users', 'sectionAssignes', 'startups', 'signs')
        );
    }
  

    public function getStudentForAdmitCard(Request $request)
    {
        // whereBetween('roll', [$request->from, $request->to])
        $institute_id = Auth::user()->institute_id;
        $form = (int)$request->from;
        $to = (int)$request->to;
       
        $data = Student::
            whereBetween('roll', [$form, $to])
            ->join('startups', 'startups.id', '=', 'students.group_id')       
            ->join('startup_subcategories', 'startup_subcategories.id', '=', 'startups.startup_subcategory_id')
            ->where('students.institute_id', $institute_id)
            ->where('students.section_id', $request->section_id)
            ->get(['students.institute_id', 'students.roll', 'students.name', 'students.std_id', 'students.mobile_no', 'startup_subcategories.startup_subcategory_name']);

        $institute_name = User::select('institute_name')->where('institute_id', $institute_id)->first();
        $institute_add = User::select('address')->where('institute_id', $institute_id)->first();
        $institute_logo = Basic::select('logo')->where('institute_id', $institute_id)->first();

        $class_id = SectionAssign::select('class_id')->where('id', $request->section_id)->first();
        $class = Startup::select('startup_subcategory_id')->where('id', $class_id->class_id)->first();
        $class_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $class->startup_subcategory_id)->first();

        if(!empty($request->session_id)){
            $session_id = Startup::select('startup_subcategory_id')->where('id', $request->session_id)->first();
            $session = StartupSubcategory::select('startup_subcategory_name')->where('id', $session_id->startup_subcategory_id)->first();
        }
        $academic_yr_id = Startup::select('startup_subcategory_id')->where('id', $request->academic_yr_id)->first();
        $academic_yr = StartupSubcategory::select('startup_subcategory_name')->where('id', $academic_yr_id->startup_subcategory_id)->first();
        
        $shift_id = SectionAssign::select('shift_id')->where('id', $request->section_id)->first();
        $shift = Startup::select('startup_subcategory_id')->where('id', $shift_id->shift_id)->first();
        $shift_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $shift->startup_subcategory_id)->first();

        $section_id = SectionAssign::select('section_id')->where('id', $request->section_id)->first();
        $section = Startup::select('startup_subcategory_id')->where('id', $section_id->section_id)->first();
        $section_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $section->startup_subcategory_id)->first();

        if (!empty($request->left_sign)) {
            $left_sign = Signature::where(['id' => $request->left_sign, 'institute_id' => $institute_id])->first();
            $left_title = $left_sign->title;
        }

        if (!empty($request->right_sign)) {
            $right_sign = Signature::where(['id' => $request->right_sign, 'institute_id' => $institute_id])->first();
            $right_title = $right_sign->title;
        }
        $startup_subcategory = Startup::select('startup_subcategory_id')->where('id', $request->exam_id)->first();
        $exam_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $startup_subcategory->startup_subcategory_id)->first();
        $data = json_decode($data, true);
        foreach ($data as $key => $arr) {
            $data[$key]['exam_name'] = $exam_name->startup_subcategory_name;
            $data[$key]['class_name'] = $class_name->startup_subcategory_name;
            $data[$key]['session'] =  isset($session) ? $session->startup_subcategory_name : null;  
            $data[$key]['section_name'] = $section_name->startup_subcategory_name;
            $data[$key]['shift_name'] = $shift_name->startup_subcategory_name;
            $data[$key]['academic_yr'] = $academic_yr->startup_subcategory_name;
            $data[$key]['institute_name'] = $institute_name->institute_name;
            $data[$key]['institute_add'] = $institute_add->address;
            $data[$key]['institute_logo'] = $institute_logo->logo;
            $data[$key]['right_title'] = isset($right_sign) ? $right_title : null;
            $data[$key]['left_title'] = isset($left_sign) ? $left_title : null;
            $data[$key]['right_sign'] = isset($right_sign) ? $right_sign->sign : null;
            $data[$key]['left_sign'] = isset($left_sign) ? $left_sign->sign : null;
        }
        $data = json_encode($data);
        return response()->json($data);
    }
    // public function getStudentForAdmitCard(Request $request)
    // {
    // $institute_id = Auth::user()->institute_id;
    // $data = DB::table('students')
    //     ->where('students.institute_id', $institute_id)
    // ->join('startups', 'startups.id', '=', 'students.group_id')
    // ->where('startups.startup_subcategory_id', 'students.group_id')
    // ->join('startup_subcategories', 'startup_subcategories.id', '=', 'startups.startup_subcategory_id')
    // ->where('startup_subcategory_name', 'startup_subcategories.id')
    // ->select('institute_id', 'roll','name','std_id', 'session_id', 'section_id', 'mobile_no','group_id' )

    // ->where('section_id', $request->section_id)
    // ->where('academic_year_id', $request->academic_yr_id)
    // ->whereBetween('roll',[$request->from, $request->to])
    //                     ->get();
    // return response()->json($data);
    // }

    public function admitprint()
    {
        return view('layouts.dashboard.layout_certificate.download.essentials.admitprint');
    }
    // public function getAdmitInfo(Request $request)
    // {

    //     $startup_subcategory = Startup::select('startup_subcategory_id')->where('id', $request->exam_id)->first();
    //     $exam_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $startup_subcategory->startup_subcategory_id)->first();


    //     $academic_yr_id = Startup::select('startup_subcategory_id')->where('id', $request->academic_yr_id)->first();
    //     $academic_yr = StartupSubcategory::select('startup_subcategory_name')->where('id', $academic_yr_id->startup_subcategory_id)->first();

    //     $session_id = Startup::select('startup_subcategory_id')->where('id', $request->std_info[0]['session_id'])->first();
    //     $session = StartupSubcategory::select('startup_subcategory_name')->where('id', $session_id->startup_subcategory_id)->first();

    //     $group_id = Startup::select('startup_subcategory_id')->where('id', $request->std_info[0]['group_id'])->first();
    //     $group = StartupSubcategory::select('startup_subcategory_name')->where('id', $group_id->startup_subcategory_id)->first();

    //     $class_id = SectionAssign::select('class_id')->where('id', $request->std_info[0]['section_id'])->first();
    //     $class = Startup::select('startup_subcategory_id')->where('id', $class_id->class_id)->first();
    //     $class_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $class->startup_subcategory_id)->first();

    //     $section_id = SectionAssign::select('section_id')->where('id', $request->std_info[0]['section_id'])->first();
    //     $section = Startup::select('startup_subcategory_id')->where('id', $section_id->section_id)->first();
    //     $section_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $section->startup_subcategory_id)->first();

    //     $shift_id = SectionAssign::select('shift_id')->where('id', $request->std_info[0]['section_id'])->first();
    //     $shift = Startup::select('startup_subcategory_id')->where('id', $shift_id->shift_id)->first();
    //     $shift_name = StartupSubcategory::select('startup_subcategory_name')->where('id', $shift->startup_subcategory_id)->first();

    //     $institute_name = User::select('institute_name')->where('institute_id', $request->std_info[0]['institute_id'])->first();
    //     $institute_add = User::select('address')->where('institute_id', $request->std_info[0]['institute_id'])->first();
    //     $institute_logo = Basic::select('logo')->where('institute_id', $request->std_info[0]['institute_id'])->first();
    //     $sign = Signature::select('sign')->where('institute_id', $request->std_info[0]['institute_id'])->first();


    //     if (!empty($request->left_sign)) {
    //         $left_sign = Signature::where(['id' => $request->left_sign, 'institute_id' => $request->std_info[0]['institute_id']])->first();
    //         $left_title = $left_sign->title;
    //     }

    //     if (!empty($request->right_sign)) {
    //         $right_sign = Signature::where(['id' => $request->right_sign, 'institute_id' => $request->std_info[0]['institute_id']])->first();
    //         $right_title = $right_sign->title;
    //     }
    //     $additional_info = [
    //         'exam_name' => $exam_name->startup_subcategory_name,
    //         'academic_yr' => $academic_yr->startup_subcategory_name,
    //         'session' => $session->startup_subcategory_name,
    //         'class_name' => $class_name->startup_subcategory_name,
    //         'section_name' => $section_name->startup_subcategory_name,
    //         'group' => $group->startup_subcategory_name,
    //         'shift_name' => $shift_name->startup_subcategory_name,
    //         'institute_name' => $institute_name->institute_name,
    //         'institute_add' => $institute_add->address,
    //         'institute_logo' => $institute_logo->logo,
    //         'left_sign' => isset($left_sign) ? $left_sign->sign : null,
    //         'left_title' => isset($left_title) ? $left_title : null,
    //         'right_sign' => isset($right_sign) ? $right_sign->sign : null,
    //         'right_title' => isset($right_title) ? $right_title : null,
    //         'sign' => $sign->sign,
    //     ];
    //     return $additional_info;
    // }
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
