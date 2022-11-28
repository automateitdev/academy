@extends('school_admin')

@section('content')

<div id="feehead_remove">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Remove Student Fee Head</a>
                    <a href="{{route('fee.remove.index')}}" class="btn btn-default btn-rounded print pull-right"><- Back</a>
                </h2>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-10 offset-md-1">
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
                    <div class="lkoi rkj">
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" class="insId" name="student_id" value="{{$students->std_id}}">
                                <div class="mb-3">
                                    <label for="" class="form-label">Fee Head</label>
                                    <select class="form-control single" name="feehead_id">
                                        <option value=" ">Choose One</option>
                                        @foreach($feeheads as $feehead)
                                        @if($feehead->institute_id == Auth::user()->institute_id)
                                        <option value="{{$feehead->id}}">{{$feehead->head_name}}</option>
                                        @endif
                                        @endforeach
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