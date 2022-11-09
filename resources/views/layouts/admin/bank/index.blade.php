@extends('school_admin')

@section('content')

<div id="bank">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Add Intitute Bank Info</a>
                    <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#bankinfoModal">+ Add Info</button>
                </h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="shkoi mt-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Institute ID</th>
                                <th scope="col">Institute Name</th>
                                <th scope="col">A/C</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact No.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($baninfos as $baninfo)
                            <tr>
                                <th scope="row">{{$baninfo->id}}</th>
                                <td>{{$baninfo->institute_id}}</td>
                                <td>{{$baninfo->institute_name}}</td>
                                <td>{{$baninfo->account}}</td>
                                <td>{{$baninfo->email}}</td>
                                <td>{{$baninfo->mobile}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="bankinfoModal" tabindex="-1" aria-labelledby="bankinfoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bankinfoModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                    <form action="{{route('bankinfo.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Institute ID</label>
                                    <select name="institute_id" class="form-control single" id="">
                                        <option value=" ">Choose Institute</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->institute_id}}">{{$user->institute_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Institute Name</label>
                                    <input type="text" class="form-control" id="" name="institute_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Account No</label>
                                    <input type="text" class="form-control" id="" name="account">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Contact No</label>
                                    <input type="text" class="form-control" id="" name="mobile">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection