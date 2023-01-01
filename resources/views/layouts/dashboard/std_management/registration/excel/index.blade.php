@extends('school_admin')

@section('content')

<div id="enrollment_auto">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Student Enrollment Form (Excel)</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">


                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif

                </div>
                <form action="{{route('enrollment.excel.store')}}" method="POST" enctype="multipart/form-data">
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
                                        <select class="form-control single" id="enrollgroup" name="group_id">
                                            <option value=" ">Choose One</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Excel File</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <a class="excel" href="{{route('excel.download')}}"><img src="{{asset('images/excel_img.png')}}" alt=""> <br> Custom File Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-1">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection