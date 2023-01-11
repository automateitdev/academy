@extends('school_admin')

@section('content')

<style>
    @font-face {
        font-family: "DejaVu Serif";
        font-style: normal;
        font-weight: normal;
        src: url('fonts/DejaVuSans.ttf') format('truetype');
    }

    .invoicetable {
        border: 1px solid black;
    }

    .invoicetable .invrow {
        border: 1px solid black;
    }

    .invoicetable .invrow .invhead {
        border: 1px solid black;
        text-align: center
    }

    .invoicetable .invrow .invtd {
        border: 1px solid black;
        text-align: left;
    }
</style>
@php
ini_set('memory_limit', '1024M');
$date = date('d/m/y');
$i = 0;
$data = json_decode($data, true);
foreach ($data as $key => $value) {
$qrtext = "
Student Name: {$value['name']}
Student ID: {$value['student_id']}
Invoice ID: {$value['invoice']}
Total Paid Amount: {$value['total']}
Institute: {$value['institute_name']}
";
break;
}
@endphp

<div id="fee_mapping">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mb-25">
                    <a href="#">OPS Collection Details</a>
                    <a href="{{route('ops.index')}}" class="btn btn-default btn-rounded print pull-right">
                        <- Back</a>
                </h2>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-10 offset-md-1">
                <table>
                    <tr>
                        <td style="margin-top: 20px;">Academic Year</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> : </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @foreach ($data as $value)
                        <td>{{$value['academic_yr_name']}}</td>
                        @php
                        break;
                        @endphp
                        @endforeach

                        <td><label style="text-align: right; margin-left: 100px;">Academic Session</label></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> <label>:</label></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @foreach ($data as $value)
                        <td>{{$value['session_name']}}</td>
                        @php
                        break;
                        @endphp
                        @endforeach
                    </tr>
                    <tr>
                        <td>Student ID</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @foreach ($data as $value)
                        <td>{{$value['student_id']}}</td>
                        @php
                        break;
                        @endphp
                        @endforeach

                        <td><label style="text-align: right; margin-left: 100px;">Roll No</label></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> <label>:</label></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @foreach ($data as $value)
                        <td>{{$value['roll']}}</td>
                        @php
                        break;
                        @endphp
                        @endforeach
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @foreach ($data as $value)
                        <td>{{$value['name']}}</td>
                        @php
                        break;
                        @endphp
                        @endforeach
                        <td><label style="text-align: right; margin-left: 100px;">Class-Shift-Section</label></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> <label>:</label></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @foreach ($data as $value)
                        <td>{{$value['class_name']}}-{{$value['shift_name']}}-{{$value['section_name']}}</td>
                        @php
                        break;
                        @endphp
                        @endforeach
                    </tr>
                    <tr>
                        <td>Invoice ID</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>:</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        @foreach ($data as $value)
                        <td>{{$value['invoice']}}</td>
                        @php
                        break;
                        @endphp
                        @endforeach


                        <td><label style="text-align: right; margin-left: 100px;">Payment Date</label></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> <label>:</label></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @foreach ($data as $value)
                        @php
                        $date = \Carbon\Carbon::parse($value["updated_at"])->toDateString()
                        @endphp
                        <td>{{$date}}</td>
                        @php
                        break;
                        @endphp
                        @endforeach
                    </tr>

                </table>
                <table>
                </table>
                <table class="invoicetable" style="border:1px solid black; border-collapse: collapse; width: 100%;">
                    <tr class="invrow" style="background-color: lightgrey;">
                        <th class="invhead">Fee Head</th>
                        <th class="invhead">Fee Sub Heads</th>
                        <th class="invhead">Fee Amount</th>
                        <th class="invhead">Waiver</th>
                        <th class="invhead">Fine</th>
                        <th class="invhead">Payable</th>
                    </tr>
                    @foreach ($data as $value)
                    <tr class="invrow">
                        <td class="invtd">{{$value['head_name']}}</td>
                        <td class="invtd">{{$value['subhead_name']}}</td>
                        <td class="invtd" style="text-align:right">{{$value['payable']}}</td>
                        <td class="invtd" style="text-align:right">{{$value['waiver_amount']}}</td>
                        <td class="invtd" style="text-align: right;">{{$value['fine']}}</td>
                        <td class="invtd" style="text-align: right;">{{$value['total_amount']}}</td>
                    </tr>
                    @endforeach
                    <tr class="invrow" style="margin-top: -10rem;">
                        <td class="invtd" colspan="3" style="text-align:left; margin-left:20px;border-bottom-color: white;">
                            <p><b>Note:</b></p>

                        </td>
                        <td colspan="2" class="invtd">
                            <p style="text-align: right;">Total Payable</p>

                        </td>
                        <td class="invtd">
                            <p style="text-align: right;">{{$value['total']}}</p>

                        </td>

                    </tr>
                    <tr>
                        <td colspan="3" class="invnottd" style="text-align:left; margin-left:20px;border-bottom-color: white;">
                            <p style="margin-top: -10px;">Online Fees Payment</p>
                        </td>
                        <td colspan="2" class="invtd" style="border: 1px solid black;text-align:right;">Paid Amount</td>
                        <td style="text-align: right;border: 1px solid black">{{$value['total']}}</td>
                    </tr>
                    <tr class="invrow">
                        <td colspan="6" class="invtd" style="text-align: left;"> <b>Paid In Word:</b> {{$value['amountInWords']}}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><label style="font-size:10px;">Powered By: Academy-Institute Management System </label></td>
                        <td colspan="4" style="text-align: right;"><label style="font-size:10px; margin-left:50px;">Special Note: This Money Receipt was created on a software and is valid without signature and seal </label></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection