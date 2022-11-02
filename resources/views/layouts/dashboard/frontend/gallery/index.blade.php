@extends('school_admin')

@section('content')

    <div id="gallery">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Gallery</a> 
                        <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#galleryModel">+ Add Gallery</button>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-md-8 offset-sm-1 offset-md-1">      
                    <div class="gkiu">
                        <div class="row">
                        @foreach($galleries as $item)
                            @if($item->institute_id == Auth::user()->institute_id)
                                <div class="col">
                                    <figure class="figure">
                                        <img src="{{asset('images/gallery/'. $item->photo)}}" alt="" width="200px" height="200px">
                                        <figcaption class="figure-caption text-center">
                                            <form method="POST" id="delete-form-{{$item->id}}" 
                                                action="{{route('gallery.delete',$item->id)}}" style="display: none;">
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
                                        </figcaption>
                                    </figure>
                                </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="galleryModel" tabindex="-1" aria-labelledby="galleryModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModelLabel">Add Gallery Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="slider_img" class="form-label">Gallery Image</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    </div>


@endsection