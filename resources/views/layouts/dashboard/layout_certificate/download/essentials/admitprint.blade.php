<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page { 
            margin:20px auto;
        }

        *{ font-family: DejaVu Sans;
            font-size: .85rem;}
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
      font-family: "DejaVu Sans";
      font-style: normal;
      font-weight: normal;
      src: url('fonts/DejaVuSans.ttf') format('truetype');
    }
    
    </style>
</head>

@php
    $date = date('d/m/y');
    $i = 0;
@endphp

@foreach ($data as $value)

@php
    $i++;
    $name = ucwords(strtolower($value['name']));
@endphp

<div class="card" style="page-break-inside:avoid; position: relative; vertical-align:middle; width:45rem; margin:0 auto; margin-bottom:20px; height:520px; background-color:#F0FFF0; border:15px solid #ddd;">
    
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo/'.$value['institute_logo']))) }}" style="position:absolute; width:250px; left:17rem; bottom:55px; opacity:.15; z-index:-1">
    
    <div style ="position:relative; color:#fff; background-color:#19686d; text-align: center; padding:40px 0 20px 0; margin-bottom:20px;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo/'.$value['institute_logo']))) }}" alt="" width="80px" style="vertical-align:middle;">
            
        <div style="display: inline-block; vertical-align:middle"><h3 style="display:inline-block; padding:0 20px; margin:0"><b>{{$value['institute_name']}}</b></h3>
            <p style="padding:0 20px; margin:0;">{{$value['institute_add']}}</p></div>
            <div style = "font-size:.75rem; margin:0px auto; padding:5px 10px; text-transform:uppercase; font-weight:bold; text-align: center; color: #19686d; background-color: #F0FFF0; width:15%; border-radius: 0.2rem;"><b>Admit card</b></div>
        </div>
        

        <div style="padding: 0 15px">
          <table style="width:95%; margin: 0 auto;">
            <tr>
                <td style="width:120px">
                    <label id="std_name">Name</b></label>
                </td>
                <td> : <b>{{$name}}</td>
                <td style="width:170px">
                    <label>Exam name</label>
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
                <td> : {{$value['session']}} </td>
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
                <td> : {{$value['group']}}</td>
                <td style="width:170px">
                    <label>Mobile No</label>
                </td>
                <td> : {{$value['mobile_no']}}</td>
            </tr>
          </table>
        </div>
        <div style="page-break-inside:avoid; height:60px; margin-top: 50px; position: relative; padding-bottom:30px;">
            
            <span style="position:absolute; top:50px; left:3rem; text-decoration:overline;">Class Teacher</span>
            
            <span style="position:absolute; bottom:-10px; right:13.5rem; font-size:.6rem">Powered By: Academy-Institue Management System</span>
            
            <img  src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/sign/'.$value['sign']))) }}" style="position:absolute; top:-10px; right:2rem; width:200px" />
            <span style="position:absolute; top:50px; right:3rem; text-decoration:overline;">HeadMaster</span>
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


