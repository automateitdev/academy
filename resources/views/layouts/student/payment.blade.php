@php
    $in_date = \Carbon\Carbon::now()->format('d-m-Y');
    $todate = \Carbon\Carbon::now()->format('Y-m-d');
    $year = \Carbon\Carbon::now()->year;
    $month = \Carbon\Carbon::now()->month;
    $today = \Carbon\Carbon::now();
    $day = \Carbon\Carbon::now()->day;
    $section_assigns = App\Models\SectionAssign::all();
    $feeamounts = App\Models\Feeamount::all();
    $waivermappings = App\Models\Waivermapping::all();
    $grand = [];
    $tableData = [];
    $waiver = null;
    $tmp_data = [];
@endphp

<div class="payment">
    <div class="container">
        <div class="table-responsive-md">
            <table class="table table-bordered table-striped pay-table">
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
                            <!-- class id from section assign table -->
                            @foreach ($section_assigns as $section_assign)
                                <!-- match student section_id and section assign id find class_id-->
                                @if ($student->section_id == $section_assign->id)
                                    <!-- datesetup data match with section assign class & student academic_year -->
                                    @foreach ($feeamounts->unique('feehead_id') as $feeamount)
                                        @foreach ($datesetups as $datesetup)
                                            @if ($section_assign->class_id == $datesetup->class_id)
                                                @if ($student->academic_year_id == $datesetup->academic_year_id)
                                                    @if ($datesetup->feehead_id == $feeamount->feehead_id)
                                                            @php
                                                                $pa_month = \Carbon\Carbon::parse($datesetup->payable_date)->format('m');
                                                            @endphp
                                                        @if ($todate >= $datesetup->payable_date || $pa_month == $month)
                                                            
                                                            <tr>
                                                                <td>{{ $datesetup->feehead->head_name }}</td>
                                                                <td>{{ $datesetup->feesubhead->subhead_name }}</td>
                                                                <td class="payable">{{ $feeamount->feeamount }}</td>
                                                                @if ($today->lte($datesetup->fineactive_date))
                                                                    <td class="fine">{{ $feeamount->fineamount = 0 }}
                                                                    </td>
                                                                @else
                                                                    <td class="fine">{{ $feeamount->fineamount }}</td>
                                                                @endif
                                                                @foreach ($waivermappings as $waiver_data)
                                                                    @if ($student->std_id == $waiver_data->student_id)
                                                                        @if ($datesetup->feehead_id == $waiver_data->feehead_id)
                                                                            @php
                                                                                $waiver = $waiver_data->amount;
                                                                                $tmp_data['waiver_id'] = isset($tmp_data['waiver_id']) ? $tmp_data['waiver_id'] : '';
                                                                                $tmp_data['waiver_id'] = $waiver_data->waiver_category_id;
                                                                                
                                                                                $tmp_data['waiver_amount'] = isset($tmp_data['waiver_amount']) ? $tmp_data['waiver_amount'] : '';
                                                                                $tmp_data['waiver_amount'] = $waiver_data->amount;
                                                                            @endphp
                                                                            <td class="waiver">{{ $waiver_data->amount }}
                                                                            </td>
                                                                        @else
                                                                            <td class="waiver">0</td>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                <td class="pay_total"></td>
                                                            </tr>
                                                            @php
                                                                
                                                                $payable = $feeamount->feeamount;
                                                                $fine = $feeamount->fineamount;
                                                                $total = $payable + $fine - $waiver;
                                                                array_push($grand, $total);
                                                                
                                                                $tmp_data['feehead_id'] = isset($tmp_data['feehead_id']) ? $tmp_data['feehead_id'] : '';
                                                                $tmp_data['feehead_id'] = $datesetup->feehead_id;
                                                                
                                                                $tmp_data['feesubhead_id'] = isset($tmp_data['feesubhead_id']) ? $tmp_data['feesubhead_id'] : '';
                                                                $tmp_data['feesubhead_id'] = $datesetup->feesubhead_id;
                                                                
                                                                $tmp_data['payable'] = isset($tmp_data['payable']) ? $tmp_data['payable'] : '';
                                                                $tmp_data['payable'] = $feeamount->feeamount;
                                                                
                                                                $tmp_data['fine'] = isset($tmp_data['fine']) ? $tmp_data['fine'] : '';
                                                                $tmp_data['fine'] = $feeamount->fineamount;
                                                                
                                                                array_push($tableData, $tmp_data);
                                                            @endphp
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
        </div>

        <div class="row">
            <!-- <div class="col-md-4"></div> -->
            <ul class="grandul d-flex justify-content-end" style="font-weight:bold; list-style: none">
                <li class="text-warning">Grand Total: &nbsp;</li>
                <li class="grandTotal">
                    <pre> </pre>
                </li>
            </ul>

                @php
                    $erp = array_sum($grand);
                    $tableData = json_encode($tableData);
                @endphp
                <form class="d-flex justify-content-end" action="{{ route('makepayment', ['erp' => $erp, 'tableData' => $tableData]) }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $ins_id }}" name="ins_id">
                    <input type="hidden" value="{{ $std_id }}" name="std_id">
                    <input type="hidden" value="{{ $day }}" name="day">
                    <input type="hidden" value="{{ $year }}" name="year">
                    <input type="hidden" value="{{ $in_date }}" name="date">
                    <button class="btn btn-success float-right">Pay Now</button>
                </form>

        </div>

    </div>
</div>
