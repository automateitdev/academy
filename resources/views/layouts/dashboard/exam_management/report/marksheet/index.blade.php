@extends('school_admin')

@section('content')
    <div class="mainloader d-none" id="mainloader">
        @include('layouts.loader.index')
    </div>
    <div id="tabulation">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="{{ route('marksheet') }}">Mark Sheet</a>
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
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <div class="rkj">
                                <form action="{{ route('marksheet.query') }}" method="GET" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Class-Shift-Section</label>
                                                <select class="form-control single" id="markhseetClass" name="class_id">
                                                    <option selected value="">Select a Class</option>
                                                    @foreach ($sectionAssignes as $item)
                                                        @if ($item->institute_id == Auth::user()->institute_id)
                                                            @php
                                                                $startup_data = $startups->where('id', $item->class_id);
                                                                $startup_data2 = $startups->where('id', $item->section_id);
                                                                $startup_data3 = $startups->where('id', $item->shift_id);
                                                            @endphp
                                                            @foreach ($startup_data as $strData)
                                                                @foreach ($startup_data2 as $strData2)
                                                                    @foreach ($startup_data3 as $strData3)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $strData->startupsubcategory->startup_subcategory_name }}-{{ $strData3->startupsubcategory->startup_subcategory_name }}-{{ $strData2->startupsubcategory->startup_subcategory_name }}
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
                                                <select class="form-control single" id="amrkubjectgroup" name="group_id">
                                                    <option value="">Choose One</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">

                                                                                        <div class="mb-3">
                                                <label for="session_id" class="form-label">Academic Session</label>
                                                <select class="form-control single" name="session_id">
                                                    <option value=" ">Choose One</option>
                                                    @foreach ($startups as $startup)
                                                        @if ($startup->institute_id == Auth::user()->institute_id)
                                                            @if ($startup->startup_category_id == '2')
                                                                <option value="{{ $startup->id }}">
                                                                    {{ $startup->startupsubcategory->startup_subcategory_name }}
                                                                </option>
                                                            @endif
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
                                                    @foreach ($startups as $startup)
                                                        @if ($startup->startup_category_id == '1')
                                                            <option value="{{ $startup->id }}">
                                                                {{ $startup->startupsubcategory->startup_subcategory_name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="form-label">Exam</label>
                                                <select class="form-control single" id="msrkexamnameid"
                                                    name="examstartup_id" id="">
                                                    <option value="">Choose One</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">

                                        <button class="btn mt-4 btn-primary">Search</button>
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
            <div class="row mt-3">

                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Roll</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($std_subject_map) && !empty($std_subject_map))
                            @foreach ($std_subject_map->sortBy('student_id')->unique('student_id') as $stdSubjectMap)
                                @foreach ($students as $student)
                                    @if ($stdSubjectMap->student_id == $student->std_id && $stdSubjectMap->institute_id == Auth::user()->institute_id)

                                        <tr>
                                                <input type="hidden" value="{{ $class_id }}" name="class_id" id="class_id">
                                                <input type="hidden" value="{{ $group_id }}" name="group_id" id="group_id">
                                                <input type="hidden" value="{{ $group_name }}" name="group_name" id="group_name">
                                                <input type="hidden" value="{{ $session_name }}" name="session_name" id="session_name">
                                                <input type="hidden" value="{{ $examstartup_id }}" name="examstartup_id" id="examstartup_id">
                                                <input type="hidden" value="{{ $academic_year_id }}" name="academic_year_id" id="academic_year_id">
                                                <input type="hidden" value="{{ $stdSubjectMap->student_id }}" name="std_id" id="std_id">

                                                <td>{{ $stdSubjectMap->student_id }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->roll }}</td>
                                                <td><button class="btn btn-sm btn-primary markProcess" id={{$stdSubjectMap->student_id}}>Process</button> <button class="btn btn-sm btn-dark"  disabled="true" id="marksheet_{{$stdSubjectMap->student_id}}">Download</button></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </tbody>
                </table>
            
            </div>
        </div>
    </div>

@endsection
