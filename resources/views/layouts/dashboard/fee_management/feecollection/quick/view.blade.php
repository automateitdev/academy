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
            <div class="col-sm-10 col-md-10 offset-md-1">
                <div class="row upi">
                    <div class="col-md-3">
                        <figure class="figure">
                            <img src="{{asset('images/no-img.jpg')}}" class="figure-img img-fluid rounded" alt="..." width="150px" height="150px">
                            <figcaption class="figure-caption text-center">Student ID</figcaption>
                            <p class="text-center">{{$students->std_id}}</p>
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <table class="std_table">
                            <tbody>
                                <tr>
                                    <td>Student's Name</td>
                                    <td>:</td>
                                    <td>{{$students->name}}</td>
                                </tr>
                                <tr>
                                    <td>Student Roll</td>
                                    <td>:</td>
                                    <td>{{$students->roll}}</td>
                                </tr>
                                <tr>
                                    <td>Section</td>
                                    <td>:</td>
                                    <td>{{$students->sectionstartups->startupsubcategory->startup_subcategory_name}}</td>
                                </tr>
                                <tr>
                                    <td>Group</td>
                                    <td>:</td>
                                    <td>{{$students->groupstartups->startupsubcategory->startup_subcategory_name}}</td>
                                </tr>
                                <tr>
                                    <td>Father's Name</td>
                                    <td>:</td>
                                    <td>{{$students->father_name}}</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>:</td>
                                    <td>{{$students->std_cat_startups->startupsubcategory->startup_subcategory_name}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile No.</td>
                                    <td>:</td>
                                    <td>{{$students->mobile_no}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row upi">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fee Head</th>
                                <th>Fee Sub Head</th>
                                <th>Previous Due</th>
                                <th>Payable</th>
                                <th>Waiver</th>
                                <th>Fine</th>
                                <th>Total Payable</th>
                                <th>Paid</th>
                                <th>Due</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payapplies as $payapplie)
                                @if($payapplie->payment_state == 400 || $payapplie->payment_state == 0 || $payapplie->payment_state == 201)
                                    @if($todate->gte($payapplie->payable_date))
                                    <tr>
                                        <td>{{$payapplie->feehead->head_name}}</td>
                                        <td>{{$payapplie->feesubhead->subhead_name}}</td>
                                        <td>0</td>
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
            </div>
        </div>
    </div>
</div>

@endsection