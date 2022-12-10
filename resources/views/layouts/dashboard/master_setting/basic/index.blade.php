@extends('school_admin')

@section('content')

    <div id="basic">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#"> Edit Basic Configuration</a> 
                        @if(empty($basics))
                        <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button>
                        @endif
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-sm-1 offset-md-1">
                    <div class="row">
                    
                        <div class="col-sm-6 col-md-6">
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Institute ID</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->institute_id}}" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Institute Name</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->institute_name}}" disabled aria-describedby="textHelp">
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">EIIN Number</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->EIIN_number}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Institute Type</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->institute_type}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Education Board</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->edu_board}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Address</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->address}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Post Office</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->post_office}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Police Station</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->police_station}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">District</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->district}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Division</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->division}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Contact No</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->contact_no}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                            <div class="row left">
                                <div class="col-sm-4 col-md-4">
                                    <label for="exampleInputtext1" class="form-label">Email Address</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="exampleInputtext1" value="{{Auth::user()->email}}" aria-describedby="textHelp" disabled >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="institute_title" class="form-label">Institute Title</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->institute_title}}" id="institute_title" name="institute_title" disabled>
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="web_link" class="form-label">Website Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->web_link}}" id="web_link" name="web_link" disabled>
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="google_map" class="form-label">Google Map</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->google_map}}" id="google_map" name="google_map" disabled>
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="fb_link" class="form-label">Facebook Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->fb_link}}" id="fb_link" name="fb_link" disabled>
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="youtube_link" class="form-label">Youtube Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->youtube_link}}" id="youtube_link" name="youtube_link" disabled>
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="twitter_link" class="form-label">Twitter Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->twitter_link}}" id="twitter_link" name="twitter_link" disabled>
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="insta_link" class="form-label">Instagram Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->insta_link}}" id="insta_link" name="insta_link" disabled>
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="pi_link" class="form-label">Pinterest Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->pi_link}}" id="pi_link" name="pi_link" disabled>
                                        </div>
                                    </div>
                               
                                    
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <!-- <label for="logo" class="form-label">Add New Logo</label> -->
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <img src="{{asset('images/logo/'. $basics->logo)}}" class="rounded" alt="Logo" width="60px" height="60px">
                                        </div>
                                    </div>
                                    
                                    <a class=" btn btn-primary" href="{{route('basic.edit',$basics->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                        Edit
                                    </a>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="basicsModal" tabindex="-1" aria-labelledby="basicsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="basicsModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('basic.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control ist" id="institute_id" value="{{ Auth::user()->institute_id}}" name="institute_id" placeholder="Startup Category">
                            </div>
                            <div class="row right">
                                <div class="col-sm-4 col-md-4">
                                    <label for="institute_title" class="form-label">Institute Title</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="institute_title" name="institute_title">
                                </div>
                            </div>
                            <div class="row right">
                                <div class="col-sm-4 col-md-4">
                                    <label for="web_link" class="form-label">Website Link</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="web_link" name="web_link">
                                </div>
                            </div>
                            <div class="row right">
                                <div class="col-sm-4 col-md-4">
                                    <label for="google_map" class="form-label">Google Map</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="google_map" name="google_map">
                                </div>
                            </div>
                            <div class="row right">
                                <div class="col-sm-4 col-md-4">
                                    <label for="fb_link" class="form-label">Facebook Link</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="fb_link" name="fb_link">
                                </div>
                            </div>
                            <div class="row right">
                                <div class="col-sm-4 col-md-4">
                                    <label for="youtube_link" class="form-label">Youtube Link</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="youtube_link" name="youtube_link">
                                </div>
                            </div>
                            <div class="row right">
                                <div class="col-sm-4 col-md-4">
                                    <label for="twitter_link" class="form-label">Twitter Link</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="twitter_link" name="twitter_link">
                                </div>
                            </div>
                            <div class="row right">
                                <div class="col-sm-4 col-md-4">
                                    <label for="insta_link" class="form-label">Instagram Link</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="insta_link" name="insta_link">
                                </div>
                            </div>
                            <div class="row right">
                                <div class="col-sm-4 col-md-4">
                                    <label for="pi_link" class="form-label">Pinterest Link</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="text" class="form-control" id="pi_link" name="pi_link">
                                </div>
                            </div>
                        
                            
                            <div class="row right">
                                <div class="col-sm-4 col-md-4">
                                    <label for="logo" class="form-label">Add New Logo</label>
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <input type="file" class="form-control" id="logo" name="logo">
                                </div>
                            </div>
                            <button class=" btn btn-primary">
                                <i class="fas fa-plus-circle"></i>
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection