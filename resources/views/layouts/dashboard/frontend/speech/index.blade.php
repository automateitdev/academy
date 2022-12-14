@extends('school_admin')

@section('content')

<div id="speech">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Speech Info</a>
                    @if(count($speeches) < 2) <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#speechModal">+ Add Speech</button>
                        @endif
                </h2>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-10 col-md-10 offset-sm-1 offset-md-1">
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
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
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
                        @foreach($speeches as $key=>$item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->designation}}</td>
                            <td>{{$item->message}}</td>
                            <td><img src="{{asset('images/speech/'. $item->pro_img)}}" alt="" width="100px" height="150px"></td>
                            <td>
                                <a class="svgimg" href="{{route('speech.edit',$item->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
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
                                <input type="text" class="form-control" id="designation" name="designation">
                            </div>
                            <div class="mb-3">
                                <label for="serial" class="form-label">Serial</label>
                                <select name="serial" class="form-control" id="">
                                    <option value="">Choose</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea type="text" rows="10" class="form-control" id="message" name="message" required></textarea>
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