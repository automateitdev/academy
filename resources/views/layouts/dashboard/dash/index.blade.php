@extends('school_admin')

@section('content')

<div class="dash">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="jkuy">
                    
                    <div class="row">
                        <div class="col-md-3">
                        @foreach($basics as $item)
                    @if($item->institute_id == Auth::user()->institute_id)
                            <img src="{{storage_path('images/logo/'. $item->logo)}}" alt="" width="100px" height="100px">
                            @endif
                    @endforeach
                        </div>
                        <div class="col-md-9">
                        @foreach($users as $user)
                    @if($user->institute_id == Auth::user()->institute_id)
                            <p class="ins_name">{{$user->institute_name}}</p>
                            <p class="add">{{$user->address}}</p>

                    @endif
                    @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection