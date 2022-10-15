@extends('school_admin')

@section('content')

    <div id="about">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">About</a> 
                        <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#aboutModel">+ Add Content</button>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-md-1">
                    <div class="data_part">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sub Category</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($abouts as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->subcategories->sucat_name}}</td>
                                <td>{{$item->message}}</td>
                                <td><img src="{{asset('images/about/'. $item->about_img)}}" alt="" width="100px" height="100px"></td>
                                <td>
                                    <a class="svgimg" href="{{route('about.edit',$item->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" id="delete-form-{{$item->id}}" 
                                            action="{{route('about.delete',$item->id)}}" style="display: none;">
                                            @csrf
                                            {{method_field('delete')}}
                                            
                                    </form>
                                    <button onclick="if(confirm('Are you sure, You want to delete this?')){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{$item->id}}').submit();
                                        }else{
                                        event.preventDefault();
                                        }
                                        "class="btn danger" href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="aboutModel" tabindex="-1" aria-labelledby="aboutModelLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="aboutModelLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('about.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control insId" value="{{Auth::user()->institute_id}}" id="institute_id" name="institute_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="subcat_id" class="form-label">Sub Menu</label>
                                <select class="form-control" name="subcat_id">
                                    <option value="">Select a Sub Menu</option>
                                        @foreach($subcategories as $item)
                                         @if($item->cat_id == 2)
                                            <option value="{{$item->id}}">{{$item->subcat_name}}</option>
                                         @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">message</label>
                                <input type="text" class="form-control" id="message" name="message">
                            </div>
                            <div class="mb-3">
                                <label for="about_img" class="form-label">Photo</label>
                                <input type="file" class="form-control" id="about_img" name="about_img">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  

@endsection