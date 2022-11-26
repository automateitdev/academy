@extends('school_admin')

@section('content')
<div class="mainloader d-none" id="mainloader">
    @include('layouts.loader.index')
</div>
<div id="examstartup">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Admit Card & Seat Card</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#aboutModel">+ Add Content</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-admitcard-tab" data-bs-toggle="tab" data-bs-target="#nav-admitcard" type="button" role="tab" aria-controls="nav-admitcard" aria-selected="false">Admit Card</button>
                        <button class="nav-link" id="nav-seatcard-tab" data-bs-toggle="tab" data-bs-target="#nav-seatcard" type="button" role="tab" aria-controls="nav-seatcard" aria-selected="true">Seat Card</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <!-- Admit card start -->
                    <div class="tab-pane fade show active" id="nav-admitcard" role="tabpanel" aria-labelledby="nav-admitcard-tab">
                        <div class="row">
                            <div class="col-md-7 offset-md-2">
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
                                @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                                @endif
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="rkj">
                                    <p>Admit Card</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="section_id" class="form-label">Class-Shift-Section</label>
                                                <select class="form-control single" id="admit_section" name="section_id">
                                                    <option value=" ">Choose One</option>
                                                    @foreach($sectionAssignes as $item)
                                                    @if($item->institute_id == Auth::user()->institute_id)
                                                    @php
                                                    $startup_data = $startups->where('id', $item->class_id);
                                                    $startup_data2 = $startups->where('id', $item->section_id);
                                                    $startup_data3 = $startups->where('id', $item->shift_id);
                                                    @endphp
                                                    @foreach($startup_data as $strData)
                                                    @foreach($startup_data2 as $strData2)
                                                    @foreach($startup_data3 as $strData3)
                                                    <option value="{{$item->id}}">
                                                        {{$strData->startupsubcategory->startup_subcategory_name}}-{{$strData3->startupsubcategory->startup_subcategory_name}}-{{$strData2->startupsubcategory->startup_subcategory_name}}
                                                    </option>
                                                    @endforeach
                                                    @endforeach
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="academic_year_id" class="form-label">Academic Year</label>
                                                <select class="form-control single" name="academic_year_id">
                                                    <option value=" ">Choose One</option>
                                                    @foreach($startups as $startup)
                                                    @if($startup->institute_id == Auth::user()->institute_id)
                                                    @if($startup->startup_category_id == "1")
                                                    <option value="{{$startup->id}}">{{$startup->startupsubcategory->startup_subcategory_name}}</option>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Exam</label>
                                                <select class="form-control single" id="admit_exam" name="exam_id">
                                                    <option value="">Select a Class</option>
                                                    @foreach($startups as $item)
                                                    @if($item->institute_id == Auth::user()->institute_id)
                                                    @if($item->startup_category_id == 11)
                                                    <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="session_id" class="form-label">Session</label>
                                                <select class="form-control single" name="session_id">
                                                    <option value=" ">Choose One</option>
                                                    @foreach($startups as $startup)
                                                    @if($startup->institute_id == Auth::user()->institute_id)
                                                    @if($startup->startup_category_id == "2")
                                                    <option value="{{$startup->id}}">{{$startup->startupsubcategory->startup_subcategory_name}}</option>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Title for left Side</label>
                                                {{-- <input type="text" placeholder="e.g. Class Teacher" class="form-control" name="left_title"> --}}
                                                <select class="form-control single" id="left_sign" name="left_sign">
                                                    <option value="">Select Authority</option>
                                                    @foreach($signs as $sign)
                                                    <option value="{{$sign->id}}">{{$sign->place->name}}</option>
                                                    @endforeach
                                                </select>
                                                <a href="{{route('signature.index')}}" class="btn btn-sm btn-dark my-1">Add New</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Title for Right Side</label>
                                                {{-- <input type="text" placeholder="e.g. Principal" class="form-control" name="right_title"> --}}
                                                <select class="form-control single" id="right_sign" name="right_sign">
                                                    <option value="">Select Authority</option>
                                                    @foreach($signs as $sign)
                                                    <option value="{{$sign->id}}">{{$sign->place->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label">From Roll No.</label>
                                                <input type="number" class="form-control" id="admitForm" name="admitForm">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="" class="form-label">To</label>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="" class="form-label">(Max 50 Student)</label>
                                                <input type="number" class="form-control" id="admitTo" name="admitTo">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary" id="carddownloadBtn"><i class="fa fas fa-file"></i> Generate</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Admit card end -->

                    <!-- Seat card start -->
                    <div class="tab-pane fade" id="nav-seatcard" role="tabpanel" aria-labelledby="nav-seatcard-tab">...</div>
                    <!-- Seat card end -->
                </div>
            </div>

        </div>
    </div>
</div>

@endsection