@extends('school_admin')

@section('content')

    <div id="startup">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Startup</a> 

                        <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#startupModalSubCat">+ Add Selector</button>
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#startupModalCat">+ Add Type</button> -->
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 col-md-2"></div>
                <div class="col-sm-8 col-md-8">
                    <form action="{{route('startup.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                                
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="startup_category" class="form-label">Type</label>
                                    <select class="form-control single" id="startup_category" name="startup_category_id">
                                        <option value="">Select a Type</option>
                                        @foreach($startupcats as $stcats)
                                        <option value="{{$stcats->id}}">{{$stcats->startup_category_name}}</option>
                                        @endforeach
                                    </select>
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="startup_subcategory" class="form-label">Select</label>
                                    <select class="form-control single" id="startup_subcategory" multiple="multiple" name="startup_subcategory_id[]">
                                        <option value=" ">Choose One</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" value="" style="visibility: hidden;">
                                <button type="submit" class="btn btn-primary done"><i class="fas fa-plus-circle"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-2 col-md-2"></div>
            </div>
            <div class="row">
                <div class="container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Type</th>
                            <th scope="col">Name</th>
                            <!-- <th scope="col">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($startups as $stup)
                            @if(Auth::user()->institute_id == $stup->institute_id)
                            <tr>
                                <th scope="row">{{$stup->id}}</th>
                                <td>{{$stup->startupsubcategory->startupCategory->startup_category_name}}</td>
                                <td>{{$stup->startupsubcategory->startup_subcategory_name}}</td>
                                <td>
                                <!-- <form method="POST" id="delete-form-{{$stup->id}}" action="{{route('startup.delete',$stup->id)}}" style="display: none;">
                                        @csrf
                                        {{method_field('delete')}}
                                                        
                                    </form>
                                    <button onclick="if(confirm('Are you sure, You want to delete this?')){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{$stup->id}}').submit();
                                        }else{
                                        event.preventDefault();
                                        }
                                        "class="btn" href="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                </td> -->
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal cat-->
        <div class="modal fade" id="startupModalCat" tabindex="-1" aria-labelledby="startupModalCatLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="startupModalCatLabel">Add new option in Startup</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('startup.store_cat')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="startup_category_name" class="form-label">Startup Category</label>
                                <input type="text" class="form-control" id="startup_category_name" name="startup_category_name" placeholder="Startup Category" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal sub cat -->
        <div class="modal fade" id="startupModalSubCat" tabindex="-1" aria-labelledby="startupModalSubCatLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="startupModalSubCatLabel">Add new option in Startup</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('startup.store_subcat')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="startup_category_id" class="form-label">Startup Category</label>
                                <select class="form-control" name="startup_category_id">
                                    <option value="">Choose one</option>
                                        @foreach($startupcats as $stcat)
                                            <option value="{{$stcat->id}}">{{$stcat->startup_category_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="startup_subcategory_name" class="form-label">Startup Subcategory</label>
                                <input type="text" class="form-control" id="startup_subcategory_name" name="startup_subcategory_name" placeholder="Startup SubCategory" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection