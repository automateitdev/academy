@extends('school_admin')

@section('content')

    <div id="basic">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#"> Edit Basic Configuration</a> 
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
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
                                <form action="{{route('basic.update', $basics->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="institute_title" class="form-label">Institute Title</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->institute_title}}" id="institute_title" name="institute_title">
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="web_link" class="form-label">Website Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->web_link}}" id="web_link" name="web_link">
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="google_map" class="form-label">Google Map</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->google_map}}" id="google_map" name="google_map">
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="fb_link" class="form-label">Facebook Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->fb_link}}" id="fb_link" name="fb_link">
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="youtube_link" class="form-label">Youtube Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->youtube_link}}" id="youtube_link" name="youtube_link">
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="twitter_link" class="form-label">Twitter Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->twitter_link}}" id="twitter_link" name="twitter_link">
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="insta_link" class="form-label">Instagram Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->insta_link}}" id="insta_link" name="insta_link">
                                        </div>
                                    </div>
                                    <div class="row right">
                                        <div class="col-sm-4 col-md-4">
                                            <label for="pi_link" class="form-label">Pinterest Link</label>
                                        </div>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" class="form-control" value="{{$basics->pi_link}}" id="pi_link" name="pi_link">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                            <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                            <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                                        </svg>
                                        Update
                                    </button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection