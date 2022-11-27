@extends('school_admin')

@section('content')

    <div id="fee_mapping">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">OPS Collection</a> 
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                    </h2>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-10 offset-md-1">
                <div class="table-responsive-md">
            <table class="table table-bordered table-striped pay-table">
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
                   @foreach($payapplies as $payapplie)
                    @if($payapplie->institute_id == Auth::user()->institute_id)
                        @if($payapplie->payment_state == 200)
                            <tr>
                                <td>{{$payapplie->student_id}}</td>
                                <td>{{$payapplie->}}</td>
                                <td>{{$payapplie->}}</td>
                                <td>{{$payapplie->updated_at}}</td>
                                <td>{{$payapplie->invoice}}</td>
                                <td>{{$payapplie->feehead->head_name}}</td>
                                <td>{{$payapplie->total_amount}}</td>
                                <td>Success</td>
                                <td>
                                    <button class="btn btn-success" value="{{$payapplie->invoice}}" id="payreportpdfGenerate">
                                    View</button>
                                </td>
                            </tr>
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