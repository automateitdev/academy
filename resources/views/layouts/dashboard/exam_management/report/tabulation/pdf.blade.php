@php
    ini_set('memory_limit', '1024M');
    $date = date('d/m/y');
    $i = 0;
    $data = json_decode($data, true);
    
@endphp

<style>
    @page { size: legal landscape;
            margin: 2px;
            }
</style>
<div class="tabulation">
    <h3 class="text-center">{{$data['common_detail']["institute_name"]}}</h1>
        <p class="text-center">{{$data['common_detail']["institute_add"]}}</p>
        <p class="text-center">Tabulation Sheet</p>
        <table class="table table-bordered" style="text-align:center;" border="2px" cellpadding="5">
            <thead>
                <tr>
                    <th>Academic Year</th>
                    <th>Class-Shift-Section</th>
                    <th>Exam</th>
                    <th>Total Students</th>
                    <th>Exam Participants</th>
                    <th>Total Pass</th>
                    <th>Total Fail</th>
                    <th>Pass %</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$data['common_detail']["academic_yr"]}}</td>
                    <td>{{$data['common_detail']["class_name"].'-'.$data['common_detail']["shift_name"].'-'.$data['common_detail']["section_name"]}}</td>
                    <td>{{$data['common_detail']["exam_name"]}}</td>

                    <td>{{$data['common_detail']["total_student"]}}</td>
                    <td>{{$data['common_detail']["participants"]}}</td>
                    <td>{{$data['common_detail']["total_pass"]}}</td>
                    <td>{{$data['common_detail']["total_fail"]}}</td>
                    <td>{{$data['common_detail']["pass_percentage"]}} %</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered" style="text-align:center;" border="2px" cellpadding="5">
            <thead>
                <tr>
                    <th rowspan="2">Student ID</th>
                    <th rowspan="2">Name</th>
                    <th rowspan="2">Roll</th>
                @foreach($data['subject_details'] as $dkey => $yy)
                     @php 
                        $colspan = count($yy);
                     @endphp

                    <th colspan="{{$colspan+1}}">{{$dkey}}</th>
                @endforeach 
                    <th rowspan="2">Total Mark</th>
                    <th rowspan="2">GPA</th>
                    <th rowspan="2">Letter Grade</th>
                    <th rowspan="2">Merit Pos.</th>
                </tr>
                <tr>
                @foreach($data['subject_details'] as $dkey => $yy)
                    @foreach($yy as $examcode)
                        <th>{{$examcode}}</th>
                    @endforeach 
                    <th>Total</th>
                @endforeach 
                
                </tr>
            </thead>
            <tbody>
            @foreach($data as $key => $value)
                   @if($key != "common_detail" && $key != "subject_details")
                <tr>
                    <td>{{$key}}</td>

                    <td>{{$value['student_name']}}</td>
                    <td>{{$value['student_roll']}}</td>
                    @foreach($data['subject_details'] as $dkey => $yy)
                        @foreach($value as $subname => $subcode)                      
                            @if($subname == $dkey)
                                @foreach($yy as $examcode)
                                    @foreach($subcode as $subjectCode => $subMarks)
                                        @if($examcode == $subjectCode)
                                        <td>{{$subMarks}}</td>
                                        @endif
                                    @endforeach 
                                @endforeach 
                                <td> <b>{{$subcode['total']}}</b> </td>
                            @endif
                        @endforeach 
                    @endforeach 
                    <td>{{$value['grand_total']}}</td>
                    <td>{{$value['GPA']}}</td>
                    <td>{{$value['letter_grade']}}</td>
                    <td>{{$value['merit_pos']}}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
</div>