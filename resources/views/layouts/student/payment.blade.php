@php
    $in_date = \Carbon\Carbon::now()->format('d-m-Y');
    $todate = \Carbon\Carbon::now()->format('Y-m-d');
    $year = \Carbon\Carbon::now()->year;
    $month = \Carbon\Carbon::now()->month;
    $day = \Carbon\Carbon::now()->day;
    $section_assigns = App\Models\SectionAssign::all();
    $feeamounts = App\Models\Feeamount::all();
    $grand = [];
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
                    @foreach ($students as $student)
                        @if ($student->std_id == $std_id && $student->institute_id == $ins_id)
                            @foreach ($section_assigns as $section_assign)
                                @if ($section_assign->id == $student->section_id)
                                    @foreach ($feeamounts->unique('class_id') as $feeam)
                                        @if ($student->std_category_id == $feeam->stdcategory_id && $section_assign->class_id == $feeam->class_id)
                                            @foreach ($datesetups as $datesetup)
                                                @if ($datesetup->class_id == $feeam->class_id && $student->academic_year_id == $datesetup->academic_year_id)
                                                    @php
                                                        $pa_month = \Carbon\Carbon::parse($datesetup->payable_date)->format('m');
                                                        $pa_day = \Carbon\Carbon::parse($datesetup->payable_date)->format('d');
                                                        
                                                    @endphp
                                                    @if ($todate >= $datesetup->payable_date || $pa_month == $month)
                                                        <tr>
                                                            <td>{{ $datesetup->feehead->head_name }}</td>
                                                            <td>{{ $datesetup->feesubhead->subhead_name }}</td>
                                                            <td class="payable">{{ $feeam->feeamount }}</td>
                                                            @if ($pa_day > $day)
                                                                <td class="fine">{{ $feeam->fineamount = 0 }}</td>
                                                            @else
                                                                <td class="fine">{{ $feeam->fineamount }}</td>
                                                            @endif
                                                            <td class="waiver">0</td>
                                                            <td class="pay_total"></td>
                                                        </tr>
                                                        @php
                                                            $payable = $feeam->feeamount;
                                                            $fine = $feeam->fineamount;
                                                            $total = $payable + $fine;
                                                            array_push($grand, $total);
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
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
                        <li>Grand Total</li>
                        <li class="grandTotal"></li>
                    </ul>
                </div>
            </div>
            <div class="">
                @php
                    $erp = array_sum($grand);
                @endphp
                <form action="{{ route('makepayment', ['erp' => $erp]) }}" method="POST">
                    @csrf

                    <input type="hidden" value="{{ $std_id }}" name="std_id">
                    <input type="hidden" value="{{ $ins_id }}" name="ins_id">
                    <input type="hidden" value="{{ $day }}" name="day">
                    <input type="hidden" value="{{ $year }}" name="year">
                    <input type="hidden" value="{{ $in_date }}" name="date">
                    <button class="btn btn-success btn-sm pull-right">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
