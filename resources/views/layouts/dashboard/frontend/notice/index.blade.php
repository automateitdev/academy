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
                            <td>
                                <form method="POST" id="delete-form-{{$notice->id}}" action="{{route('notice.delete',$notice->id)}}" style="display: none;">
                                    @csrf
                                    {{method_field('delete')}}

                                </form>
                                <button onclick="if(confirm('Are you sure, You want to delete this?')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{$notice->id}}').submit();
                                                }else{
                                                event.preventDefault();
                                                }
                                                " class="btn danger" href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                </button>
                            </td>
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