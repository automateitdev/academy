@php
    $todate = \Carbon\Carbon::now()->format('Y-m-d');
    $month = \Carbon\Carbon::now()->month;
    $day = \Carbon\Carbon::now()->day;
    $section_assigns = App\Models\SectionAssign::all();
    $feeamounts = App\Models\Feeamount::all();

@endphp

<div class="payment">
    <div class="container">
        <div class="lkjhy">
            <table class="table table-bordered pay-table">
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
                            @foreach($section_assigns as $section_assign)
                                @if($section_assign->id == $student->section_id)
                                    @foreach($feeamounts as $feeam)
                                        @if($student->std_category_id == $feeam->stdcategory_id && $section_assign->class_id == $feeam->class_id)
                                            @foreach($datesetups as $datesetup)
                                                @if($datesetup->class_id == $feeam->class_id && $student->academic_year_id == $datesetup->academic_year_id)
                                                    @php 
                                                        $pa_date = \Carbon\Carbon::parse($datesetup->payable_date)->format('m');
                                                        $pa_day = \Carbon\Carbon::parse($datesetup->payable_date)->format('d');
                                                        
                                                    @endphp
                                                    @if($todate >= $datesetup->payable_date || $pa_date == $month)
                                                    <tr>
                                                        <td>{{$datesetup->feehead->head_name}}</td>
                                                        <td>{{$datesetup->feesubhead->subhead_name}}</td>
                                                        <td class="payable">{{$feeam->feeamount}}</td>
                                                        @if($pa_day > $day)
                                                        <td class="fine">0</td>
                                                        @else
                                                        <td class="fine">{{$feeam->fineamount}}</td>
                                                        @endif
                                                        <td class="waiver">0</td>
                                                        <td class="pay_total"></td>
                                                        </tr>
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
                <div class="col-md-6"></div>
                <!-- <div class="col-md-4"></div> -->
                <div class="col-md-6">
                    <ul class="grandul">
                        <li>Grand Total</li>
                        <li class="grandTotal"></li>
                    </ul>
                </div>
            </div>
            <div class="">
                <a href="{{route('makepayment')}}"><button class="btn-success btn-sm pull-right">Pay Now</button></a>
            </div>
        </div>
    </div>
</div>