@extends('school_admin')

@section('content')

    <div id="quick_collection">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="mb-25">
                        <a href="#">Quick Collection View</a> 
                        <!-- <button type="button" class="btn btn-default btn-rounded print pull-right" data-bs-toggle="modal" data-bs-target="#basicsModal">+ Add Information</button> -->
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 col-md-10 offset-md-1">
                    <div class="row upi">
                        <div class="col-md-3">
                            <figure class="figure">
                                <img src="{{asset('images/no-img.jpg')}}" class="figure-img img-fluid rounded" alt="..." width="150px" height="150px">
                                <figcaption class="figure-caption text-center">Student ID</figcaption>
                                <p class="text-center">6256667</p>
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <table class="std_table">
                                <tbody>
                                    <tr>
                                        <td>Student's Name</td>
                                        <td>:</td>
                                        <td>{{$students->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Student Roll</td>
                                        <td>:</td>
                                        <td>{{$students->roll}}</td>
                                    </tr>
                                    <tr>
                                        <td>Section</td>
                                        <td>:</td>
                                        <td>{{$students->section_id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Group</td>
                                        <td>:</td>
                                        <td>{{$students->group_id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Father's Name</td>
                                        <td>:</td>
                                        <td>{{$students->father_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>:</td>
                                        <td>{{$students->std_category_id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile No.</td>
                                        <td>:</td>
                                        <td>{{$students->mobile_no}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row upi">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Fee Head</th>
                                    <th>Fee Sub Head</th>
                                    <th>Previous Due</th>
                                    <th>Payable</th>
                                    <th>Waiver</th>
                                    <th>Fine</th>
                                    <th>Total Payable</th>
                                    <th>Payed</th>
                                    <th>Due</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection