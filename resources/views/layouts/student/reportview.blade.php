

    <style>
        .invoicetable{
            border: 1px solid black;
        }
        .invoicetable .invrow{
            border: 1px solid black;
        }
        .invoicetable .invrow .invhead {
            border: 1px solid black;
            text-align: center
        }

        .invoicetable .invrow .invtd{
            border: 1px solid black;
            text-align: left;
        }

    </style>
@php
    ini_set('memory_limit', '1024M');
    $date = date('d/m/y');
    $i = 0;
    $data = json_decode($data, true);
@endphp


    <div class = "card" style=" width: 55rem;  margin-left:20px; margin-top: 20px;">
        <div class="card-header" style="text-align: center; border-bottom-width: 0.3rem; border-bottom-color: black;">
            <img src="C:/Users/Lenovo/Desktop/laravel intern/PDFs/schoologo.jpg" style="width: 150px;height:120px; margin-right: 800px; margin-bottom:-110px;" alt="">
            @foreach ($data as $value)
            <p style="font-size:20px;"><b>{{$value['institute_name']}}</b>
                <br/>
                {{$value['institute_add']}}
            </p>
                    @php 
                        break;
                    @endphp
                    @endforeach
            
           <p style="margin-left: 600px; margin-top: -80px;text-align:right; "><img src="C:/Users/Lenovo/Desktop/laravel pages/barimage.png" style="width:100px; height:100px;" ></p> 
        </div>
        <div class="card-body">
            <p style="text-align: center;"><b>Money Receipt</b></span>
                <p style = "text-align: center;margin-top: -40px;">__________________</p>
                
            <table style="margin-top: 30px;">
                <tr>
                    <td style="margin-top: 20px;">Academic Year</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td >:</td>
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

                    <td ><label style="text-align: right; margin-left: 100px;">Academic Session</label></td>
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

                    <td ><label style="text-align: right; margin-left: 100px;">Roll No</label></td>
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
                    <td ><label style="text-align: right; margin-left: 100px;">Class-Shift-Section</label></td>
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
                    

                    <td ><label style="text-align: right; margin-left: 100px;">Payment Date</label></td>
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
                        <td>{{$value['updated_at']}}</td>
                        @php 
                            break;
                        @endphp
                        @endforeach
                </tr>
                
            </table>
            <table>
                
            </table>
            <table class = "invoicetable" style="border:1px solid black; border-collapse: collapse; width: 100%;">
                <tr class = "invrow" style="background-color: lightgrey;">
                    <th class = "invhead">Fee Head</th>
                    <th class = "invhead">Fee Sub Heads</th>
                    <th class = "invhead">Fee Amount</th>
                    <th class = "invhead" >Waiver</th>
                    <th class = "invhead" >Fine</th>
                    <th class = "invhead">Payable</th>
                </tr>
                @foreach ($data as $value)
                <tr class = "invrow" >
                    <td class = "invtd">{{$value['head_name']}}</td>
                    <td class = "invtd">{{$value['subhead_name']}}</td>
                    <td class = "invtd" style="text-align:right">{{$value['payable']}}</td>
                    <td class = "invtd" style="text-align:right">{{$value['waiver_amount']}}</td>
                    <td class = "invtd" style="text-align: right;">{{$value['fine']}}</td>
                    <td class = "invtd" style="text-align: right;">{{$value['payable']}}</td>
                </tr>
                @endforeach
                <tr class = "invrow"  style="margin-top: -10rem;">
                    <td class = "invtd" colspan="3" style="text-align:left; margin-left:20px;border-bottom-color: white;">
                        <p><b>Note:</b></p>
                        
                    </td>
                    <td colspan="2" class = "invtd" style="text-align: left;">
                        <p>Total Payable</p>
                        
                    </td>
                    <td class = "invtd">
                        <p style="text-align: right;">2000.00</p>
                        
                    </td>
                     
                </tr>
                <tr>
                    <td colspan="3" class ="invnottd" style="text-align:left; margin-left:20px;border-bottom-color: white;"><p style="margin-top: -10px;">Online Fees Payment</p></td>
                    <td colspan="2" class = "invtd" style="border: 1px solid black;text-align:left;">Paid Amount</td>
                    <td style="text-align: right;border: 1px solid black">1500.00</td>
                </tr>
                <tr class="invrow">
                    <td colspan="6" class = "invtd" style="text-align: left;"> <b>Paid In Word:</b> One Taka Only</td>
                </tr>
                
            </table>
           <table style="margin-top: -10px;">
            <tr>
                <td><label style="font-size:10px;">Powered By: Academy-Institute Management System </label></td>
                <td><label style="font-size:10px; margin-left:50px;">Special Note: This Money Receipt was created on a software and is valid without signature and seal </label></td>
            </tr>
           </table>
                
        </div>
    </div>