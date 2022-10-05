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
                                <form action="{{route('class.section_store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="mb-3">
                                                <input type="text" class="form-control insId" value="{{Auth::user()->institute_id}}" id="institute_id" name="institute_id" required>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label for="class" class="form-label">Class</label>
                                                    <select class="form-control single class" name="class_id">
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
                                                    <select class="form-control single section" name="section_id">
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
                                                    <select class="form-control single shift" name="shift_id">
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
                                <!-- table -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Shift</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sectionassigns as $section)
                                        @if($section->institute_id == Auth::user()->institute_id)
                                        <tr>
                                            <th scope="row">{{$section->id}}</th>
                                            <td>{{$section->class_id}}</td>
                                            <td>{{$section->section_id}}</td>
                                            <td>{{$section->shift_id}}</td>
                                            </tr></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- group start -->
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form action="{{route('class.group_store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="mb-3">
                                                <input type="text" class="form-control insId" value="{{Auth::user()->institute_id}}" id="institute_id" name="institute_id" required>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="mb-3">
                                                    <label for="class" class="form-label">Class</label>
                                                    <select class="form-control single class" name="class_id">
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
                                                    <select class="form-control single section" name="group_id">
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
                                <!-- table -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Group</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($groupassigns as $group)
                                        @if($group->institute_id == Auth::user()->institute_id)
                                        <tr>
                                            <th scope="row">{{$group->id}}</th>
                                            <td>{{$group->class_id}}</td>
                                            <td>{{$group->group_id}}</td>
                                            </tr></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

@endsection