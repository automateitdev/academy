@extends('school_admin')

@section('content')

<div id="startup">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('subject.index')}}">Subject Config</a>
                    <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#subjectadd">+ Add New Subject</button>
                </h2>
            </div>
        </div>
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
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
        <form action="{{route('subjectadd.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="subject_table">
                <div class="row mt-3">
                    <div class="col-md-6 d-flex" style="margin: 0 auto;">
                        <div class="rkj">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Class</label>
                                        <select class="form-control single subjectClass" name="class_id">
                                            <option value="">Select a Class</option>
                                            @foreach($startups as $item)
                                            @if($item->startup_category_id == 4)
                                            <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Group</label>
                                        <select class="form-control single subjectgroup" name="group_id">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5 text-center">
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Subject</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Subject Type</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Subject Serial</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Marge ID</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Action</label>
                        </div>
                    </div>
                </div>
                <div class="row add mb-3">
                    <div class="col">
                        <select name="subject_id[]" class="selectall">
                            <option value="">Choose Subject</option>
                            @foreach($subjects as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="type[]" id="" class="selectall">
                            <option value="">Choose Type</option>
                            @foreach($subjecttypes as $subjecttype)
                            @if($subjecttype->id != 5)
                            <option value="{{$subjecttype->id}}">{{$subjecttype->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" onkeypress="return /[0-9]/i.test(event.key)" class="form-control" name="serial[]" placeholder="1">
                    </div>
                    <div class="col">
                        <input type="text" onkeypress="return /[0-9]/i.test(event.key)" class="form-control" name="merge[]" value="0" placeholder="1">
                    </div>
                    <div class="col text-center">
                        <button class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="btn-content mt-5">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                <a href="javascript:void(0)" class="addsubjecttable btn btn-dark" style="padding:7px; border-radius:4px;"><i class="fas fa-plus-circle"></i> Add Subject</a>
            </div>
        </form>
    </div>
    <!-- Modal cat-->
    <div class="modal fade" id="subjectadd" tabindex="-1" aria-labelledby="subjectaddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subjectaddLabel">Add new subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('subjectadd')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Subject Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection