@extends('school_admin')

@section('content')

<div id="four_subject">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">4th Subject Config</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#subjectadd">+ Add New Subject</button> -->
                </h2>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6 offset-md-1">
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
                <form action="{{route('feeheadremove.store', $students->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <ul class="edit_ul">
                        <li>Name : {{$students->name}}</li>
                        <li>Student ID : {{$students->std_id}}</li>
                        <li>Roll No. : {{$students->roll}}</li>
                    </ul>
                    <div class="rkj">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="insId" name="student_id" value="{{$students->std_id}}">
                                <div class="mb-3">
                                    <label for="" class="form-label">Type</label>
                                    <select class="form-control single" name="feehead_id">
                                        <option value=" ">Choose One</option>
                                       
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Subject</label>
                                    <select class="form-control single" name="feehead_id">
                                        <option value=" ">Choose One</option>
                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection