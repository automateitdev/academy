@extends('school_admin')

@section('content')

<div id="waiver_config">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Student Accounts Waiver Config</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-md-10 offset-md-1">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-assign-tab" data-bs-toggle="tab" data-bs-target="#nav-assign" type="button" role="tab" aria-controls="nav-assign" aria-selected="true">Assign</button>
                        <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false">Assigned List</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-assign" role="tabpanel" aria-labelledby="nav-assign-tab">
                        <div class="row">
                            <div class="col-md-7 offset-md-2">
                                <div class="rkj">
                                    <p>Waiver Assign Form</p>
                                    <form action="{{route('waiver.search')}}" method="GET" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="section_id" class="form-label">Section</label>
                                                    <select class="form-control single" id="waiver_section" name="section_id">
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
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="group_id" class="form-label">Group</label>
                                                    <select class="form-control single" id="waiver_group" name="group_id">
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="category_id" class="form-label">Category</label>
                                                    <select class="form-control single" id="waiver_cat" name="stdcategory_id">
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
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="academic_year_id" class="form-label">Academic Year</label>
                                                    <select class="form-control single" id="waiver_yr" name="academic_year_id">
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
                                        <button type="submit" class="btn btn-primary" id="searchwaiver"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row down">
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
                                                    <a href="{{route('waiver.edit', $student->id)}}" class="btn btn-primary">
                                                        Process
                                                    </a>
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

                    <!-- assign list start -->
                    <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">...</div>
                </div>
            </div>
        </div>
    </div>
    <!--Waiver Assign Modal -->
    <div class="modal fade" id="waiverassignModel" tabindex="-1" aria-labelledby="waiverassignModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="waiverassignModelLabel">Assign Waiver</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="academic_year_id" class="form-label">Fee Head</label>
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
                                <div class="col-md-5 offset-md-1">
                                    <div class="mb-3">
                                        <label for="academic_year_id" class="form-label">Waiver Category</label>
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
                                        <label for="academic_year_id" class="form-label">Amount</label>
                                        <input type="text" value="1000">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="academic_year_id" class="form-label">Waiver Amount</label>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary searchBtn"> <i class="fa-solid fa-magnifying-glass"></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection