@extends('school_admin')

@section('content')

    <div id="enrollment_auto">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Student Enrollment Form</a> 
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <form action="{{route('enrollment.auto.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="student_table">
                            <input type="text" class="form-control insId" id="institute_id" value="{{Auth::user()->institute_id}}" name="institute_id">
                            <div class="col-sm-10 col-md-10 offset-sm-1 offset-md-1 above_part">
                                <div class="row">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="session_id" class="form-label">Academic Session</label>
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
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="section_id" class="form-label">Section</label>
                                            <select class="form-control single" name="section_id">
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
                                                                    {{$strData->startupsubcategory->startup_subcategory_name}}-{{$strData2->startupsubcategory->startup_subcategory_name}}-{{$strData3->startupsubcategory->startup_subcategory_name}}
                                                                </option>
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="std_category_id" class="form-label">Student Category</label>
                                            <select class="form-control single" name="std_category_id">
                                                <option value=" ">Choose One</option>
                                                @foreach($startups as $startup)
                                                    @if($startup->institute_id == Auth::user()->institute_id)
                                                        @if($startup->startup_category_id == "7")
                                                        <option value="{{$startup->id}}">{{$startup->startupsubcategory->startup_subcategory_name}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="group_id" class="form-label">Group</label>
                                            <select class="form-control single" name="group_id">
                                                <option value=" ">Choose One</option>
                                                @foreach($startups as $startup)
                                                    @if($startup->institute_id == Auth::user()->institute_id)
                                                        @if($startup->startup_category_id == "5")
                                                        <option value="{{$startup->id}}">{{$startup->startupsubcategory->startup_subcategory_name}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row label_part">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label"> Student ID</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="group_id" class="form-label">Roll</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="group_id" class="form-label">Name</label>
                                    </div>
                                </div>
                                <div class="col">
                                <div class="mb-3">
                                    <label for="group_id" class="form-label">Gender</label>
                                </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="group_id" class="form-label">Religion</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="group_id" class="form-label">Father Name</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="group_id" class="form-label">Mother Name</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="group_id" class="form-label">Mobile No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row add">
                                <div class="col">
                                    <input type="text" class="form-control" id="std_id" name="std_id[]" placeholder="Student ID" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control roll" name="roll[]" placeholder="Roll">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control name" name="name[]" placeholder="name">
                                </div>
                                <div class="col">
                                    <select class="form-control gender" name="gender_id[]">
                                        <option value="">Choose Gender</option>
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}">{{$gender->g_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control religion" name="religion_id[]">
                                        <option value="">Choose Religion</option>
                                        @foreach($religions as $religion)
                                            <option value="{{$religion->id}}">{{$religion->r_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="father_name[]" placeholder="father_name">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="mother_name[]" placeholder="mother_name">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="mobile_no[]" placeholder="mobile_no">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                        <a href="javascript:void(0)" class="addstudentRow" style="float:inline-end"><i class="fas fa-plus-circle"></i> Add Student</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection