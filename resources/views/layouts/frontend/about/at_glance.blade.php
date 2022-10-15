@extends('header.about')

@section('content')

<div id="about">
    <div class="container">
        <div class="row">
        @foreach($abouts as $item)
            <div class="col-sm-9 col-md-9">
                <div class="card mt-5 p-2">
                    <h5 class="card-title">
                        <i class="fa fa-clone" aria-hidden="true"></i> {{$item->subcategories->subcat_name}}
                        <hr>
                    </h5>
                    <p style="text-align: justify" class="p-2">{{$item->message}}</p>
                    <hr>
                    <a style="float:right; display: None;" class="btn btn-danger btn-sm"
                        href="midea/attachment/attachment2017-04-13-19-05-53_58efaff141a17.pdf">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF</a>
                    <div style="font-size: 14px;color: #999; display: None;">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="card mt-5">
                    <a target="_blank" href="#">
                        <img src="{{asset('images/about/'.$item->about_img)}}" alt="" width="253px" height="253px">
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection