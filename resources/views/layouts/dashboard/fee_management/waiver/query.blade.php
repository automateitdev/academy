@extends('school_admin')

@section('content')

<div id="waiver_config">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Student Accounts Waiver Config</a> / <a href="">Students</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 col-md-10 offset-md-1">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Roll No.</th>
                            <th>Name</th>
                            <th>Group</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            @if($student->institute_id == Auth::user()->institute_id)
                            <tr>
                                <td>{{$student->std_id}}</td>
                                <td>{{$student->roll}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->group_id}}</td>
                                <td>{{$student->std_category_id}}</td>
                                <td><a href="{{route('waiver.edit', $student->id)}}">
                                    Process
                                </a></td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






@endsection