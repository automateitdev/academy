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
            <div class="col-sm-10 col-md-10">
                <div class="row upi ml-3">
                    <div class="col-md-3">
                        <figure class="figure">
                            <img src="{{asset('images/no-img.jpg')}}" class="figure-img img-fluid rounded" alt="..." width="150px" height="150px">
                            <figcaption class="figure-caption text-center">Student ID</figcaption>
                            <p class="text-center">{{$student->std_id}}</p>
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <table class="std_table">
                            <tbody>
                                <tr>
                                    <td>Student's Name</td>
                                    <td>:</td>
                                    <td>{{$student->name}}</td>
                                </tr>
                                <tr>
                                    <td>Student Roll</td>
                                    <td>:</td>
                                    <td>{{$student->roll}}</td>
                                </tr>
                                <tr>
                                    <td>Section</td>
                                    <td>:</td>
                                    <td>{{$student->sectionstartups->startupsubcategory->startup_subcategory_name}}</td>
                                </tr>
                                <tr>
                                    <td>Group</td>
                                    <td>:</td>
                                    <td>{{$student->groupstartups->startupsubcategory->startup_subcategory_name}}</td>
                                </tr>
                                <tr>
                                    <td>Father's Name</td>
                                    <td>:</td>
                                    <td>{{$student->father_name}}</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>:</td>
                                    <td>{{$student->std_cat_startups->startupsubcategory->startup_subcategory_name}}</td>
                                </tr>
                                <tr>
                                    <td>Mobile No.</td>
                                    <td>:</td>
                                    <td>{{$student->mobile_no}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row upi ml-3">
                    <table class="table table-bordered quickTable">
                        <thead>
                            <tr>
                                <th> Select </th>
                                <th>Academic Year</th>
                                <th>Fee Head</th>
                                <th>Fee Sub Head</th>
                                <th>Payable</th>
                                <th>Fine</th>
                                <th>Waiver</th>
                                <th>Total Payable</th>
                                <th>Paid</th>
                                <th>Due</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payapplies as $payapplie)
                            
                                    <tr>
                                         
                                        <td>
                                            <input type="checkbox" class="form-check-input payquickcheck" name="quickCheck" id="{{$payapplie->id}}" value="{{$payapplie->id}}" {{$todate->gte($payapplie->payable_date) ? "checked" : ""}}>
                                        </td>
                                        @if(isset($payapplie->ye_startup->startupsubcategory->startup_subcategory_name))
                                        <td>{{$payapplie->ye_startup->startupsubcategory->startup_subcategory_name}}</td>
                                        @else
                                        <td>NULL</td>
                                        @endif
                                        <td>{{$payapplie->feehead->head_name}}</td>
                                        <td>{{$payapplie->feesubhead->subhead_name}}</td>
                                        <td>{{$payapplie->payable}}</td>
                                        <td>{{$payapplie->fine}}</td>
                                        <td>{{$payapplie->waiver_amount}}</td>
                                        <td class="pay_total">{{$payapplie->total_amount}}</td>
                                        <td><input type="number" class="form-control text-center" style="min-width: 100px;" name="quick_payTotal" min="1" max="{{$payapplie->total_amount}}"  value="{{$payapplie->total_amount}}"></td>
                                        <td><input type="number" class="form-control text-center" style="min-width: 100px;"></td>
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
                    <p id="quickCollectionTotal"></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
