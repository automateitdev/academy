@extends('school_admin')

@section('content')
    <div class="dash">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="jkuy">
                        <div class="row">
                            <div class="col-md-3">
                                @php
                                    $jk = DB::table('basics')
                                        ->select('logo')
                                        ->where('institute_id', Auth::user()->institute_id)
                                        ->first();
                                    
                                @endphp
                                @if (!empty($jk))
                                    <img src="{{ asset('images/logo/' . $jk->logo) }}" alt="" width="100px"
                                        height="100px">
                                @endif
                            </div>
                            <div class="col-md-9">
                                @foreach ($users as $user)
                                    @if ($user->institute_id == Auth::user()->institute_id)
                                        <p class="ins_name">{{ $user->institute_name }}</p>
                                        <p class="add">{{ $user->address }}</p>
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
