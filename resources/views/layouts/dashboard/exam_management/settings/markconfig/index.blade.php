@extends('school_admin')

@section('content')

<div id="mark_config">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('markconfig')}}">Mark Configuration</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
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
                    <form action="{{route('markconfig.search')}}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Class</label>
                                    <select class="form-control single" name="class_id">
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
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        @if(isset($subjectmaps))
        <div class="row">
            <form action="{{route('markconfig.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(!$examconfiges->isEmpty())
                    <div class="row mt-5 text-center">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Subject</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Exam Code Title</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Total Marks</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Pass Mark</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Acceptance</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Exam</label>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    @foreach($examconfiges as $examconfige)
                    <div class="row mt-2">
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" disabled="true" class="form-control" value="{{$examconfige->subjectmap->subject->name}}">
                                <input type="hidden" name="subjectmap_id[]"  class="form-control" value="{{$examconfige->subjectmap_id}}">
                                <input type="hidden" name="examconfig_id[]"  class="form-control" value="{{$examconfige->id}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" disabled="true" class="form-control" value="{{$examconfige->examcode->title}}">
                                <input type="hidden" class="form-control" name="examcode_id[]" value="{{$examconfige->examcode_id}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="total_marks[]" value="{{$examconfige->total_marks}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" class="form-control" value="{{$examconfige->pass_mark}}" name="pass_mark[]">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" class="form-control" value="{{$examconfige->acceptance}}" name="acceptance[]">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" disabled="true" class="form-control" value="{{$examconfige->examstartup->startup->startupsubcategory->startup_subcategory_name}}">
                                <input type="hidden" class="form-control" name="examstartups_id[]" value="{{$examconfige->examstartups_id}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <button class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif



                <input type="hidden" value="{{$class_id}}" name="class_id">
                <input type="hidden" value="{{$group_id}}" name="group_id">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="" class="form-label">Exam</label>
                            <select name="examstartups_id[]" id="" multiple class="form-control single">
                                <option>Choose one</option>
                                @foreach($examstartups as $examstartup)
                                @foreach($startups as $item)
                                @if($examstartup->exam_id == $item->id)
                                @if($item->startup_category_id == 11)
                                <option value="{{$examstartup->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                @endif
                                @endif
                                @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="markconfig_table">
                    <div class="row mt-5 text-center">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Subject</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Exam Code Title</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Total Marks</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Pass Mark</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Acceptance</label>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <div class="row mt-2 text-center add">
                        <div class="col">
                            <div class="mb-3">
                                <select name="subjectmap_id[]" id="" class="form-control selectall">
                                    <option value="">Choose one</option>
                                    @foreach($subjectmaps as $subjectmap)
                                    <option value="{{$subjectmap->id}}">{{$subjectmap->subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <select name="examcode_id[]" id="" class="form-control selectall">
                                    <option value="">Choose one</option>
                                    @foreach($examcodes as $examcode)
                                    <option value="{{$examcode->id}}">{{$examcode->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" onkeypress="return /[0-9]/i.test(event.key)" class="form-control" name="total_marks[]" value="100">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" onkeypress="return /[0-9]/i.test(event.key)" class="form-control" name="pass_mark[]">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" onkeypress="return /[0-9]/i.test(event.key)" class="form-control" value="1" name="acceptance[]">
                            </div>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                </div>
                <div class="btn-content mt-5">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                    <a href="javascript:void(0)" class="addmarkconfig btn btn-dark" style="padding:7px; border-radius:4px;"><i class="fas fa-plus-circle"></i> Add Subject</a>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>

@endsection