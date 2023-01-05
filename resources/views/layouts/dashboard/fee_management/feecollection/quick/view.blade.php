@extends('school_admin')

@section('content')
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

    <div id="quick_collection">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Quick Collection View</a>
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-12">
                    <div class="row upi">
                        <div class="col-md-2">
                            <figure class="figure">
                                <img src="{{ asset('images/no-img.jpg') }}" class="figure-img img-fluid rounded"
                                    alt="..." width="150px" height="150px">
                                <figcaption class="figure-caption text-center">Student ID</figcaption>
                                <p class="text-center">{{ $student->std_id }}</p>
                            </figure>
                        </div>
                        <div class="col-md-4">
                            <table class="std_table">
                                <tbody>
                                    <tr>
                                        <td>Student's Name</td>
                                        <td>:</td>
                                        <td>{{ $student->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Student Roll</td>
                                        <td>:</td>
                                        <td>{{ $student->roll }}</td>
                                    </tr>
                                    <tr>
                                        <td>Section</td>
                                        <td>:</td>
                                        <td>{{ $student->sectionstartups->startupsubcategory->startup_subcategory_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Group</td>
                                        <td>:</td>
                                        <td>{{ $student->groupstartups->startupsubcategory->startup_subcategory_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Father's Name</td>
                                        <td>:</td>
                                        <td>{{ $student->father_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>:</td>
                                        <td>{{ $student->std_cat_startups->startupsubcategory->startup_subcategory_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mobile No.</td>
                                        <td>:</td>
                                        <td>{{ $student->mobile_no }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 px-3 py-2" style="border: 2px groove seagreen; border-radius:5px">

                            <form action="{{ route('quickcollection.process') }}" method="post">
                                @csrf

                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        {{ $error }}
                                    </div>
                                @endforeach

                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif

                                <label for="quickDate" class="text-sm">Pick a date</label>
                                <input type="date" class="form-control" name="quickDate">
                                <br />

                                <label for="recievedPay" class="text-sm">Recieved By</label>
                                <select name="quick_payRecieved" class="form-control">
                                    <option value="1">Choose One</option>
                                    @foreach ($ledgers as $item)
                                        <option value="{{ $item->id }}">{{ $item->ledger_name }}</option>
                                    @endforeach
                                </select>

                                <br />
                                <label class="text-sm">Total Amount</label>
                                <p id="quickCollectionTotal" class="text-bold" style="color: seagreen"></p>

                                <input type="hidden" name='student_id' value="{{ $student->std_id }}">
                                <button class="btn btn-sm btn-primary float-right"><i class="fa fa-inbox"
                                        aria-hidden="true"></i>
                                    Collect</button>

                        </div>
                    </div>
                    <div class="row upi px-3 w-100 table-responsive">


                        <table class="table w-100 table-striped quickTable">
                            <thead>
                                <tr>
                                    <th class="text-sm"> Select </th>
                                    <th class="text-sm">Academic Year</th>
                                    <th class="text-sm">Fee Head</th>
                                    <th class="text-sm">Fee Sub Head</th>
                                    <th class="text-sm">Payable</th>
                                    <th class="text-sm">Fine</th>
                                    <th class="text-sm">Waiver</th>
                                    <th class="text-sm">Previous Paid</th>
                                    <th class="text-sm">Total Payable</th>
                                    <th class="text-sm">To Pay</th>
                                    <th class="text-sm">Due</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($payapplies as $payapplie)
                                    <tr>

                                        <td style="text-align:center; vertical-align:middle">
                                            <input type="checkbox" class="form-check-input payquickcheck" style=""
                                                name="quickCheck[]" id="{{ $payapplie->id }}" value="{{ $payapplie->id }}"
                                                {{ $todate->gte($payapplie->payable_date) ? 'checked' : '' }}> &nbsp;
                                        </td>
                                        @if (isset($payapplie->ye_startup->startupsubcategory->startup_subcategory_name))
                                            <td style="vertical-align:middle">
                                                {{ $payapplie->ye_startup->startupsubcategory->startup_subcategory_name }}
                                            </td>
                                        @else
                                            <td style="vertical-align:middle">NULL</td>
                                        @endif

                                        <td style="vertical-align:middle">{{ $payapplie->feehead->head_name }}</td>
                                        <td style="vertical-align:middle">{{ $payapplie->feesubhead->subhead_name }}
                                        </td>
                                        <td style="vertical-align:middle">{{ $payapplie->payable }}</td>
                                        <td style="vertical-align:middle">{{ $payapplie->fine }}</td>
                                        <td style="vertical-align:middle">{{ $payapplie->waiver_amount }}</td>



                                        @php
                                            if (!empty($payapplie->paid_amount)) {
                                                $prev_paid = json_decode($payapplie->paid_amount, true);
                                                $paid = 0;
                                                foreach ($prev_paid as $qc_pay_info) {
                                                    foreach ($qc_pay_info as $key => $value) {
                                                        if ($key == 'qc_amount') {
                                                            $paid += $value;
                                                        }
                                                    }
                                                }
                                            } else {
                                                $paid = 0;
                                            }
                                        @endphp


                                        <td style="vertical-align:middle">{{ $paid }}</td>


                                        <td style="vertical-align:middle" class="pay_total"
                                            id="totalPayable_view_{{ $payapplie->id }}">
                                            {{ $payapplie->total_amount - $paid }}</td>
                                        <input type="hidden" name="totalPayable[]" id="totalPayable_{{ $payapplie->id }}"
                                            value={{ $payapplie->total_amount - $paid }} disabled=true>



                                        <td style="vertical-align:middle"><input type="number"
                                                class="form-control text-center amount_to_pay" style="min-width: 100px;"
                                                name="quick_payTotal[]" min="1"
                                                max="{{ $payapplie->total_amount - $paid }}"
                                                id="amount_{{ $payapplie->id }}"
                                                value="{{ $payapplie->total_amount - $paid }}" disabled=true></td>


                                        <td style="vertical-align:middle" class="amountDue"
                                            id="amountDue_view_{{ $payapplie->id }}">
                                            0
                                        </td>
                                        <input type="hidden" name="amountDue[]" id="amountDue_{{ $payapplie->id }}"
                                            value="0" disabled=true>

                                    </tr>
                                    @php
                                        $tmp_data['feehead_id'] = isset($tmp_data['feehead_id']) ? $tmp_data['feehead_id'] : '';
                                        $tmp_data['feehead_id'] = $payapplie->feehead_id;
                                        
                                        $tmp_data['feesubhead_id'] = isset($tmp_data['feesubhead_id']) ? $tmp_data['feesubhead_id'] : '';
                                        $tmp_data['feesubhead_id'] = $payapplie->feesubhead_id;
                                        
                                        array_push($tableData, $tmp_data);
                                    @endphp
                                @endforeach



                            </tbody>
                        </table>

                        </form>
                        <p id="quickCollectionTotal"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
