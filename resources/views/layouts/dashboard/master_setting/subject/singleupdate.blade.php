@extends('school_admin')

@section('content')

<div id="four_subject">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{route('fourthsubject.index')}}">Assign : 4th Subject</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#subjectadd">+ Add New Subject</button> -->
                </h2>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-1"></div>
            <div class="col-md-10">
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

                <form action="{{route('foursubjectupdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="rkj">
                        <div class="row">
                            <div class="col">
                                <label for="form-labe;">Student ID</label>
                            </div>
                            <div class="col">
                                <label for="form-labe;">Student Name</label>
                            </div>
                            <div class="col">
                                <label for="form-labe;">Roll</label>
                            </div>
                            <div class="col">
                                <label for="form-labe;">Subject</label>
                            </div>
                            <div class="col">
                                <label for="form-labe;">Subject Type</label>
                            </div>
                        </div>
                        @foreach($stdSubMaps as $stdSubMap)
                        @if($stdSubMap->subject_type_id == 3)
                        <div class="row mt-2">
                            <div class="col">
                                <input type="hidden"  class="form-control" name="id[]" value="{{$stdSubMap->id}}">
                                <input type="text" disabled="true" class="form-control" value="{{$stdSubMap->student_id}}">
                                <input type="hidden" class="form-control" name="student_id[]" value="{{$stdSubMap->student_id}}">
                            </div>
                            <div class="col">
                                <input type="text" disabled="true" class="form-control" value="{{$stdSubMap->student->name}}">
                            </div>
                            <div class="col">
                                <input type="text" disabled="true" class="form-control" value="{{$stdSubMap->student->roll}}">
                            </div>
                            <div class="col">
                                <input type="text" disabled="true" class="form-control" value="{{$stdSubMap->subjectmap->subject->name}}">
                            </div>
                            <div class="col">
                                <select name="subject_type_id[]" id="" class="single">
                                    <option selected value=" ">Select One</option>
                                    @foreach($subjecttypes as $subtype)
                                    @if($stdSubMap->subject_type_id != $subtype->id 
                                    && $subtype->id != 2
                                    && $subtype->id != 4)
                                    <option value="{{$subtype->id}}">{{$subtype->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <button class="btn btn-primary mt-3">Update</button>
                    </div>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</div>

@endsection