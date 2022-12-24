@extends('school_admin')

@section('content')

<div id="tabulation">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('tabulation')}}">Tabulation Sheet</a>
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

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Class-Shift-Section</label>
                                        <select class="form-control single" id="tabulationClass" name="class_id">
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
                                            <label for="" class="form-label">Group</label>
                                            <select class="form-control single tabulesubjectgroup" name="group_id">
                                                <option value="">Choose One</option>
                                            </select>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Exam</label>
                                        <select class="form-control single tabuleexamnameid" name="examstartup_id" id="">
                                            <option value="">Choose One</option>
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
                            <button class="btn mt-4 btn-primary" id="tabulationGenerate">Process</button>
                                    <button class="btn btn-success mt-4" disabled= true id="tabuleDownload">Download</button>
                            </div>
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