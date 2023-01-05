<?php

namespace App\Http\Controllers\dashboard\fee_management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SectionAssign;
use App\Models\Startup;
use App\Models\Student;
use App\Models\GroupAssign;
use App\Models\Payapply;
use App\Models\Quickcollection;
use App\Models\AccountCategory;
use App\Models\AccountGroup;
use App\Models\Ledger;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;

class FeeCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        return view(
            'layouts.dashboard.fee_management.feecollection.quick.index',
            compact('users', 'sectionAssignes', 'startups')
        );
    }

    public function quicksearch(Request $request)
    {
        $this->validate($request, [
            'section_id' => 'required',
            'academic_year_id' => 'required'
        ]);
        $academic_year_id = $request->academic_year_id;
        $users = User::all();
        $startups = Startup::where('institute_id', Auth::user()->institute_id)->get();
        $sectionAssignes = SectionAssign::where('institute_id', Auth::user()->institute_id)->get();
        $groupassigns = GroupAssign::where('institute_id', Auth::user()->institute_id)->get();
        $students = Student::where('section_id', $request->section_id)
            ->where('academic_year_id', $request->academic_year_id)
            ->orderBy('roll', 'asc')
            ->paginate(100);
        return view('layouts.dashboard.fee_management.feecollection.quick.index', compact('users', 'startups', 'sectionAssignes', 'groupassigns', 'students', 'academic_year_id'));
    }



    public function quickprocess(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required',
            'quickDate' => 'required',
            'quickCheck' => 'required',
            'totalPayable' => 'required',
            'quick_payTotal' => 'required',
            'quick_payRecieved' => 'required',
            'amountDue' => 'required',
        ]);

        if (
            count($request->quickCheck) == count($request->totalPayable) &&
            count($request->totalPayable) == count($request->quick_payTotal) &&
            count($request->quick_payTotal) == count($request->amountDue) &&
            count($request->amountDue) == count($request->quickCheck)
        ) {

            $now = Carbon::now();
            $unique_code = $now->format('ymdHis');
            $unique_invoice = 'QC' . Auth::user()->institute_id . substr($request->student_id, -4) . $unique_code;
            $unique_invoice = strtoupper($unique_invoice);

            // Carbon::createFromFormat('Y-m-d H:i:s', $request->qc_date)
            //     ->format('m/d/Y');

            foreach ($request->quickCheck as $key => $payapplyId) {
                $payappliesInfo =  Payapply::where('id', $payapplyId)->first();
                $prev_paid = [];

                if ($request->quick_payTotal[$key] <= $payappliesInfo->total_amount) {

                    $prev_paid_total = 0;
                    if (!empty($payappliesInfo->paid_amount)) {
                        $prev_paid = json_decode($payappliesInfo->paid_amount, true);
                        foreach ($prev_paid as $qc_pay_info) {
                            foreach ($qc_pay_info as $qc_key => $value) {
                                if ($qc_key == 'qc_amount') {
                                    $prev_paid_total += $value;
                                }
                            }
                        }
                        // $prev_paid_total = array_sum($prev_paid);
                        $total_amount = $prev_paid_total + $request->quick_payTotal[$key] + $request->amountDue[$key];

                        if ($payappliesInfo->total_amount == $total_amount) {
                            $prev_paid[$unique_invoice]['qc_amount'] = $request->quick_payTotal[$key];
                            // array_push($prev_paid, $request->quick_payTotal[$key]);
                        } else {
                            return redirect()->back()->with('error', 'Total Amount Mismatch on 1' . $payapplyId);
                        }
                    } else {

                        $total_amount = $request->quick_payTotal[$key] + $request->amountDue[$key];

                        if ($payappliesInfo->total_amount == $total_amount) {
                            $prev_paid[$unique_invoice]['qc_amount'] = $request->quick_payTotal[$key];
                        } else {
                            return redirect()->back()->with('error', 'Total Amount Mismatch on 2' . $payapplyId);
                        }
                    }

                    $amountDue = $payappliesInfo->total_amount - ($prev_paid_total + $request->quick_payTotal[$key]);
                    if ($amountDue == $request->amountDue[$key]) {
                        try {
                            if ($amountDue == 0) {
                                $paymentState = 10;
                            } else {
                                $paymentState = 11;
                            }

                            $prev_paid[$unique_invoice]['qc_date'] = $request->quickDate;
                            $prev_paid[$unique_invoice]['qc_recieved_to'] = $request->quick_payRecieved;
                            // dd($prev_paid);
                            $prev_paid = json_encode($prev_paid);
                            $update = Payapply::where('id', $payapplyId)->update(
                                [
                                    'paid_amount' => $prev_paid,
                                    'due_amount' => $amountDue,
                                    'payment_state' => $paymentState
                                ]
                            );
                        } catch (\Illuminate\Database\QueryException $e) {
                            return redirect()->back()->with('error', 'Something went wrong, please try again later!');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Due Mismatch on' . $payapplyId);
                    }
                } else {
                    return redirect()->back()->with('error', 'Total Amount Mismatch on' . $payapplyId);
                }
            }
            // success
            return redirect()->back()->with('message', 'Quick Collection Updated for Student ID:' . $request->student_id);
        } else {
            return redirect()->back()->with('error', 'Unwanted Inputs detected');
        }
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

    public function getStudentdata(Request $request)
    {
        $data = Student::select('std_id', 'roll', 'name', 'group_id', 'std_category_id', 'id')->where('section_id', $request->id)->take(100)->get();
        return response()->json($data);
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
        $student = Student::find($id);
        $users = User::all();
        $ledgers = Ledger::where('institute_id', Auth::user()->institute_id)
            ->whereIn('account_subcat_id', [1, 2, 3])
            ->get();
        $payapplies = Payapply::where('institute_id', Auth::user()->institute_id)
            ->where('student_id', $student->std_id)
            ->whereNotIn('payment_state', [200, 10, 3])
            // ->where('payment_state', '!=', "200")
            // ->where('payment_state', '!=', "10")
            ->get();

        return view(
            'layouts.dashboard.fee_management.feecollection.quick.view',
            compact(
                'student',
                'users',
                'payapplies',
                'ledgers'
            )
        );
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
