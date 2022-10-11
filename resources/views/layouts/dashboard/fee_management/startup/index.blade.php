@extends('school_admin')

@section('content')

    <div id="fee_startup">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Student Accounts Settings Start Up</a> 
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                    </h2>
                </div>
                <div class="row">
                    <div class="col-sm-10 col-md-10 offset-md-1">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-head-tab" data-bs-toggle="tab" data-bs-target="#nav-head" type="button" role="tab" aria-controls="nav-head" aria-selected="true">Fee Head</button>
                                <button class="nav-link" id="nav-sub-head-tab" data-bs-toggle="tab" data-bs-target="#nav-sub-head" type="button" role="tab" aria-controls="nav-sub-head" aria-selected="false">Fee Sub Head</button>
                                <button class="nav-link" id="nav-waiver-tab" data-bs-toggle="tab" data-bs-target="#nav-waiver" type="button" role="tab" aria-controls="nav-waiver" aria-selected="false">Fee Waiver</button>

                                <button class="nav-link" id="nav-fund-tab" data-bs-toggle="tab" data-bs-target="#nav-fund" type="button" role="tab" aria-controls="nav-fund" aria-selected="false">Create Fund</button>
                                <button class="nav-link" id="nav-ledger-tab" data-bs-toggle="tab" data-bs-target="#nav-ledger" type="button" role="tab" aria-controls="nav-ledger" aria-selected="false">Create Ledger</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-head" role="tabpanel" aria-labelledby="nav-head-tab">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <form action="{{route('fee.startup.headstore')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" class="form-control insId" id="institute_id" value="{{Auth::user()->institute_id}}" name="institute_id">
                                            <div class="mb-3">
                                                <label for="feeHead" class="form-label">Add Fee Head</label>
                                                <input type="text" class="form-control" id="feeHead" name="head_name" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                                        </form>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="druyt">
                                            <div class="h4">Assigned List</div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Fee Head</th>
                                                    <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($feeheads as $item)
                                                    @if($item->institute_id == Auth::user()->institute_id)
                                                    <tr>
                                                        <th scope="row">{{$item->id}}</th>
                                                        <td>{{$item->head_name}}</td>
                                                        <td>
                                                            <form method="POST" id="delete-form-{{$item->id}}" 
                                                            action="{{route('fee.startup.headstore.delete',$item->id)}}" style="display: none;">
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
                            </div>
                            <!-- fee sub head -->
                            <div class="tab-pane fade" id="nav-sub-head" role="tabpanel" aria-labelledby="nav-sub-head-tab">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <form action="{{route('fee.startup.subheadstore')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" class="form-control insId" id="institute_id" value="{{Auth::user()->institute_id}}" name="institute_id">
                                            <div class="mb-3">
                                                <label for="subhead_name" class="form-label">Add Fee Sub Head</label>
                                                <input type="text" class="form-control" id="subhead_name" name="subhead_name" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                                        </form>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="druyt">
                                            <div class="h4">Sub Head Assigned List</div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Fee Sub Head</th>
                                                    <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($feesubheads as $item)
                                                    @if($item->institute_id == Auth::user()->institute_id)
                                                    <tr>
                                                        <th scope="row">{{$item->id}}</th>
                                                        <td>{{$item->subhead_name}}</td>
                                                        <td>
                                                            <form method="POST" id="delete-form-{{$item->id}}" 
                                                            action="{{route('fee.startup.subheadstore.delete',$item->id)}}" style="display: none;">
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
                            </div>

                            <!-- waiver -->
                            <div class="tab-pane fade" id="nav-waiver" role="tabpanel" aria-labelledby="nav-waiver-tab">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <form action="{{route('fee.startup.waiverstore')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" class="form-control insId" id="institute_id" value="{{Auth::user()->institute_id}}" name="institute_id">
                                            <div class="mb-3">
                                                <label for="waiver_name" class="form-label">Add Waiver</label>
                                                <input type="text" class="form-control" id="waiver_name" name="waiver_name" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                                        </form>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="druyt">
                                            <div class="h4">Waiver Assigned List</div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Waiver</th>
                                                    <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($waivers as $item)
                                                    @if($item->institute_id == Auth::user()->institute_id)
                                                    <tr>
                                                        <th scope="row">{{$item->id}}</th>
                                                        <td>{{$item->waiver_name}}</td>
                                                        <td>
                                                            <form method="POST" id="delete-form-{{$item->id}}" 
                                                            action="{{route('fee.startup.waiverstore.delete',$item->id)}}" style="display: none;">
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
                            </div>
                            <!-- fund -->
                            <div class="tab-pane fade" id="nav-fund" role="tabpanel" aria-labelledby="nav-fund-tab">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <form action="{{route('fee.startup.fundstore')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" class="form-control insId" id="institute_id" value="{{Auth::user()->institute_id}}" name="institute_id">
                                            <div class="mb-3">
                                                <label for="fund_name" class="form-label">Add Fund</label>
                                                <input type="text" class="form-control" id="fund_name" name="fund_name" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Save</button>
                                        </form>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="druyt">
                                            <div class="h4">Fund Assigned List</div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Fund</th>
                                                    <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($funds as $item)
                                                    @if($item->institute_id == Auth::user()->institute_id)
                                                    <tr>
                                                        <th scope="row">{{$item->id}}</th>
                                                        <td>{{$item->fund_name}}</td>
                                                        <td>
                                                            <form method="POST" id="delete-form-{{$item->id}}" 
                                                            action="{{route('fee.startup.fundstore.delete',$item->id)}}" style="display: none;">
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
                            </div>
                            <!-- Ledger -->
                            <div class="tab-pane fade" id="nav-ledger" role="tabpanel" aria-labelledby="nav-ledger-tab">
                            <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <form action="{{route('fee.startup.ledgerstore')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="text" class="form-control insId" id="institute_id" value="{{Auth::user()->institute_id}}" name="institute_id">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="" class="form-label">Account Category</label>
                                                    <select class="form-control account_category" name="account_categor_id">
                                                        <option value=" ">Choose One</option>
                                                        @foreach($accountcategories as $item)
                                                        <option value="{{$item->id}}">{{$item->account_category}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="fund_name" class="form-label">Account Group</label>
                                                    <select class="form-control acount_group" name="account_subcat_id">
                                                        <option value=" ">Choose One</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="ledger_name" class="form-label">Ledger Name</label>
                                                <input type="text" class="form-control" id="ledger_name" name="ledger_name" required>
                                            </div>
                                            <input type="text" class="form-control insId" id="note" value="null" name="note">
                                            
                                            <button type="submit" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Save</button>
                                        </form>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="druyt">
                                            <div class="h4">Ledger Assigned List</div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Ledger Name</th>
                                                    <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($ledgers as $item)
                                                    @if($item->institute_id == Auth::user()->institute_id)
                                                    <tr>
                                                        <th scope="row">{{$item->id}}</th>
                                                        <td>{{$item->ledger_name}}</td>
                                                        <td>
                                                            <form method="POST" id="delete-form-{{$item->id}}" 
                                                            action="{{route('fee.startup.fundstore.delete',$item->id)}}" style="display: none;">
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
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection