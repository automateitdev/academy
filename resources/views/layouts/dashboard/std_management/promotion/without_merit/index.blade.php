@extends('school_admin')

@section('content')

<div id="mark_config">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('without_merit.index')}}">Promotion Without Merit Position</a>
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
                        <div class="rkj h-100">
                            <form action="{{route('without_merit.search')}}" method="GET" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Class-Shift-Section</label>
                                            <select class="form-control single" name="class_id">
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
                                    <button class="btn mt-4 btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                    @if(isset($students) && !empty($students))
                    <div class="col-md-6">
                        <div class="rkj">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                    <form action="{{route('without_merit.post')}}" method="POST">
                        @csrf
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
                                <div class="col-md-6">
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
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="section_id" class="form-label">Class-Shift-Section</label>
                                        <select class="form-control single" id="enrollClass" name="section_id">
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
                                        <label for="academic_year_id" class="form-label">Group</label>
                                        <select class="form-control single" name="group_id">
                                            <option value=" ">Choose One</option>
                                            @foreach($startups as $startup)
                                            @if($startup->startup_category_id == "5")
                                            <option value="{{$startup->id}}">{{$startup->startupsubcategory->startup_subcategory_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        @if(isset($students) && !empty($students))
        <div class="row mt-3">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkall" /></th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Group</th>
                            <th>Previous Roll No.</th>
                            <th>New Roll No.</th>
                        </tr>
                    </thead>
                    <tbody id="checkboxes">
                        @foreach($students as $student)
                        <tr>
                            <td><input type="checkbox" value="{{$student->std_id}}" name="std_details[]"></td>
                            <td>{{$student->std_id}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->gender->g_name}}</td>
                            <td>{{$student->groupstartups->startupsubcategory->startup_subcategory_name}}</td>
                            <td>{{$student->roll}}</td>
                            <td>
                                <input type="text" class="form-control" onkeypress="return /[0-9]/i.test(event.key)" name="roll[]">
                                <input type="hidden" name="std_category_id[]" value="{{$student->std_category_id}}">
                                <input type="hidden" name="f_name[]" value="{{$student->father_name}}">
                                <input type="hidden" name="m_name[]" value="{{$student->mother_name}}">
                                <input type="hidden" name="religion_id[]" value="{{$student->religion_id}}">
                                <input type="hidden" name="gender_id[]" value="{{$student->gender_id}}">
                                <input type="hidden" name="mobile_no[]" value="{{$student->mobile_no}}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
        @endif
        </form>
    </div>
</div>

@endsection