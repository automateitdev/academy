@extends('school_admin')

@section('content')

    <div id="fee_mapping">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Student Accounts Amount Config</a> 
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-md-1">
                    <div class="plJhy">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="fee-mapping-tab" data-bs-toggle="tab" data-bs-target="#fee-mapping" type="button" role="tab" aria-controls="fee-mapping" aria-selected="true">Fee Amount</button>
                                <button class="nav-link" id="fine-mapping-tab" data-bs-toggle="tab" data-bs-target="#fine-mapping" type="button" role="tab" aria-controls="fine-mapping" aria-selected="false">Absent Fine Amount</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="fee-mapping" role="tabpanel" aria-labelledby="fee-mapping-tab">
                                <div class="row">
                                    <div class="col-sm-10 col-md-10">
                                        <h4>Configure Fee Amount</h4>
                                        <div class="wdfGh">
                                            <form action="{{route('fee.amount.store')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="text" class="form-control insId" id="institute_id" value="{{Auth::user()->institute_id}}" name="institute_id">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Class</label>
                                                            <select class="form-control" name="class_id">
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
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Group</label>
                                                            <select class="form-control" name="group_id">
                                                                <option value="">Select a Group</option>
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
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Student Category</label>
                                                            <select class="form-control" name="stdcategory_id">
                                                                <option value="">Select a Group</option>
                                                                @foreach($startups as $item)
                                                                    @if($item->institute_id ==  Auth::user()->institute_id)
                                                                        @if($item->startup_category_id == 7)
                                                                            <option value="{{$item->id}}">{{$item->startupsubcategory->startup_subcategory_name}}</option>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Fee Head</label>
                                                            <select class="form-control feehead_amount" name="feehead_id">
                                                                <option value=" ">Choose One</option>
                                                                @foreach($feeheads as $item)
                                                                @if($item->institute_id == Auth::user()->institute_id)
                                                                <option value="{{$item->id}}">{{$item->head_name}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Fee Amount</label>
                                                            <input type="text" class="form-control" name="feeamount">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Fine Amount</label>
                                                            <input type="text" class="form-control" name="fineamount">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="mb-3" >
                                                            <div class="rkj">
                                                                
                                                                <table class="fund_of_amount">
                                                                    <colgroup>
                                                                    <col>
                                                                    <col>
                                                                    </colgroup>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="width: 300px;">Fund Name</td>
                                                                            <td style="width: 100px;">
                                                                            <input type="text" class="form-control" name="fun_amount">
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-10 col-md-10">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <th scope="col">Class</th>
                                                <th scope="col">Group</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Fee Head</th>
                                                <th scope="col">Fee Amount</th>
                                                <th scope="col">Fine Amount</th>
                                                <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($feeamounts as $item)
                                            @if($item->institute_id == Auth::user()->institute_id)
                                                <tr>
                                                    <!-- <th scope="row">{{$item->id}}</th> -->
                                                    @foreach($startups as $st)
                                                        @if($item->class_id == $st->id)
                                                            @foreach($startupsubcategories as $i)
                                                                @if($st->startup_subcategory_id == $i->id)
                                                                    <td>{{$i->startup_subcategory_name}}</td>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    @foreach($startups as $st)
                                                        @if($item->group_id == $st->id)
                                                            @foreach($startupsubcategories as $i)
                                                                @if($st->startup_subcategory_id == $i->id)
                                                                    <td>{{$i->startup_subcategory_name}}</td>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    @foreach($startups as $st)
                                                        @if($item->stdcategory_id == $st->id)
                                                            @foreach($startupsubcategories as $i)
                                                                @if($st->startup_subcategory_id == $i->id)
                                                                    <td>{{$i->startup_subcategory_name}}</td>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <!-- <td>{{$item->class_id}}</td> -->
                                                    <!-- <td>{{$item->group_id}}</td> -->
                                                    <!-- <td>{{$item->stdcategory_id}}</td> -->
                                                    <td>{{$item->feehead->head_name}}</td>
                                                    <td>{{$item->feeamount}}</td>
                                                    <td>{{$item->fineamount}}</td>
                                                    <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feeAmountModal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                            </svg>
                                                    </button>
                                                    <!-- <a class="svgimg" href="{{route('fee.amount.edit',$item->id)}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                            </svg>
                                                    </a> -->
                                                    <form method="POST" id="delete-form-{{$item->id}}" 
                                                            action="{{route('fee.maping.delete',$item->id)}}" style="display: none;">
                                                            @csrf
                                                            {{method_field('delete')}}
                                                        
                                                            </form>
                                                            <button onclick="if(confirm('Are you sure, You want to delete this?')){
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{$item->id}}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }
                                                            "class="btn" href="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                            </svg>
                                                            </button>
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Fine -->
                            <div class="tab-pane fade" id="fine-mapping" role="tabpanel" aria-labelledby="fine-mapping-tab">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Fee Fine Map</h4>
                                        <div class="wdfGh">
                                            <form action="{{route('fine.maping.store')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="text" class="form-control insId" id="institute_id" value="{{Auth::user()->institute_id}}" name="institute_id">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Fee Head</label>
                                                    <select class="form-control account_category" name="feehead_id">
                                                        <option value=" ">Choose One</option>
                                                        @foreach($feeheads as $item)
                                                        @if($item->institute_id == Auth::user()->institute_id)
                                                        <option value="{{$item->id}}">{{$item->head_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Ledger</label>
                                                    <select class="form-control account_category" name="ledger_id">
                                                        <option value=" ">Choose One</option>
                                                        @foreach($ledgers as $item)
                                                        @if($item->institute_id == Auth::user()->institute_id)
                                                        <option value="{{$item->id}}">{{$item->ledger_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Fund</label>
                                                    <select class="form-control account_category" name="fund_id">
                                                        <option value=" ">Choose One</option>
                                                        @foreach($funds as $item)
                                                        @if($item->institute_id == Auth::user()->institute_id)
                                                        <option value="{{$item->id}}">{{$item->fund_name}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Save</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-8">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <th scope="col">Fee Head</th>
                                                <th scope="col">Ledger</th>
                                                <th scope="col">Fund</th>
                                                <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($feefinemappings->unique('feehead_id') as $item)
                                                <tr>
                                                    <!-- <th scope="row">{{$item->id}}</th> -->
                                                    <td>{{$item->feehead->head_name}}</td>
                                                    <td>{{$item->ledger->ledger_name}}</td>
                                                    <td>{{$item->fund->fund_name}}</td>
                                                    <td>
                                                    <form method="POST" id="delete-form-{{$item->id}}" 
                                                            action="{{route('fine.maping.delete',$item->id)}}" style="display: none;">
                                                            @csrf
                                                            {{method_field('delete')}}
                                                        
                                                            </form>
                                                            <button onclick="if(confirm('Are you sure, You want to delete this?')){
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{$item->id}}').submit();
                                                            }else{
                                                            event.preventDefault();
                                                            }
                                                            "class="btn" href="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                            </svg>
                                                            </button>
                                                    </td>
                                                </tr>
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
        </div>
    </div>




    <!-- Fee Amount Modal -->
    <div class="modal fade" id="feeAmountModal" tabindex="-1" aria-labelledby="feeAmountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feeAmountModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>


@endsection