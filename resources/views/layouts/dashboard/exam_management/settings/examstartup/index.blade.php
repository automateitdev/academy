@extends('school_admin')

@section('content')

<div id="examstartup">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Exam Startup</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#aboutModel">+ Add Content</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-examcreate-tab" data-bs-toggle="tab" data-bs-target="#nav-examcreate" type="button" role="tab" aria-controls="nav-examcreate" aria-selected="false">Exam Create</button>
                        <button class="nav-link" id="nav-examcode-tab" data-bs-toggle="tab" data-bs-target="#nav-examcode" type="button" role="tab" aria-controls="nav-examcode" aria-selected="true">Exam Code</button>
                        <button class="nav-link" id="nav-examgrade-tab" data-bs-toggle="tab" data-bs-target="#nav-examgrade" type="button" role="tab" aria-controls="nav-examgrade" aria-selected="false">Exam Grade</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <!-- exam code start -->
                    <div class="tab-pane fade" id="nav-examcode" role="tabpanel" aria-labelledby="nav-examcode-tab">...</div>
                    <!-- exam code end -->


                    <!-- exam grade start -->
                    <div class="tab-pane fade" id="nav-examgrade" role="tabpanel" aria-labelledby="nav-examgrade-tab">...</div>
                    <!-- exam grade end -->


                    <!-- exam create start -->
                    <div class="tab-pane fade show active" id="nav-examcreate" role="tabpanel" aria-labelledby="nav-examcreate-tab">
                        <div class="row">
                            <div class="col-md-7 offset-md-2">
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
                                    <p>Exam Assign Form</p>
                                    <form action="{{route('examstartup.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Class</label>
                                                    <select class="form-control" name="class_id">
                                                        <option value="">Select a Class</option>
                                                        @foreach($startups as $item)
                                                        @if($item->institute_id == Auth::user()->institute_id)
                                                        @if($item->startup_category_id == 4)
                                                        <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                                        @endif
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Exam</label>
                                                    <select class="form-control single" multiple="multiple" name="exam_id[]">
                                                        <option value="">Select a Class</option>
                                                        @foreach($startups as $item)
                                                        @if($item->institute_id == Auth::user()->institute_id)
                                                        @if($item->startup_category_id == 11)
                                                        <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
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
                                                    <label for="" class="form-label">Merit process Type</label>
                                                    <select class="form-control single" name="merit_id">
                                                        <option value=" ">Choose One</option>
                                                        @foreach($meritprocesses as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary saveBtn"><i class="fas fa-plus-circle"></i> Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- exam create end -->
                </div>
            </div>

        </div>
    </div>
</div>

@endsection