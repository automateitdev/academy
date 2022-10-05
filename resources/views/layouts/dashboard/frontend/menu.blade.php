@extends('school_admin')

@section('content')

    <div id="menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-list-ul"></i>  Menu List</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="far fa-edit"></i>  Add Menu</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="far fa-edit"></i>  Add Sub Menu</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <!-- Menu -->
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="table_house">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Sub Menu</th>
                                        <th scope="col">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $cat)
                                            <tr>
                                                <th scope="row">{{$cat->id}}</th>
                                                <td>{{$cat->name}}</td>
                                                <td>
                                                @foreach($subcategories as $subcat)
                                                    @if($cat->id == $subcat->cat_id)
                                                        <p>{{$subcat->subcat_name}}</p>
                                                    @endif
                                                @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Category -->
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form_house">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="link_name" class="form-label">External Link</label>
                                                <input type="text" class="form-control" id="link_name" name="link_name">
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Sub Category -->
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <form action="{{route('subcategory.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form_house">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="subcat_name" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="subcat_name" name="subcat_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="subcat_link" class="form-label">External Link</label>
                                                <input type="text" class="form-control" id="subcat_link" name="subcat_link">
                                            </div>
                                            <div class="mb-3">
                                                <label for="cat_id" class="form-label">Parent Menu</label>
                                                <select class="form-control" name="cat_id">
                                                    <option value="">Select a Menu</option>
                                                        @foreach($categories as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection