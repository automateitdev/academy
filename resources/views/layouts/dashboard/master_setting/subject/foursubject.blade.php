@extends('school_admin')

@section('content')

<div id="four_subject">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">4th Subject Config</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#subjectadd">+ Add New Subject</button> -->
                </h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-10 ml-5">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-assign-tab" data-bs-toggle="tab" data-bs-target="#nav-assign" type="button" role="tab" aria-controls="nav-assign" aria-selected="true">Assign</button>
                        <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false">Assign List</button>
                        <button class="nav-link" id="nav-delete-tab" data-bs-toggle="tab" data-bs-target="#nav-delete" type="button" role="tab" aria-controls="nav-delete" aria-selected="false">Delete</button>

                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <!-- assign part -->
                    <div class="tab-pane fade show active" id="nav-assign" role="tabpanel" aria-labelledby="nav-assign-tab">
                        <div class="row mt-5">
                            <div class="col-md-8 text-center m-auto">
                                <div class="rkj">
                                    <form action="{{route('fourthsubject.search')}}" method="GET" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="section_id" class="form-label">Class-Shift-Section</label>
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
                                        <div class="row mb-0">
                                            <div class="col-md-3">
                                                <button class="btn btn-primary">Search</button>
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
                                                <a href="{{route('fourthsubject.multiple.edit', $student->id)}}" class="btn btn-primary">Multiple</a>
                                                <a href="{{route('fourthsubject.single.edit', $student->id)}}" class="btn btn-primary">Single</a>
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
                    <!-- assign list -->
                    <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">...</div>
                    <!-- delete -->
                    <div class="tab-pane fade" id="nav-delete" role="tabpanel" aria-labelledby="nav-delete-tab">...</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection