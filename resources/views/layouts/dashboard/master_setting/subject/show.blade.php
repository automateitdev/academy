@extends('school_admin')

@section('content')

<div id="startup">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('subject.show')}}">Configured Subject Show</a>
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
        <form action="{{route('subject.show_query')}}" method="GET" enctype="multipart/form-data">
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
                                            <option value="">Choose One</option>

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
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary mt-4">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="btn-content mt-5">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                <a href="javascript:void(0)" class="addsubjecttable btn btn-dark" style="padding:7px; border-radius:4px;"><i class="fas fa-plus-circle"></i> Add Subject</a>
            </div> -->
        </form>
        @if(isset($data) && !empty($data))
        <div class="row mt-5 text-center">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Subject Type</th>
                            <th>Subject Serial</th>
                            <th>Marge ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $subData)
                        <tr>
                            <td>{{$subData->subject->name}}</td>
                            <td>{{$subData->subjecttype->name}}</td>
                            <td>{{$subData->serial}}</td>
                            <td>{{$subData->merge}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
        @endif
    </div>
</div>

@endsection