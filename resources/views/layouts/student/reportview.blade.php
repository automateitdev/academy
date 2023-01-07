<style>
    @page {
        margin: 20px auto;
        padding: 20px;
    }

    * {
        font-family: DejaVu Serif;
        font-size: .85rem;
    }

    table tr>td {
        color: black;
    }

    .pagebreak {
        page-break-inside: avoid;
    }

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
if (empty($value['invoice'])) {
    $value['invoice'] = $value['qc_invoice'];
}

isset($value['total_qc_paid']) ? $paidAmount = $value['total_qc_paid'] : $paidAmount = $value['total_payable'];
$qrtext = "
Student Name: {$value['name']}
Student ID: {$value['student_id']}
Invoice ID: {$value['invoice']}
Paid Amount: {$paidAmount}
Institute: {$value['institute_name']}
";
}
@endphp


<div class="card" style="background-color:#eee; padding:20px; margin:20px; background-color:#F0FFF0;">
    <div class="card-header" style="text-align: center; border-bottom-width: 0.3rem; border-bottom-color: black;">
        @foreach ($data as $value)
        @if (isset($value['institute_logo']) && !empty($value['institute_logo']))
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('images/' . $value['institute_logo']))) }}" style="position: absolute; top:40px; left:3rem; width: 120px;" alt="">
        @endif
        <img src="data:image/png;base64, {{ base64_encode(QrCode::size(300)->generate($qrtext)) }}" style="position: absolute; top:40px; right:3rem; width: 120px;" alt="">

        <p style="font-size:20px;"><b>{{ $value['institute_name'] }}</b>
            <br />
            {{ $value['institute_add'] }}
        </p>
        @php
        break;
        @endphp
        @endforeach

        {{-- <p style="margin-left: 600px; margin-top: -80px;text-align:right; "><img src="C:/Users/Lenovo/Desktop/laravel pages/barimage.png" style="width:100px; height:100px;"></p> --}}
    </div>
    <div class="card-body">
        <p style="text-align: center;"><b>Money Receipt</b>
        <p style="text-align: center;margin-top: -40px;">______</p>

        <table style="margin-top: 30px;">
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
                <td>{{ $value['academic_yr_name'] }}</td>
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
                <td>{{ $value['session_name'] }}</td>
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
                <td>{{ $value['student_id'] }}</td>
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
                <td>{{ $value['roll'] }}</td>
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
                <td>{{ $value['name'] }}</td>
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
                <td>{{ $value['class_name'] }}-{{ $value['shift_name'] }}-{{ $value['section_name'] }}</td>
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
                @if (empty($value['invoice']))
                <td>{{ $value['qc_invoice'] }}</td>
                @else
                <td>{{ $value['invoice'] }}</td>
                @endif
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
                $date = \Carbon\Carbon::parse($value['updated_at'])->toDateString();
                @endphp
                @if(isset($value['qc_date']) && !empty($value['qc_date']))
                <td>{{$value['qc_date']}}</td>
                @else
                <td>{{ $date }}</td>
                @endif
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
                <th class="invhead">Previous Paid</th>
                <th class="invhead">Payable</th>


            </tr>
            @foreach ($data as $value)
            <tr class="invrow">
                <td class="invtd">{{ $value['head_name'] }}</td>
                <td class="invtd">{{ $value['subhead_name'] }}</td>
                <td class="invtd" style="text-align:right">{{ $value['payable'] }}</td>
                <td class="invtd" style="text-align:right">{{ $value['waiver_amount'] }}</td>
                <td class="invtd" style="text-align: right;">{{ $value['fine'] }}</td>

                @if(isset($value['qc_prev_paid']))
                    <td class="invtd" style="text-align: right;">{{$value['qc_prev_paid']}}</td>
                    @elseif(isset($value['qc_part_paid']))
                        <td class="invtd" style="text-align: right;">{{$value['qc_part_paid']}}</td>
                    @else
                        <td class="invtd" style="text-align: right;">0</td>
                @endif
                <td class=" invtd" style="text-align: right;">{{ $value['total_amount'] }}</td>
            </tr>
            @endforeach
            <tr class="invrow" style="margin-top: -10rem;">
                <td class="invtd" colspan="4" style="text-align:left; margin-left:20px;border-bottom-color: white;">
                    <p><b>Note:</b></p>
                </td>
                <td colspan="2" class="invtd">
                    <p style="text-align: right; font-weight:bold">Total Payable</p>
                </td>
                <td class="invtd">
                    <p style="text-align: right; font-weight:bold">{{ $value['total_payable'] }}</p>
                </td>

            </tr>
            <tr>
                <td colspan="4" class="invnottd" style="text-align:left; margin-left:20px;border-bottom-color: white;">
                    @if (!empty($value['invoice']))
                    <p style="margin-top: -10px;">Online Fees Payment</p>
                    @else
                    <p style="margin-top: -10px;">Cash Recieved</p>
                    @endif
                </td>
                <td colspan="2" class="invtd" style="border: 1px solid black;text-align:right; font-weight:bold">
                    Total Paid</td>
                <td style="text-align: right;border: 1px solid black; font-weight:bold">{{ isset($value['total_qc_paid']) ? $value['total_qc_paid'] : $value['total_payable']  }}</td>
            </tr>

            <tr>
                <td colspan="4" class="invnottd" style="text-align:left; margin-left:20px;border-bottom-color: white;">
                </td>
                <td colspan="2" class="invtd" style="border: 1px solid black;text-align:right;font-weight:bold">Due
                    Amount</td>
                <td style="text-align: right;border: 1px solid black; font-weight:bold">{{ $value['total_due'] }}</td>
            </tr>


            <tr class="invrow" colspan="">
                <td colspan="7" class="invtd" style="text-align: left;"> <b>Paid In Word:</b>
                    {{ $value['amountInWords'] }}
                </td>
            </tr>
            <tr>
                <td colspan="3"><label style="font-size:10px;">Powered By: Academy-Institute Management System
                    </label></td>
                <td colspan="4" style="text-align: right;"><label style="font-size:10px; margin-left:50px;">Special
                        Note: This Money Receipt was created on a software and is valid without signature and seal
                    </label></td>
            </tr>
        </table>
    </div>
</div>