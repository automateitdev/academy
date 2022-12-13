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
                                                    @if($item->institute_id == Auth::user()->institute_id)
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
                                                    @if($item->institute_id == Auth::user()->institute_id)
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
                                                    @if($item->institute_id == Auth::user()->institute_id)
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
                                    @foreach($sectionassigns as $key=>$section)
                                    @if($section->institute_id == Auth::user()->institute_id)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        @foreach($startups as $item)
                                        @if($section->class_id == $item->id)
                                        @foreach($startupsubcategories as $i)
                                        @if($item->startup_subcategory_id == $i->id)
                                        <td>{{$i->startup_subcategory_name}}</td>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @foreach($startups as $item)
                                        @if($section->section_id == $item->id)
                                        @foreach($startupsubcategories as $i)
                                        @if($item->startup_subcategory_id == $i->id)
                                        <td>{{$i->startup_subcategory_name}}</td>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @foreach($startups as $item)
                                        @if($section->shift_id == $item->id)
                                        @foreach($startupsubcategories as $i)
                                        @if($item->startup_subcategory_id == $i->id)
                                        <td>{{$i->startup_subcategory_name}}</td>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach
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
                                                    @if($item->institute_id == Auth::user()->institute_id)
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
                                                    @if($item->institute_id == Auth::user()->institute_id)
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
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Group</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groupassigns as $key=>$group)
                                    @if($group->institute_id == Auth::user()->institute_id)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        @foreach($startups as $item)
                                        @if($group->class_id == $item->id)
                                        @foreach($startupsubcategories as $i)
                                        @if($item->startup_subcategory_id == $i->id)
                                        <td>{{$i->startup_subcategory_name}}</td>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach
                                        @foreach($startups as $item)
                                        @if($group->group_id == $item->id)
                                        @foreach($startupsubcategories as $i)
                                        @if($item->startup_subcategory_id == $i->id)
                                        <td>{{$i->startup_subcategory_name}}</td>
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach
                                        <td>
                                            
                                            <form method="POST" id="delete-form-{{$group->id}}" action="{{route('class.group_destroy',$group->id)}}" style="display: none;">
                                                @csrf
                                                {{method_field('delete')}}

                                            </form>
                                            <button onclick="if(confirm('Are you sure, You want to delete this?')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{$group->id}}').submit();
                                                }else{
                                                event.preventDefault();
                                                }
                                        " class="btn" href="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                        </td>
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