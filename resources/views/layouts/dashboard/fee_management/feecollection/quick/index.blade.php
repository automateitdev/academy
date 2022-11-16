@extends('school_admin')

@section('content')

    <div id="quick_collection">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Quick Collection</a> 
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-10 offset-md-1">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-section-tab" data-bs-toggle="tab" data-bs-target="#nav-section" type="button" role="tab" aria-controls="nav-section" aria-selected="true">Section Wise</button>
                            <button class="nav-link" id="nav-student-tab" data-bs-toggle="tab" data-bs-target="#nav-student" type="button" role="tab" aria-controls="nav-student" aria-selected="false">Student ID Wise</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-section" role="tabpanel" aria-labelledby="nav-section-tab">
                            <div class="row">
                                <div class="col-md-4 offset-md-4">
                                    <div class="rkj">
                                        <div class="mb-3">
                                            <label for="section_id" class="form-label">Section</label>
                                            <select class="form-control single quick_student" name="section_id">
                                                <option value=" " selected>Choose One</option>
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
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="dju">
                                        <p>Student list</p>
                                        <table class="table table-bordered quickCollection">
                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Roll No</th>
                                                    <th>Name</th>
                                                    <th>Group</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>01923</td>
                                                    <td>101</td>
                                                    <td>Imtiaz maruf</td>
                                                    <td>Science</td>
                                                    <td>General</td>
                                                    <td><a href="#"><button class="btn btn-primary">view</button></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- student id wise -->
                        <div class="tab-pane fade" id="nav-student" role="tabpanel" aria-labelledby="nav-student-tab">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection