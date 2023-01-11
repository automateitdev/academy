@extends('school_admin')

@section('content')

<div id="mark_config">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('merit_position.index')}}">Merit Position Process</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
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
                            <form action="{{route('markinput.search')}}" method="GET" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Class-Shift-Section</label>
                                            <select class="form-control single" id="subjectClass" name="class_id">
                                                <option selected value="">Select a Class</option>
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
                                                @if($startup->startup_category_id == "1")
                                                <option value="{{$startup->id}}">{{$startup->startupsubcategory->startup_subcategory_name}}</option>
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
                                            <select class="form-control single examnameid" name="examstartup_id" id="">
                                                <option value="">Choose One</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn mt-4 btn-primary">Process</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>

@endsection