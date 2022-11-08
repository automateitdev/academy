@php
$in_date = \Carbon\Carbon::now()->format('d-m-Y');
$todate = \Carbon\Carbon::now()->format('Y-m-d');
$year = \Carbon\Carbon::now()->year;
$month = \Carbon\Carbon::now()->month;
$today = \Carbon\Carbon::now();
$section_assigns = App\Models\SectionAssign::all();
$feeamounts = App\Models\Feeamount::all();
$waivermappings = App\Models\Waivermapping::all();
$grand = [];
$tableData = [];
$waiver_amount = null;
@endphp

<div class="payment">
    <div class="container">
        <div class="lkjhy">
            <table class="table table-bordered table-responsive table-striped pay-table">
                <thead>
                    <tr>
                        <th>Fee Head</th>
                        <th>Fee Sub Head</th>
                        <th>Payable</th>
                        <th>Fine</th>
                        <th>Waiver</th>
                        <th>Total Payable</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        @if($student->std_id == $std_id && $student->institute_id == $ins_id)
                            <!-- class id from section assign table -->
                            @foreach($section_assigns as $section_assign)
                                <!-- match student section_id and section assign id find class_id-->
                                @if($student->section_id == $section_assign->id)
                                    <!-- datesetup data match with section assign class & student academic_year -->
                                    @foreach($feeamounts->unique('feehead_id') as $feeamount)
                                        @foreach($datesetups as $datesetup)
                                            @if($section_assign->class_id == $datesetup->class_id)
                                                @if($student->academic_year_id == $datesetup->academic_year_id)
                                                    @if($datesetup->feehead_id == $feeamount->feehead_id)
                                                        @if ($todate >= $datesetup->payable_date || $pa_month == $month)
                                                        @php
                                                            $pa_month = \Carbon\Carbon::parse($datesetup->payable_date)->format('m');
                                                        @endphp
                                                            <tr>
                                                                <td>{{$datesetup->feehead->head_name}}</td>
                                                                <td>{{$datesetup->feesubhead->subhead_name}}</td>
                                                                <td class="payable">{{$feeamount->feeamount}}</td>
                                                                @if ($today->lte($datesetup->fineactive_date))
                                                                <td class="fine">{{ $feeamount->fineamount = 0 }}</td>
                                                                @else
                                                                <td class="fine">{{ $feeamount->fineamount}}</td>
                                                                @endif
                                                                @foreach($waivermappings as $waiver_data)
                                                                    @if($student->std_id == $waiver_data->student_id)
                                                                        @if($datesetup->feehead_id == $waiver_data->feehead_id)
                                                                            <td class="waiver">{{$waiver_data->amount}}</td>
                                                                            @else
                                                                            <td class="waiver">0</td>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                <td class="pay_total"></td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach  
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <!-- <div class="col-md-4"></div> -->
                <div class="col-md-3 offset-9">
                    <ul class="grandul pull-right">
                        <li>Grand Total :</li>
                        <li class="grandTotal"></li>
                    </ul>
                </div>
            </div>
            <div class="">
                @php
                $erp = array_sum($grand) - $waiver_amount;
                $tableData = json_encode($tableData);
                @endphp
                <form action="{{ route('makepayment', ['erp' => $erp, 'tableData'=>$tableData])}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $ins_id }}" name="ins_id">
                    <input type="hidden" value="{{ $std_id }}" name="std_id">
                    <input type="hidden" value="{{ $today }}" name="day">
                    <input type="hidden" value="{{ $year }}" name="year">
                    <input type="hidden" value="{{ $in_date }}" name="date">
                    <button class="btn btn-success btn-sm pull-right">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>