@extends('school_admin')

@section('content')

   <div id="class_setup">
       <div class="container">
           <div class="row">
               <div class="duYtr">
                   <div class="col-sm-8 col-md-8 offset-sm-2 offset-md-2">
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
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="startup_category" class="form-label">Type</label>
                                            <select class="form-control single startup_category" name="startup_category">
                                                <option value="">Select a Type</option>
                                                @foreach($startupcats as $stcat)
                                                <option value="{{$stcat->id}}">{{$stcat->startup_category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- group start -->
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                        </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

@endsection