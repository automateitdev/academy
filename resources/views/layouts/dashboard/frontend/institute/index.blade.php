@extends('school_admin')

@section('content')

<div id="institue">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">About Institute</a>
                    @if(empty($aboutinstitue))
                    <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#aboutinstituteModal">+ About Institute</button>
                    @endif
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                @if(isset($aboutinstitue))
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$aboutinstitue->description}}</td>
                            <td><img src="{{asset('images/about_institute/'.$aboutinstitue->image)}}" alt=""></td>
                            <td>
                                <a href="{{route('aboutinstitute.edit', $aboutinstitue->id)}}" class="btn btn-info">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <!--Add Modal -->
    <div class="modal fade" id="aboutinstituteModal" tabindex="-1" aria-labelledby="aboutinstituteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aboutinstituteModalLabel">Add Institue Image and Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('aboutinstitute.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea type="text" class="form-control" id="desc" rows="10" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Institue Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection