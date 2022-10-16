@extends('header.person')

@section('content')

<div id="admins">
    <div class="container">
        <section class="section-page">
            <div class="container">
                <div class="card mt-5">
                    @foreach($administrations as $item)

                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa fa-clone" aria-hidden="true"></i> {{$item->name}}
                        </h5>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-12">
                                <img src="{{ asset('images/admns/'.$item->photo) }}" alt="" width="150" height="200"
                                    class="d-inline-block align-text-top">
                            </div>
                            <div class="col-lg-9 col-md-9 col-12">
                                <table cellpadding="0" cellspacing="0" class="table  nowrap" id="example"
                                    style="width:100%">
                                    <tbody>
                                        <tr>
                                            <td align="left" nowrap=""><label>ID No.</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->id_no}}</td>
                                            <td width="125" align="left" nowrap=""><label>Father Name</label></td>
                                            <td width="3" align="center">:</td>
                                            <td width="304">{{$item->f_name}}</td>
                                        </tr>
                                        <tr>
                                            <td align="left" nowrap=""><label>NID.</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->nid}}</td>
                                            <td align="left" nowrap=""><label>Mother Name</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->m_name}}</td>
                                        </tr>
                                        <tr>
                                            <td width="120" align="left" nowrap="nowrap"><label>Full Name</label></td>
                                            <td width="14" align="center">:</td>
                                            <td width="260">{{$item->name}}</td>
                                            <td align="left" nowrap=""><label>Education </label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->edu}}</td>
                                        </tr>
                                        <tr>
                                            <td align="left" nowrap=""><label>Sex</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->sex}}</td>
                                            <td align="left" nowrap=""><label>Address</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->address}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" nowrap=""><label>Religion</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->religion}}</td>
                                            <td align="left" nowrap=""><label>Contact Number</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td align="left" nowrap=""><label>Designation</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->designation}}</td>
                                            <td align="left" nowrap=""><label>E-Mail Address</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->email}}</td>
                                        </tr>
                                        <tr>
                                            <td align="left" nowrap="nowrap"><label>Date of Birth</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->birth_date}}</td>
                                            <td align="left" nowrap=""><label>Jonining in This job</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->join_date}}</td>
                                        </tr>
                                        <tr>
                                            <td align="left" nowrap=""><label>Blood Group</label></td>
                                            <td align="center">:</td>
                                            <td>{{$item->blood}}</td>
                                            <!-- <td align="left" nowrap=""><label>Present Station</label></td>
                                            <td align="center">:</td>
                                            <td>01/03/2021</td> -->
                                        </tr>
                                        <tr>
                                            <td align="left" nowrap=""><label>Note</label></td>
                                            <td align="center">:</td>
                                            <td colspan="4">{{$item->note}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" align="center" valign="top" nowrap="nowrap">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>


@endsection