<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse !important;
        }

        @page {
            margin: 20px auto;
        }

        * {
            font-family: DejaVu Serif;
            font-size: .9rem;
        }
    </style>
</head>

<body>
    <div style="padding: 40px; margin: 20px; text-align: center; border: 6px dotted burlywood;">
        <h1 style="text-transform: capitalize; margin:0 auto"><b>{{$variable['common_detail']['institute_name']}}</b></h1>
        <p style="text-transform: capitalize; margin:0 auto; font-style: italic;">{{$variable['common_detail']['institute_add']}}</p>

           <img src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path('images/' .$variable['common_detail']['institute_logo']))) }}" style="position:absolute; width:200px; left:50%;  z-index:-1">


        <!-- Mark range table -->
        <div style=" overflow: auto;">
            <h2 style="border-bottom: 4px solid lightblue; max-width: 300px; padding: 4px; margin: 0 auto;"><b>Progress
                    Report</b></h2>
            <table style="border-collapse: collapse; display:block; float: right; clear:right" border="1"
                cellspacing="3">
                <tbody>
                    <tr>
                        <th>Range</th>
                        <th>Letter Grade</th>
                        <th>Grade Point</th>
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

        <!-- student info table -->
        <div style="margin: 20px 0;">
            <table style=" text-align: left; border-collapse: collapse;">
                <tbody>
                    @php
                        $failed_subject = 0;
                    @endphp
                    @foreach ($variable as $key => $item)
                        @if ($key != 'subject_details' && $key != 'common_detail')
                            @php
                                $studentID = $key;                       
                            @endphp
                            {{-- @php
               var_dump($item);    
               @endphp
               die(); --}}
                            <tr>
                                <th>Name of Student</th>
                                <td > : {{ $item['student_name'] }}</td>
                            </tr>
                            <tr>
                                <th>Father's Name</th>
                                <td> : {{ $variable['common_detail']['father_name'] }}</td>
                            </tr>
                            <tr>
                                <th>Mother's Name</th>
                                <td> : {{ $variable['common_detail']['mother_name'] }}</td>
                                <th>Exam</th>
                                <td> : {{ $item['examName'] }}</td>
                            </tr>
                            <tr>
                                <th>Student Id</th>
                                <td> : {{ $key }}</td>
                                <th>Year</th>
                                <td> : {{ $variable['common_detail']['academic_yr'] }}</td>
                            </tr>
                            <tr>
                                <th>Roll</th>
                                <td> : {{ $item['student_roll'] }}</td>
                                <th>Session</th>
                                <td> : {{ $variable['common_detail']['session_name'] }}</td>
                            </tr>
                            <tr>
                                <th>Class</th>
                                <td> : {{ $variable['common_detail']['class_name'] }} -
                                    {{ $variable['common_detail']['shift_name'] }} -
                                    {{ $variable['common_detail']['section_name'] }}</td>
                                <th>Group</th>
                                <td> : {{ $variable['common_detail']['group_name'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>


        @php
            foreach ($variable['subject_details'] as $key => $value) {
                if (!isset($colspan)) {
                    $colspan = count($variable['subject_details'][$key]);
                    $subjectTospan = $key;
                } elseif ($colspan < count($variable['subject_details'][$key])) {
                    $colspan = count($variable['subject_details'][$key]);
                    $subjectTospan = $key;
                }
            }
        @endphp

        <!-- Obtained Marksheet table -->
        <div>
            <table style="width:100%; border-collapse: collapse;" border="1" cellpadding="3">
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
                        @foreach ($variable['subject_details'][$subjectTospan] as $examcode)
                            <td>{{ $examcode }}</td>
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
                                    <td>total Marks</td>

                                    @foreach ($subjects as $sub_info_key => $sub_info_detail)
                                        @foreach ($variable['subject_details'][$subjectTospan] as $examcode)
                                            @if ($examcode == $sub_info_key)
                                                <td>{{ $sub_info_detail }}</td>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    <td>{{ $subjects['total'] }}</td>
                                    <td>{{ $subjects['letter_point'] }}</td>
                                    <td>{{ $subjects['grade_point'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="text-align:left; margin: 20px 0;">
            <!-- result summary table -->
            <table style="display: inline-block;  border-collapse: collapse;" border="1" cellpadding="5" cellspacing="5">
                <tbody>
                    <tr>
                        <th>Result Status</th>
                        <td> </td>
                    </tr>
                    <tr>
                        <th>Class Position</th>
                        <td> </td>
                    </tr>
                    <tr>
                        <th>GPA W/O 4th</th>
                        <td>{{ isset($variable[$studentID]['gpa_except_opt']) ? $variable[$studentID]['gpa_except_opt'] : '-' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Failed Subjects</th>
                        <td>{{ $failed_subject }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Remarks Table -->
            <table style="display: inline-block; margin:0 20px; border-collapse: collapse;" border="1">
                <tbody>
                    <tr>
                        <th>Moral and Behavior Evaluation</th>
                        <th>Co-Curricular Activities</th>
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
                            <textarea name="" id="" rows="5" style="width: 100%; padding:0; margin:0"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="text-align: left; overflow-y: auto;">
            <p
                style="border-top: 1px dashed gray; display:block; float: left; clear: left; margin:5px; padding: 60px; padding-top: 0; padding-bottom: 0; margin-top: 100px;">
                Class Teacher</p>
            <p
                style="display:block; float:right; border-top: 1px dashed gray; margin:5px; padding: 60px; padding-top: 0;
         padding-bottom: 0; margin-top: 100px; clear: right;">
                Principal</p>
        </div>
    </div>
</body>

</html>
