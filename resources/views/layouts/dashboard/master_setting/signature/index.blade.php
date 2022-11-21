@extends('school_admin')

@section('content')

<div id="sign">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Signature</a>

                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#startupModalSubCat">+ Add Selector</button> -->
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#startupModalCat">+ Add Type</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 offset-md-2">
                <div class="rkj">
                    <p>Signature Assign</p>
                    <form action="{{route('signature.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Place At</label>
                                    <select class="form-control single"  name="place_id">
                                        <option value=" ">Choose One</option>
                                        @foreach($places as $place)
                                        <option value="{{$place->id}}">{{$place->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Signature Status</label>
                                    <select class="form-control single" id="status" name="status">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sign" class="form-label">Signature</label>
                                    <input type="file" class="form-control" id="sign" name="sign">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"> Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-10 offset-md-1">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Place At</th>
                            <th>Title</th>
                            <th>Signature</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $i=1;
                        @endphp
                        @foreach($signatures as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->place->name}}</td>
                                <td>{{$item->title}}</td>
                                <td><img src="{{asset('images/sign/'. $item->sign)}}" alt="" width="200px"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection