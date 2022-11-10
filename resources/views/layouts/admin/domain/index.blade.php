@extends('school_admin')

@section('content')

<div id="fee_amount">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Institute Domain Assign</a>
                    <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#userModal">+ Add Domains</button>
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
                                <th scope="col">URL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($domainlists as $domainlist)
                            <tr>
                                <td>{{$domainlist->id}}</td>
                                <td>{{$domainlist->institute_id}}</td>
                                <td>{{$domainlist->url}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Add New Domain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('domain.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Institute Name</label>
                        <select name="institute_id" class="form-control single" id="">
                            <option value=" ">Choose Institute</option>
                            @foreach($users as $user)
                            <option value="{{$user->institute_id}}">{{$user->institute_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Webiste URL</label>
                        <input type="text" class="form-control" name="url" placeholder="URL">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection