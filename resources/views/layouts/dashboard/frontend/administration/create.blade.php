@extends('school_admin')

@section('content')

    <div id="about">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Create Administration</a> / <a href="{{route('admns.index')}}">Back</a>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-md-1">
                    <form action="{{route('admns.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="subcat_id" class="form-label">Sub Menu</label>
                                    <select class="form-control" name="subcat_id">
                                        <option value="">Select a Sub Menu</option>
                                            @foreach($subcategories as $item)
                                            @if($item->cat_id == 3)
                                                <option value="{{$item->id}}">{{$item->subcat_name}}</option>
                                            @endif
                                            @endforeach  
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="id_no" class="form-label">ID No.</label>
                                    <input type="text" class="form-control" id="id_no" name="id_no">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nid" class="form-label">NID</label>
                                    <input type="text" class="form-control" id="nid" name="nid" maxlength="18">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="f_name" class="form-label">Father Name</label>
                                    <input type="text" class="form-control" id="f_name" name="f_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="m_name" class="form-label">Mother Name</label>
                                    <input type="text" class="form-control" id="m_name" name="m_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edu" class="form-label">Education</label>
                                    <input type="text" class="form-control" id="edu" name="edu">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="sex" class="form-label">Sex</label>
                                    <input type="text" class="form-control" id="sex" name="sex">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="religion" class="form-label">Religion</label>
                                    <input type="text" class="form-control" id="religion" name="religion">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="blood" class="form-label">Blood Group</label>
                                    <select name="" class="form-control" id="blood">
                                        <option value="0" selected> Choose</option>
                                        @foreach($bloods as $item)
                                        <option value="{{$item->id}}">{{$item->blood}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="join_date" class="form-label">Join Date</label>
                                    <input type="date" class="form-control" id="join_date" name="join_date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Note</label>
                                    <input type="text" class="form-control" id="note" name="note">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>  

@endsection