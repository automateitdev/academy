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
                                        <form action="">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="academic_year_id" class="form-label">Section</label>
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
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="academic_year_id" class="form-label">Group</label>
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
                                                        <label for="academic_year_id" class="form-label">Category</label>
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
                                                <div class="col-md-6">
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
                                            </div>
                                            <button type="submit" class="btn btn-primary searchBtn"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row down">
                                <div class="col-md-12">
                                    <p>No data is available! Please fillup all the required fields above and Click on "Search" button.</p>
                                    <table class="table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Roll No.</th>
                                                <th>Name</th>
                                                <th>Group</th>
                                                <th>Category</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>202012</td>
                                                <td>101</td>
                                                <td>Imtiaz Maruf</td>
                                                <td>Science</td>
                                                <td>Night Care</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- <button type="submit" class="btn btn-primary "> <i class="fa-solid fa-magnifying-glass"></i> Process</button> -->
                                    <button type="button" class="btn btn-primary searchBtn" data-bs-toggle="modal" data-bs-target="#waiverassignModel">Process</button>
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