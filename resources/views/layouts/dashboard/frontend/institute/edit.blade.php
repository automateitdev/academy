@extends('school_admin')

@section('content')

<div id="institue">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Edit Institute Image & Description</a>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <form action="{{route('aboutinstitute.update', $aboutinstitue->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="desc" rows="5" aria-label="With textarea" name="description">{{$aboutinstitue->description}}</textarea>
                    </div>
                    <img src="{{asset('images/about_institute/'.$aboutinstitue->image)}}" alt="" width="250px" height="100px">
                    <div class="mb-3 mt-4">
                        <label for="" class="form-label">Add New Institue Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

</div>


@endsection