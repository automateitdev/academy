@extends('about')

@section('content')

<div id="about">
    <div class="container">
        @foreach($abouts as $item)
            @if($item->institute_id == "a0143")
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
            @endif
        @endforeach
    </div>
</div>
@endsection