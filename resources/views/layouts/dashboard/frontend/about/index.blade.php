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