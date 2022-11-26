<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page { 
            margin:20px auto;
        }

        *{ 
            font-family: DejaVu Sans Mono;
            font-size: .85rem;
        }
        table tr>td{
            color:black;
        }
        .pagebreak{
            page-break-inside: avoid; 
        }

        table tr>td label{
            color:#19686d;
            font-weight: bold;
        }
    @font-face {
      font-family: "DejaVu Sans Mono";
      font-style: normal;
      font-weight: normal;
      src: url('fonts/DejaVuSans.ttf') format('truetype');
    }
    
    </style>
</head>

@php
    ini_set('memory_limit', '1024M');
    $date = date('d/m/y');
    $i = 0;
    $data = json_decode($data, true);
@endphp

@foreach ($data as $value)

@php
    $i++;
    $name = ucwords(strtolower($value['name']));
@endphp

<div class="card" style="page-break-inside:avoid; position: relative; vertical-align:middle; width:45rem; margin:0 auto; margin-bottom:20px; height:520px; background-color:#F0FFF0; border:12px solid #5F9EA0;">
    
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('images/' .$value['institute_logo']))) }}" style="position:absolute; width:320px; left:15rem; bottom:45px; opacity:.15; z-index:-1">
    
    <div style ="position:relative; color:#fff; background-color:#19686d; text-align: center; padding:30px 0; margin-bottom:20px;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('images/'.$value['institute_logo']))) }}" alt="" width="120px" style="position: absolute; left:40px; top: 25px">
            
        <div style="display: inline-block; vertical-align:middle">
            <span style="padding:0 20px; margin:0"><b style="font-size:1rem">{{$value['institute_name']}}</b></span>
            <p style="padding:0 20px; margin:0; font-size:.75rem">{{$value['institute_add']}}</p></div>
            <div style = "font-size:.75rem; margin:0px auto; margin-top:15px; padding:5px 10px; text-transform:uppercase; font-weight:bold; text-align: center; color: #19686d; background-color: #F0FFF0; width:15%; border-radius: 0.2rem;"><b>Admit card</b></div>
        </div>
        

        <div style="padding: 0 15px">
          <table style="width:95%; margin: 0 auto;">
            <tr>
                <td style="width:120px">
                    <label id="std_name">Name</b></label>
                </td>
                <td> : <b>{{$name}}</td>
                <td style="width:170px">
                    <label>Exam Name</label>
                </td>
                <td> : <b>{{$value['exam_name']}}</b></td>
            </tr>
            <tr>
                <td style="width:120px">
                    <label>Student ID</label>
                </td>
                <td> : {{$value['std_id']}}</td>
                <td style="width:170px">
                    <label>Academic Year </label>
                </td>
                <td> : {{$value['academic_yr']}}</td>
            </tr>
            <tr>
                <td style="width:120px">
                    <label>Roll No</label>
                </td>
                <td> : <b>{{$value['roll']}}</b></td>
                <td style="width:170px">
                    <label>Session</label>
                </td>
                @if(isset($value['session']) && !empty($value['session']))
                <td> : {{$value['session']}} </td>
                @else
                <td> : N/A</td>
                @endif
            </tr>
            <tr>
                <td style="width:120px">
                    <label>Class </label>
                </td>
                <td> : {{$value['class_name']}}-{{$value['shift_name']}}-{{$value['section_name']}}</td>
                <td style="width:170px">
                    <label>Date of Issue</label>
                </td>
                <td> : {{$date}}</td>
            </tr>
            <tr>
                <td style="width:120px">
                    <label>Group</label>
                </td>
                <td> : {{$value['startup_subcategory_name']}}</td>
                <td style="width:170px">
                    <label>Mobile No</label>
                </td>
                <td> : {{$value['mobile_no']}}</td>
            </tr>
          </table>
        </div>
        <div style="page-break-inside:avoid; height:45px; margin-top:50px; position: relative; padding-bottom:30px;">
            
            @if (!empty($value['left_title']) && !empty($value['left_sign']))
                <img  src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('sign/'.$value['left_sign']))) }}" style="position:absolute; top:0px; left:3rem; width:140px;height:60px " />
            @php
                $left_title = ucwords(strtolower($value['left_title']));
            @endphp
            <span style="position:absolute; top:70px; left:3rem; text-decoration:overline;">{{$left_title}}</span>    
            @endif            
            
            <span style="position:absolute; bottom:-40px; right:14rem; font-size:.6rem">Powered By: Academy-Institue Management System</span>
            
            
            @if (!empty($value['right_title']) && !empty($value['right_sign']))
                <img  src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('sign/'.$value['right_sign']))) }}" style="position:absolute; top:0px; right:3rem; width:140px; height:60px" />
            @php
                $right_title = ucwords(strtolower($value['right_title']));
            @endphp
            <span style="position:absolute; top:70px; right:3rem; text-decoration:overline;">{{$right_title}}</span>     
            @endif
           
        </div>

        
        @if($i==3)
        @php
            $i=0;
        @endphp
        <div class="pagebreak"></div>
        @endif
        
      </div>
    </div>
</div>
@endforeach


