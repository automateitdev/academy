@php
    $in_date = \Carbon\Carbon::now()->format('d-m-Y');
    $todate = \Carbon\Carbon::now();
    $year = \Carbon\Carbon::now()->year;
    $month = \Carbon\Carbon::now()->month;
    $today = \Carbon\Carbon::now();
    $day = \Carbon\Carbon::now()->day;
    $grand = [];
    $tmp_data = [];
    $tableData = [];
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
                   @foreach($payapplies as $payapplie)
                 
                    @if($payapplie->payment_state !== 200 || $payapplie->payment_state !== 3)
                   
                        @if($todate->gte($payapplie->payable_date))
                        <tr>
                            <td>{{$payapplie->feehead->head_name}}</td>
                            <td>{{$payapplie->feesubhead->subhead_name}}</td>
                            <td>{{$payapplie->payable}}</td>
                            <td>{{$payapplie->fine}}</td>
                            <td>{{$payapplie->waiver_amount}}</td>
                            <td class="pay_total">{{$payapplie->total_amount}}</td>
                        </tr>
                                @php
                                    $tmp_data['feehead_id'] = isset($tmp_data['feehead_id']) ? $tmp_data['feehead_id'] : '';
                                    $tmp_data['feehead_id'] = $payapplie->feehead_id;

                                    $tmp_data['feesubhead_id'] = isset($tmp_data['feesubhead_id']) ? $tmp_data['feesubhead_id'] : '';
                                    $tmp_data['feesubhead_id'] = $payapplie->feesubhead_id;      

                                    array_push($tableData, $tmp_data);
                                @endphp
                        @endif
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
                    
                </li>
            </ul>

                @php
                    $erp = array_sum($grand);
                    $tableData = json_encode($tableData);
                @endphp
                <form class="d-flex justify-content-end" action="{{ route('makepayment') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $student->institute_id }}" name="ins_id">
                    <input type="hidden" value="{{ $student->std_id }}" name="std_id">
                    <input type="hidden" value="{{ $day }}" name="day">
                    <input type="hidden" value="{{ $year }}" name="year">
                    <input type="hidden" id="grandTotal" name="grandTotal">
                    <input type="hidden" value="{{$tableData}}" name="tableData">
                    <button class="btn btn-success float-right">Pay Now</button>
                </form>

        </div>

    </div>
</div>
