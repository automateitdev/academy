@extends('school_admin')

@section('content')

   <div id="class_setup">
       <div class="container">
           <div class="row">
               <div class="duYtr">
                   <div class="col-sm-8 col-md-8 offset-sm-1 offset-md-1">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Section Assign</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Group Assign</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <!-- section -->
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <form action="">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label for="class" class="form-label">Class</label>
                                                    <select class="form-control single class" name="class">
                                                        <option value="">Select a Class</option>
                                                        @foreach($startups as $item)
                                                            @if($item->institute_id ==  Auth::user()->institute_id)
                                                                @if($item->startup_category_id == 4)
                                                                    <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label for="section" class="form-label">Section</label>
                                                    <select class="form-control single section" name="section">
                                                        <option value="">Select a Section</option>
                                                        @foreach($startups as $item)
                                                            @if($item->institute_id ==  Auth::user()->institute_id)
                                                                @if($item->startup_category_id == 6)
                                                                    <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label for="shift" class="form-label">Shift</label>
                                                    <select class="form-control single shift" name="shift">
                                                        <option value="">Select a Shift</option>
                                                        @foreach($startups as $item)
                                                            @if($item->institute_id ==  Auth::user()->institute_id)
                                                                @if($item->startup_category_id == 3)
                                                                    <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <button type="submit" class="btn btn-primary done"><i class="fas fa-plus-circle"></i> Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- group start -->
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form action="">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label for="class" class="form-label">Class</label>
                                                    <select class="form-control single class" name="class">
                                                        <option value="">Select a Class</option>
                                                        @foreach($startups as $item)
                                                            @if($item->institute_id ==  Auth::user()->institute_id)
                                                                @if($item->startup_category_id == 4)
                                                                    <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label for="section" class="form-label">Group</label>
                                                    <select class="form-control single section" name="section">
                                                        <option value="">Select a Section</option>
                                                        @foreach($startups as $item)
                                                            @if($item->institute_id ==  Auth::user()->institute_id)
                                                                @if($item->startup_category_id == 5)
                                                                    <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                                            </div>
                                            <div class="col-sm-6 col-md-6"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

@endsection