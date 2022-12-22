@php
    ini_set('memory_limit', '1024M');
    $date = date('d/m/y');
    $i = 0;
    $data = json_decode($data, true);
@endphp


@php
        var_dump($data);
    @endphp
    
<div class="tabulation">
    <h3 class="text-center">School Name</h1>
        <p class="text-center">Adress</p>
        <p class="text-center">Tabulation Sheet</p>
        <table class="table table-bordered">
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
                    <td>2022</td>
                    <td>Nine-Morning-Science</td>
                    <td>Final</td>
                    <td>11</td>
                    <td>11</td>
                    <td>10</td>
                    <td>1</td>
                    <td>99%</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">Student ID</th>
                    <th rowspan="2">Name</th>
                    <th rowspan="2">Roll</th>
                    <th colspan="3">Bangla</th>
                    <th rowspan="2">Total Mark</th>
                    <th rowspan="2">GPA</th>
                    <th rowspan="2">Letter Grade</th>
                    <th rowspan="2">Merit Pos.</th>
                </tr>
                <tr>
                    <th>CQ</th>
                    <th>MCQ</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1001</td>
                    <td>Abdul Kalam</td>
                    <td>1</td>
                    <td>33</td>
                    <td>18</td>
                    <td>52</td>
                    <td>99</td>
                    <td>5.00</td>
                    <td>A+</td>
                    <td>1</td>
                </tr>
            </tbody>
        </table>
</div>