@extends('school_admin')

@section('content')

    <div id="fee_mapping">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Student Accounts Settings Mapping</a> 
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-md-1">
                    <div class="plJhy">
                        <nav>
                        @php
                            $active = false;
                            $active_two = false;
                            if(empty(Session::get('navtab')))
                            {
                                $active = true;
                            }
                            if(!empty(Session::get('navtab')) && Session::get('navtab') == "fee-mapping-tab" ){
                            $active = true;

                            }elseif(!empty(Session::get('navtab')) && Session::get('navtab') == "fine-mapping-tab"){
                                $active_two = true;
                            }

                            if($active){
                            $class_name = 'active';
                            }
                            else{
                            $class_name = '';
                            }
                            if($active_two){
                                $class_name_two = 'active';
                            }
                            else{
                                $class_name_two = '';
                            }
                        @endphp
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link {{$class_name}}" id="fee-mapping-tab" data-bs-toggle="tab" data-bs-target="#fee-mapping" type="button" role="tab" aria-controls="fee-mapping" aria-selected="true">Fee Mapping</button>
                                <button class="nav-link {{$class_name_two}}" id="fine-mapping-tab" data-bs-toggle="tab" data-bs-target="#fine-mapping" type="button" role="tab" aria-controls="fine-mapping" aria-selected="false">Fine Mapping</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade {{'show '.$class_name}}" id="fee-mapping" role="tabpanel" aria-labelledby="fee-mapping-tab">
                                <div class="row">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Fee Map</h4>
                                        <div class="wdfGh">
                                            <form action="{{route('fee.maping.store')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" value="fee-mapping-tab" name="nav_tab">

                                                        @php
                                                        $feesubheadsItem = \App\Models\Feesubhead::all();
                                                        
                                                        @endphp
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Fee Head</label>
                                                    <select class="form-control account_category" name="feehead_id">
                                                        <option value=" ">Choose One</option>
                                                        @foreach($feeheads as $feehead)
                                                            @if($feehead->institute_id == Auth::user()->institute_id)
                                                            <option value="{{$feehead->id}}">{{$feehead->head_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                            
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Fee Sub Head</label>
                                                    <select class="form-control single account_category" multiple="multiple" name="feesubhead_id[]">
                                                        <option value=" ">Choose One</option>
                                                        @foreach($feesubheadsItem as $item)
                                                        @if($item->institute_id == Auth::user()->institute_id)
                                                        <option value="{{$item->id}}">{{$item->subhead_name}}</option>
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
                                                    <select class="form-control single account_category" multiple="multiple" name="fund_id[]">
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
                                                <th scope="col">#</th>
                                                <th scope="col">Fee Head</th>
                                                <th scope="col">Ledger</th>
                                                <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php 
                                                    $i =1;
                                                @endphp
                                                @foreach($feemappings->unique('feehead_id') as $feemapping)
                                                    @if($feemapping->institute_id == Auth::user()->institute_id)
                                                        <tr>
                                                            <td>{{$i++}}</td>
                                                            <td>{{$feemapping->feehead->head_name}}</td>
                                                            <td>{{$feemapping->ledger->ledger_name}}</td>
                                                            <td>
                                                            <form method="POST" id="delete-form-{{$feemapping->id}}" 
                                                            action="{{route('fee.maping.delete',$feemapping->id)}}" style="display: none;">
                                                            @csrf
                                                            {{method_field('delete')}}
                                                        
                                                            </form>
                                                            <button onclick="if(confirm('Are you sure, You want to delete this?')){
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{$feemapping->id}}').submit();
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
                            <div class="tab-pane fade {{'show '.$class_name_two}}" id="fine-mapping" role="tabpanel" aria-labelledby="fine-mapping-tab">
                                <div class="row">
                                    <div class="col-sm-4 col-md-4">
                                        <h4>Fee Fine Map</h4>
                                        <div class="wdfGh">
                                            <form action="{{route('fine.maping.store')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" value="fine-mapping-tab" name="nav_tab">

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
                                                <th scope="col">#</th>
                                                <th scope="col">Fee Head</th>
                                                <th scope="col">Ledger</th>
                                                <th scope="col">Fund</th>
                                                <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php 
                                                    $i =1;
                                                @endphp
                                            @foreach($feefinemappings->unique('feehead_id') as $item)
                                            @if($item->institute_id == Auth::user()->institute_id)
                                                <tr>
                                                    <th scope="row">{{$i++}}</th>
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
@php 
Session::forget('navtab');
@endphp
@endsection