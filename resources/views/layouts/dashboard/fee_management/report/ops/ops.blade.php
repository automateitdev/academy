@extends('school_admin')

@section('content')

<div id="ops">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('ops.index')}}">OPS Collection</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                </h2>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-7 offset-md-2">
                <div class="rkj">
                    <p>Search OPS Report</p>
                    <form action="{{route('ops.search')}}" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">From</label>
                                <input type="date" class="form-control" name="from">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">To</label>
                                <input type="date" class="form-control" name="to">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-10 offset-md-1">
                @if(isset($payapplies))
                <div class="table-responsive-md">
                    <table class="table table-bordered pay-table">
                        <thead>
                            <tr>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Roll</th>
                                <th>Class-Shift-Section</th>
                                <th>Payment Date</th>
                                <th>Transaction ID</th>
                                <th>Invoice ID</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payapplies->unique('invoice') as $payapplie)
                            @if($payapplie->payment_state == 200)
                            <tr>
                                <td>{{$payapplie->student_id}}</td>
                                @foreach($students as $student)
                                @if($payapplie->student_id == $student->std_id)
                                <td>{{$student->name}}</td>
                                <td>{{$student->roll}}</td>
                                @foreach($sectionassigns as $item)
                                @if($item->id == $student->section_id)
                                @php
                                $startup_data = $startups->where('id', $item->class_id);
                                $startup_data2 = $startups->where('id', $item->section_id);
                                $startup_data3 = $startups->where('id', $item->shift_id);
                                @endphp
                                @foreach($startup_data as $strData)
                                @foreach($startup_data2 as $strData2)
                                @foreach($startup_data3 as $strData3)
                                <td>{{$strData->startupsubcategory->startup_subcategory_name}}-{{$strData3->startupsubcategory->startup_subcategory_name}}-{{$strData2->startupsubcategory->startup_subcategory_name}}</td>
                                @endforeach
                                @endforeach
                                @endforeach
                                @endif
                                @endforeach
                                @endif
                                @endforeach
                                <td>{{$payapplie->updated_at}}</td>
                                <td>{{$payapplie->trx_id}}</td>
                                <td>{{$payapplie->invoice}}</td>
                                @php
                                $total = $payapplies->where('invoice', $payapplie->invoice)->sum('total_amount')
                                @endphp
                                <td>{{$total}}</td>
                                <td style="display: flex;">
                                    <a href="{{route('ops.show',$payapplie->invoice)}}" class="btn btn-primary" style="margin-right:5px;">View
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$payapplies->withQueryString()->links('pagination::bootstrap-4')}}
                @else
                <p id="des">No data is available! Please fillup all the required fields above and Click on "Search" button.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection