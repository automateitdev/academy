@extends('school_admin')

@section('content')

    <div id="date_config">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Student Accounts Date Config</a> 
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-md-1">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-assign-tab" data-bs-toggle="tab" data-bs-target="#nav-assign" type="button" role="tab" aria-controls="nav-assign" aria-selected="true">Assign</button>
                            <button class="nav-link" id="nav-update-tab" data-bs-toggle="tab" data-bs-target="#nav-update" type="button" role="tab" aria-controls="nav-update" aria-selected="false">Update</button>
                        </div>
                    </nav>
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
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-assign" role="tabpanel" aria-labelledby="nav-assign-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="rkj">
                                        <p>Date Config Form</p>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            @csrf
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
                                            <div class="mb-3">
                                                <label for="" class="form-label">Fee Head</label>
                                                <select class="form-control feehead_amount" name="feehead_id">
                                                    <option value=" ">Choose One</option>
                                                    @foreach($feeheads as $item)
                                                    @if($item->institute_id == Auth::user()->institute_id)
                                                    <option value="{{$item->id}}">{{$item->head_name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary searchBtn"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="rkj">
                                        <p>Assign Fee Payable & Fine Active Date</p>
                                        <table class="date_assign_table table-bordered">
                                            <colgroup>
                                            <col>
                                            <col>
                                            <col>
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td>Fee Sub Head</td>
                                                    <td>Fee Payable Date</td>
                                                    <td>Fine Active Date</td>
                                                </tr>
                                                <tr>
                                                    <td>April</td>
                                                    <td><input type="date"></td>
                                                    <td><input type="date"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-primary dBtn"> <i class="fa-solid fa-magnifying-glass"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- update start -->
                        <div class="tab-pane fade" id="nav-update" role="tabpanel" aria-labelledby="nav-update-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="rkj">
                                        <p>Date Config Update Form</p>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            @csrf
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
                                            <div class="mb-3">
                                                <label for="" class="form-label">Fee Head</label>
                                                <select class="form-control feehead_amount" name="feehead_id">
                                                    <option value=" ">Choose One</option>
                                                    @foreach($feeheads as $item)
                                                    @if($item->institute_id == Auth::user()->institute_id)
                                                    <option value="{{$item->id}}">{{$item->head_name}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary searchBtn"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="rkj">
                                        <p>Assign Fee Payable & Fine Active Date</p>
                                        <table class="date_assign_table table-bordered">
                                            <colgroup>
                                            <col>
                                            <col>
                                            <col>
                                            </colgroup>
                                            <tbody>
                                                <tr>
                                                    <td>Fee Sub Head</td>
                                                    <td>Fee Payable Date</td>
                                                    <td>Fine Active Date</td>
                                                </tr>
                                                <tr>
                                                    <td>April</td>
                                                    <td><input type="date"></td>
                                                    <td><input type="date"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <button type="submit" class="btn btn-primary dBtn"> <i class="fa-solid fa-magnifying-glass"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection