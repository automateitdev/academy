@php
    ini_set('memory_limit', '1024M');
    $date = date('d/m/y');
    $i = 0;
    $variable = json_decode($data, true);
@endphp


<head>
    <meta charset="UTF-8">
    <style>
    
        @page{
          margin:20px;
        }
        body{
          background-color:azure;
        }
        table {
            border-collapse: collapse;
            display: inline-table;
        }

        table > tr > td {
          margin-right: 40px;
        }

        * {
            font-family: DejaVu Serif;
            font-size: .8rem;
        }

        table tr td {
            color: black;
            border-color:black;
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
    </style>

<div style="height:90%; padding:30px; margin:40px; border:6px groove burlywood; overflow:auto;" class="pagebreak">
  <div style="text-align:center">
    <h1 style="text-transform: capitalize; margin:0 auto"><b>{{ $variable['common_detail']['institute_name'] }}</b></h1>
    <p style="text-transform: capitalize; margin:0 auto; font-style: italic;">{{ $variable['common_detail']['institute_add'] }}</p>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('images/' . $variable['common_detail']['institute_logo']))) }}" style=" margin: 10px auto; width:100px;">
    <h2 style=" border-bottom: 4px solid lightblue; max-width: 300px; padding: 4px; margin: 0 auto;"><b>Progress Report</b></h2>
  </div>  
  <br></br>
  <div style="overflow:auto">  
    <!-- student info table -->
    <div style="float:left; clear:both">
        <table style="text-align:left;">
            <tbody>
                @php
                    $failed_subject = 0;
                @endphp
                @foreach ($variable as $key => $item)
                    @if ($key != 'subject_details' && $key != 'common_detail')
                        @php
                            $studentID = $key;
                        @endphp
                        <tr>
                            <th style = "text-align:left">Name of Student</th>
                            <td> : {{ $item['student_name'] }}</td>
                        </tr>
                        <tr>
                            <th style = "text-align:left">Father's Name</th>
                            <td> : {{ $variable['common_detail']['father_name'] }}</td>
                        </tr>
                        <tr>
                            <th style = "text-align:left">Mother's Name</th>
                            <td> : {{ $variable['common_detail']['mother_name'] }}</td>
                            <th style = "text-align:left">Exam</th>
                            <td> : {{ $item['examName'] }}</td>
                        </tr>
                        <tr>
                            <th style = "text-align:left">Student Id</th>
                            <td> : {{ $key }}</td>
                            <th style = "text-align:left">Year</th>
                            <td> : {{ $variable['common_detail']['academic_yr'] }}</td>
                        </tr>
                        <tr>
                            <th style = "text-align:left">Roll</th>
                            <td> : {{ $item['student_roll'] }}</td>
                            <th style = "text-align:left">Session</th>
                            <td> : {{ $variable['common_detail']['session_name'] }}</td>
                        </tr>
                        <tr>
                            <th style = "text-align:left">Class</th>
                            <td> : {{ $variable['common_detail']['class_name'] }} -
                                {{ $variable['common_detail']['shift_name'] }} -
                                {{ $variable['common_detail']['section_name'] }}</td>
                            <th style = "text-align:left">Group</th>
                            <td> : {{ $variable['common_detail']['group_name'] }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>    
    </div>
    
    <!-- Mark range table -->
    <div style="float:right; clear:both">
        <table style="text-align:center" border="1" cellspacing="5">
            <tbody>  
                <tr>
                    <th style="padding:10px 20px">Range</th>
                    <th style="padding:10px 20px">Letter Grade</th>
                    <th style="padding:10px 20px">Grade Point</th>
                </tr>
                <tr>
                    <td>80-100</td>
                    <td>A+</td>
                    <td>5.00</td>
                </tr>
                <tr>
                    <td>79-75</td>
                    <td>A</td>
                    <td>5.00</td>
                </tr>
                <tr>
                    <td>74-60</td>
                    <td>A-</td>
                    <td>5.00</td>
                </tr>
                <tr>
                    <td>59-50</td>
                    <td>B</td>
                    <td>5.00</td>
                </tr>
                <tr>
                    <td>58-36</td>
                    <td>C</td>
                    <td>5.00</td>
                </tr>
                <tr>
                    <td>35-57</td>
                    <td>D</td>
                    <td>5.00</td>
                </tr>
                <tr>
                    <td>34-0</td>
                    <td>F</td>
                    <td>5.00</td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
<br></br>

    @php
    $examGranTotal = 0;
        foreach ($variable['subject_details'] as $key => $value) {
            if (!isset($colspan)) {
                $colspan = count($variable['subject_details'][$key]);
                if($key != 'fullmarks'){
                  $subjectTospan = $key;
                }
            } elseif ($colspan < count($variable['subject_details'][$key])) {
                $colspan = count($variable['subject_details'][$key]);
                if($key != 'fullmarks'){
                  $subjectTospan = $key;
                }
            }
        }
        $colspan = $colspan-1;
    @endphp

    <!-- Obtained Marksheet table -->
    <div style="margin:60px auto; text-align:left; clear:both; overflow:auto">
        <table style="width:100%;" border="1" cellpadding="3">
            <tbody>
                <tr>
                    <th rowspan="2">Name of Subjects</th>
                    <th rowspan="2">Full Marks</th>
                    <th colspan={{ $colspan }}>Obtaining Marks</th>
                    <th rowspan="2">Total Marks</th>
                    <th rowspan="2">Letter Grade</th>
                    <th rowspan="2">Grade Point</th>
                </tr>


                <!-- Examcode row -->
                <tr>
                    @foreach ($variable['subject_details'][$subjectTospan] as $key => $examcode)
                      @if($key != 'fullmarks')
                          <td style="text-align:center;"><b>{{ $examcode }}</b></td>
                      @endif
                    @endforeach
                </tr>


                @foreach ($variable as $key => $item)
                    @if ($key != 'subject_details' && $key != 'common_detail')
                        @foreach ($item['subjects'] as $subname => $subjects)
                            @php
                                if ($subjects['grade_point'] == 0) {
                                    $failed_subject++;
                                }
                            @endphp
                            <tr>
                                <td>{{ $subname }}</td>
                                <td style="text-align:center">{{$variable['subject_details'][$subname]['fullmarks']}}</td>
                                @php
                                  $examGranTotal += $variable['subject_details'][$subname]['fullmarks'];
                                @endphp
                                @foreach ($subjects as $sub_info_key => $sub_info_detail)
                                    @foreach ($variable['subject_details'][$subjectTospan] as $examcode)
                                        @if ($examcode == $sub_info_key)
                                            <td style="text-align:center">{{ $sub_info_detail }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                                <td style="text-align:center">{{ $subjects['total'] }}</td>
                                <td style="text-align:center">{{ $subjects['letter_point'] }}</td>
                                <td style="text-align:center">{{ $subjects['grade_point'] }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color:seagreen;">
                          <td style="text-align:center; color:white">Total Exam Marks</td>
                          <td style="text-align:center; color:white">{{$examGranTotal}}</td>
                          <td style="text-align:center; color:white" colspan={{ $colspan }}>Obtained Marks and GPA</td>
                          <td style="text-align:center; color:white">{{ $item['grand_total'] }}</td>
                          <td style="text-align:center; color:white">{{ $item['letter_grade'] }}</td>
                          <td style="text-align:center; color:white">{{ $item['GPA'] }}</td>
                        <tr>  
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    
    <br></br>
    <div style="clear:both; overflow:auto">
        <!-- result summary table -->
        <table style="text-align:center" border="1" cellpadding="5">
            <tbody>
                <tr>
                    <th>Result Status</th>
                    <td style="padding:10px"></td>
                </tr>
                <tr>
                    <th>Class Position</th>
                    <td style="padding:10px"> </td>
                </tr>
                <tr>
                    <th>GPA w/o 4th</th>
                    <td style="padding:10px">{{ isset($variable[$studentID]['gpa_except_opt']) ? $variable[$studentID]['gpa_except_opt'] : '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Failed Subjects</th>
                    <td style="padding:10px 40px">{{ $failed_subject }}</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Remarks Table -->
        <table style="text-align:center" border="1">
            <tbody>
                <tr>
                    <th style="padding:10px 20px">Moral and Behavior Evaluation</th>
                    <th style="padding:10px 20px">Co-Curricular Activities</th>
                </tr>
                <tr>
                    <td>Excellent</td>
                    <td>Sports</td>
                </tr>
                <tr>
                    <td>Good</td>
                    <td>Cultural Function</td>
                </tr>
                <tr>
                    <td>Average</td>
                    <td>Scout/BNCC</td>
                </tr>
                <tr>
                    <td>Poor</td>
                    <td>Olympiad</td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: center;">Comments</th>
                </tr>
                <tr>
                    <td colspan="2" cellpadding="0">
                        <textarea name="" id="" rows="5" style="width: 100%; background:transparent; padding:20px 0; margin:0"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
        <div style="position:absolute; width:90%; left:5%; bottom:50; text-align:left; overflow:auto;">
        <p style="width:200px; display:inline-block; text-align:center; border-top: 1px dashed gray; margin:5px; padding: 60px; padding-top: 0; padding-bottom: 0; margin-top: 100px;">
            Class Teacher</p>
        <p style="width:200px; display:inline-block; text-align:center; float:right; border-top:1px dashed gray; margin:5px; padding: 60px; padding-top: 0;
         padding-bottom: 0; margin-top:100px; clear:right;">
            Principal</p>
    </div>
</div>

