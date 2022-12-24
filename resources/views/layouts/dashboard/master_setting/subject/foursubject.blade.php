@extends('school_admin')

@section('content')

<div id="four_subject">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('fourthsubject.index')}}">4th Subject Config</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#subjectadd">+ Add New Subject</button> -->
                </h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-10 ml-5">
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
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @php
                            $active = false;
                            $active_two = false;
                            $active_tt = false;
                            if(empty(Session::get('navtab')))
                            {
                                $active = true;
                            }
                            if(!empty(Session::get('navtab')) && Session::get('navtab') == "nav-assign-tab" ){
                            $active = true;

                            }elseif(!empty(Session::get('navtab')) && Session::get('navtab') == "nav-list-tab"){
                                $active_two = true;
                            }elseif(!empty(Session::get('navtab')) && Session::get('navtab') == "nav-delete-tab"){
                                $active_tt = true;
                            }

                            if($active){
                            $class_name = 'active';
                            }
                            else{
                            $class_name = '';
                            }
                            if($active_two){
                                $class_name_two = 'active';
                            }
                            else{
                                $class_name_two = '';
                            }
                            if($active_tt){
                                $class_name_tt = 'active';
                            }
                            else{
                                $class_name_tt = '';
                            }
                        @endphp
                        <button class="nav-link {{$class_name}}" id="nav-assign-tab" data-bs-toggle="tab" data-bs-target="#nav-assign" type="button" role="tab" aria-controls="nav-assign" aria-selected="true">Assign</button>
                        <button class="nav-link {{$class_name_two}}" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list" aria-selected="false">Assign List</button>
                        <button class="nav-link {{$class_name_tt}}" id="nav-delete-tab" data-bs-toggle="tab" data-bs-target="#nav-delete" type="button" role="tab" aria-controls="nav-delete" aria-selected="false">Delete</button>

                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <!-- assign part -->
                    <div class="tab-pane fade  {{'show '.$class_name}}" id="nav-assign" role="tabpanel" aria-labelledby="nav-assign-tab">
                        <div class="row mt-5">
                            <div class="col-md-8 text-center m-auto">
                                <div class="rkj">
                                    <form action="{{route('fourthsubject.search')}}" method="GET" enctype="multipart/form-data">
                                        <input type="hidden" value="nav-assign-tab" name="nav_tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="section_id" class="form-label">Class-Shift-Section</label>
                                                    <select class="form-control single" name="section_id">
                                                        <option value=" ">Choose One</option>
                                                        @foreach($sectionAssignes as $item)
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
                                                        @if($startup->startup_category_id == "5")
                                                        <option value="{{$startup->id}}">{{$startup->startupsubcategory->startup_subcategory_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Academic Year</label>
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
                                            <div class="col-md-3">
                                                <div class="mb-3 mt-4">
                                                    <button class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">

                                @if(isset($stdudentSubjectMap))
                                <table class="table table-bordered" id="s_table">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Roll No.</th>
                                            <th>Name</th>
                                            <th>Group</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stdudentSubjectMap->unique('student_id') as $stdsubjmap)
                                        <tr>
                                            <td>{{$stdsubjmap->student_id}}</td>
                                            <td>{{$stdsubjmap->student->roll}}</td>
                                            <td>{{$stdsubjmap->student->name}}</td>
                                            <td>{{$stdsubjmap->groupassign->startup->startupsubcategory->startup_subcategory_name}}</td>
                                            <td>
                                                <!-- <a href="{{route('fourthsubject.multiple.edit', $stdsubjmap->id)}}" class="btn btn-primary">Multiple</a> -->
                                                <a href="{{route('fourthsubject.single.edit', $stdsubjmap->student_id)}}" class="btn btn-primary">Assign</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$stdudentSubjectMap->withQueryString()->links('pagination::bootstrap-4')}}
                                @else
                                <p id="des">No data is available! Please fillup all the required fields above and Click on "Search" button.</p>
                                @endif
                                <!-- <button type="submit" class="btn btn-primary "> <i class="fa-solid fa-magnifying-glass"></i> Process</button> -->
                                <!-- <button type="button" class="btn btn-primary searchBtn" data-bs-toggle="modal" data-bs-target="#waiverassignModel">Process</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- assign list -->

                    <div class="tab-pane fade {{'show '.$class_name_two}}" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                        <div class="row mt-5">
                            <div class="col-md-8 text-center m-auto">
                                <div class="rkj">
                                    <form action="{{route('fourthsubject.search')}}" method="GET" enctype="multipart/form-data">
                                        <input type="hidden" value="nav-list-tab" name="nav_tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="section_id" class="form-label">Class-Shift-Section</label>
                                                    <select class="form-control single" name="section_id">
                                                        <option value=" ">Choose One</option>
                                                        @foreach($sectionAssignes as $item)
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
                                                        @if($startup->startup_category_id == "5")
                                                        <option value="{{$startup->id}}">{{$startup->startupsubcategory->startup_subcategory_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Academic Year</label>
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
                                            <div class="col-md-3">
                                                <div class="mb-3 mt-4">
                                                    <button class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">

                                @if(isset($stdudentSubjectMap))
                                <table class="table table-bordered" id="s_table">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Roll No.</th>
                                            <th>Name</th>
                                            <th>Group</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stdudentSubjectMap->unique('student_id') as $stdsubjmap)
                                        <tr>
                                            <td>{{$stdsubjmap->student_id}}</td>
                                            <td>{{$stdsubjmap->student->roll}}</td>
                                            <td>{{$stdsubjmap->student->name}}</td>
                                            <td>{{$stdsubjmap->groupassign->startup->startupsubcategory->startup_subcategory_name}}</td>
                                            <td>
                                                <!-- <a href="{{route('fourthsubject.multiple.edit', $stdsubjmap->id)}}" class="btn btn-primary">Multiple</a> -->
                                                <a href="{{route('allsubject.view', $stdsubjmap->student_id)}}" class="btn btn-primary">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$stdudentSubjectMap->withQueryString()->links('pagination::bootstrap-4')}}
                                @else
                                <p id="des">No data is available! Please fillup all the required fields above and Click on "Search" button.</p>
                                @endif
                                <!-- <button type="submit" class="btn btn-primary "> <i class="fa-solid fa-magnifying-glass"></i> Process</button> -->
                                <!-- <button type="button" class="btn btn-primary searchBtn" data-bs-toggle="modal" data-bs-target="#waiverassignModel">Process</button> -->
                            </div>
                        </div>
                    </div>
                    <!-- delete -->
                    <div class="tab-pane fade {{'show '.$class_name_tt}}" id="nav-delete" role="tabpanel" aria-labelledby="nav-delete-tab">
                        <input type="hidden" value="nav-delete-tab" name="nav_tab">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php 
Session::forget('navtab');
@endphp
@endsection