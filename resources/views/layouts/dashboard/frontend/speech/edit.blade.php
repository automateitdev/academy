@extends('school_admin')

@section('content')

    <div id="speech">
        <div class="container">
            <div class="row">
                    <div class="col">
                        <h2 class="mb-25">
                            <a href="#">Edit Speech Info</a> 
                            <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#speechModal">+ Add Speech</button> -->
                        </h2>
                    </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-sm-1 offset-md-1">
                    <form action="{{route('speech.update', $speeches->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$speeches->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" value="{{$speeches->designation}}">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea type="text" class="form-control" id="message" aria-label="With textarea" name="message">{{$speeches->message}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pro_img" class="form-label">Photo</label>
                            <img src="{{asset('images/speech/'. $speeches->pro_img)}}" alt="" width="100px" height="150px">
                        </div>
                        <div class="mb-3">
                            <label for="pro_img" class="form-label">Upload New Photo</label>
                            <input type="file" class="form-control" id="pro_img" name="pro_img">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection