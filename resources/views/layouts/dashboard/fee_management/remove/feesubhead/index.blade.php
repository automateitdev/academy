@extends('school_admin')

@section('content')

<div id="fee_mapping">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Fee Sub Head Remove</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-md-10 offset-md-1">
                <div class="plJhy">
                    <div class="row mt-2">
                        <div class="col-md-8 offset-md-2">
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
                            <div class="rkj">
                                <form action="{{route('feesubheadsearch')}}" method="GET" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="academic_year_id" class="form-label">Academic Year</label>
                                                <select class="form-control single" name="academic_year_id">
                                                    <option value=" " selected>Choose One</option>
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
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="section_id" class="form-label">Section</label>
                                                <select class="form-control single" id="section_id" name="section_id">
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
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-success">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">

                            @if(isset($students))
                            <table class="table table-bordered" id="s_table">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Roll No.</th>
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    @if($student->institute_id == Auth::user()->institute_id)
                                    <tr>
                                        <td>{{$student->std_id}}</td>
                                        <td>{{$student->roll}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$student->group_id}}</td>
                                        <td>{{$student->std_category_id}}</td>
                                        <td>
                                            <a href="{{route('feesubheadremove', $student->id)}}" class="btn btn-primary">Remove</a>
                                            <a href="{{route('feesubheadassign', $student->id)}}" class="btn btn-primary">Reassign</a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{$students->withQueryString()->links('pagination::bootstrap-4')}}
                            @else
                            <p id="des">No data is available! Please fillup all the required fields above and Click on "Search" button.</p>
                            @endif
                            <!-- <button type="submit" class="btn btn-primary "> <i class="fa-solid fa-magnifying-glass"></i> Process</button> -->
                            <!-- <button type="button" class="btn btn-primary searchBtn" data-bs-toggle="modal" data-bs-target="#waiverassignModel">Process</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection