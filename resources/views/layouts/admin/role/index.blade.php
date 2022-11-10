@extends('school_admin')

@section('content')

<div id="fee_amount">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">Make Institute</a>
                    <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#userModal">+ Add Role</button>
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
                                <th scope="col">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            @foreach($user->roles as $role)
                            @if($role->pivot->user_id == $user->id && $role->pivot->role_id == $role->id )
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->institute_name}}</td>
                                <td>{{$role->role}}</td>
                            </tr>
                            @endif
                            @endforeach
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
                <h5 class="modal-title" id="userModalLabel">Add New Role of the User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('role.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Institute Name</label>
                        <select name="user_id" class="form-control single" id="">
                            <option value=" ">Choose Institute</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->institute_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Role</label>
                        <select name="role_id" class="form-control single" id="">
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->role}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection