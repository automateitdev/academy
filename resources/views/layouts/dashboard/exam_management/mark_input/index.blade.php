@extends('school_admin')

@section('content')

<div id="mark_config">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('markinput')}}">Mark Input</a>
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
                                            <label for="" class="form-label">Group</label>
                                            <select class="form-control single subjectgroup" name="group_id">
                                                <option value="">Choose One</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
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
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Exam</label>
                                            <select class="form-control single examnameid" name="examstartup_id" id="">
                                                <option value="">Choose One</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Subject</label>
                                            <select class="form-control single subjectformarkinput" name="subject_id" id="">
                                                <option value="">Choose One</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn mt-4 btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if(isset($examconfigs))
                        
                        <p>{{$subjectName->name}}</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Exam Code Title</th>
                                    <th>Total</th>
                                    <th>Pass Mark</th>
                                    <th>Acceptance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($examconfigs as $examconfig)
                                <tr>
                                    <td>{{$examconfig->examcode->title}}</td>
                                    <td>{{$examconfig->total_marks}}</td>
                                    <td>{{$examconfig->pass_mark}}</td>
                                    <td>{{$examconfig->acceptance}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

        @if(isset($students) && !empty($students))
       
        <div class="row mt-3">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form action="{{route('markinput.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Roll No.</th>
                                <th>Name</th>
                                @foreach($examconfigs as $examconfig)
                                <th>{{$examconfig->examcode->title}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>{{$student->std_id}}</td>
                                <td>{{$student->roll}}</td>
                                <td>{{$student->name}}</td>
                                @foreach($examconfigs as $examconfig)
                                    <td>
                                        <input type="hidden" name="student_id[]" value="{{$student->std_id}}">
                                        <input type="hidden" name="subjectmap_id" value="{{$subjectId->id}}">
                                        <input type="hidden" name="examstartups_id" value="{{$examstartup_id}}">
                                        <input type="hidden" name="academic_year_id" value="{{$academic_year_id}}">
                                        <input type="hidden" name="class_id" value="{{$class_id}}">
                                        <input type="hidden" name="group_id" value="{{$group_id}}">

                                        <input type="text" class="form-control" onkeypress="return /[0-9]/i.test(event.key)"  name="subject[{{$student->std_id}}][{{$examconfig->examcode_id}}]">
                                    </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary mb-3" style="float: right;">Save</button>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
        @endif
    </div>
</div>

@endsection