@extends('school_admin')

@section('content')

<div id="ops">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="{{asset('hwrc.index')}}">Head Wise Collection</a>
                    <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                </h2>
            </div>
        </div>
        <div class="row">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-datewise-tab" data-bs-toggle="tab" data-bs-target="#nav-datewise" type="button" role="tab" aria-controls="nav-datewise" aria-selected="true">Date Wise</button>
                    <button class="nav-link" id="nav-monthwise-tab" data-bs-toggle="tab" data-bs-target="#nav-monthwise" type="button" role="tab" aria-controls="nav-monthwise" aria-selected="false">Month Wise</button>
                    <button class="nav-link" id="nav-yearwise-tab" data-bs-toggle="tab" data-bs-target="#nav-yearwise" type="button" role="tab" aria-controls="nav-yearwise" aria-selected="false">Year Wise</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-datewise" role="tabpanel" aria-labelledby="nav-datewise-tab">
                    <div class="row mt-2">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="rkj">
                                <form action="{{route('hwrc.search')}}" method="get" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="academic_year_id" class="form-label">Academic Year</label>
                                                <select class="form-control single" name="academic_year_id">
                                                    <option value=" ">Choose One</option>
                                                    @foreach($startups as $startup)
                                                        @if($startup->startup_category_id == "1")
                                                            <option value="{{$startup->id}}">{{$startup->startupsubcategory->startup_subcategory_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="acad" class="form-label">Search With</label>
                                            <select class="form-control" name="class" id="">
                                                <option value="cls">Class</option>
                                                <option value="sec">Section</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="" class="form-label">From</label>
                                            <input type="date" class="form-control" name="from">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">To</label>
                                            <input type="date" class="form-control" name="to">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    @php 
                        dd($qc_data);
                    @endphp
                </div>
                <div class="tab-pane fade" id="nav-monthwise" role="tabpanel" aria-labelledby="nav-monthwise-tab">...</div>
                <div class="tab-pane fade" id="nav-yearwise" role="tabpanel" aria-labelledby="nav-yearwise-tab">...</div>
            </div>
        </div>
    </div>
</div>

@endsection