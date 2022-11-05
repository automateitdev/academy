@extends('school_admin')

@section('content')

<div id="waiver_config">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Student Accounts Waiver Config</a> / <a href="">Gives Waiver</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form action="{{route('waiver.store', $students->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <ul class="edit_ul">
                        <li>Name : {{$students->name}}</li>
                        <li>Student ID : {{$students->std_id}}</li>
                        <li>Roll No. : {{$students->roll}}</li>
                    </ul>
                    <div class="lkoi">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" class="insId" name="student_id" value="{{$students->std_id}}">
                                <div class="mb-3">
                                    <label for="" class="form-label">Fee Head</label>
                                    <select class="form-control single waiver_feehead" name="feehead_id">
                                        <option value=" ">Choose One</option>
                                        @foreach($feeheads as $feehead)
                                        @if($feehead->institute_id == Auth::user()->institute_id)
                                        <option value="{{$feehead->id}}">{{$feehead->head_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-1">
                                <div class="mb-3">
                                    <label for="" class="form-label">Waiver Category</label>
                                    <select class="form-control single" name="waiver_category_id">
                                        <option value=" ">Choose One</option>
                                        @foreach($waivers as $waiver)
                                        @if($waiver->institute_id == Auth::user()->institute_id)
                                        <option value="{{$waiver->id}}">{{$waiver->waiver_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Amount</label>
                                    <input type="text" class="w_am" id="waiver_amount" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Waiver Amount</label>
                                    <input type="text" name="amount" value="">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






@endsection