@extends('school_admin')

@section('content')

    <div id="speech">
        <div class="container">
            <div class="row">
                    <div class="col">
                        <h2 class="mb-25">
                            <a href="#">Speech Info</a> 
                            <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#speechModal">+ Add Speech</button>
                        </h2>
                    </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-sm-1 offset-md-1">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Message</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($speeches as $item)
                            @if($item->institute_id == Auth::user()->institute_id)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->designation->designation}}</td>
                                <td>{{$item->message}}</td>
                                <td><img src="{{asset('images/speech/'. $item->pro_img)}}" alt="" width="100px" height="150px"></td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          

            <!-- Modal -->
            <div class="modal fade" id="speechModal" tabindex="-1" aria-labelledby="speechModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="speechModalLabel">Add Teacher's Speech</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('speech.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control insId" value="{{Auth::user()->institute_id}}" id="institute_id" name="institute_id">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <select class="form-control" name="designation_id">
                                        <option value="">Select a Menu</option>
                                            @foreach($designations as $item)
                                            <option value="{{$item->id}}">{{$item->designation}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <input type="text" class="form-control" id="message" name="message" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pro_img" class="form-label">Photo</label>
                                    <input type="file" class="form-control" id="pro_img" name="pro_img">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection