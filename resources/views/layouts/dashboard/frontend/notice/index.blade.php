@extends('school_admin')

@section('content')

<div id="gallery">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Notice</a>
                    <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#noticeModal">+ Add Notice</button>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Notice Head</th>
                            <th>Description</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notices as $notice)
                            @if($notice->institute_id == Auth::user()->institute_id)
                            <tr>
                                <td>{{$notice->date}}</td>
                                <td>{{$notice->name}}</td>
                                <td>{{$notice->description}}</td>
                                <td>{{$notice->file}}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Add New Notice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('notice.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <div class="form-group">
                            <label for="" class="form-label">Date</label>
                            <input type="date" class="form-control" id="" name="date">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Notice Head / Subject</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Notice Head / Subject">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Notice Description</label>
                            <textarea type="text" rows="15" class="form-control" id="description" name="description" placeholder="Notice Description"></textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-4"><input type="file" name="file"></div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection