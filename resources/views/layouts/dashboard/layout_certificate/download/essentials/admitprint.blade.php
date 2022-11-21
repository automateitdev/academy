
@foreach ($data as $value)
<div class="card" style="width: 45rem; border-color: blue; border-width: 0.5rem;">
        <div style = "text-align: center; background-color: skyblue;">
            <p><b>{{$value['institute_name']}}</b></p>
            <p>{{$value['institute_add']}}</p>
            <div class="container" style = "text-align: center; color: white; background-color: blue; width:20%; border-radius: 0.5rem;"><b>Admit card</b></div>
        </div>
        <div class="card-body">
          <table width = "100%">
            <tr>
                <td>
                    <label id="std_name">Name: {{$value['name']}}</label>
                </td>
                <td>
                    <label>Exam name: {{$value['exam_name']}}</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Student ID: {{$value['std_id']}}</label>
                </td>
                <td>
                    <label>Academic Year: {{$value['academic_yr']}}</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Roll No: {{$value['roll']}}</label>
                </td>
                <td>
                    <label>Session: {{$value['session']}}</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Class: {{$value['class_name']}}-{{$value['shift_name']}}-{{$value['section_name']}}</label>
                </td>
                <td>
                    @php 
                        $date = \Carbon\Carbon::now()->format('d-m-Y');
                    @endphp
                    <label>Date of Issue: 
                        {{$date}}
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Group: {{$value['group']}}</label>
                </td>
                <td>
                    <label>Mobile No: {{$value['mobile_no']}}</label>
                </td>
            </tr>
          </table>
           
        </div>
        <div class="row">
            <span style="text-decoration:overline dotted;  margin-left: 30px;">Class Teacher</span>
            <span style="font-size: 0.8rem; margin-left: 50px; margin-top: 6px;">Powered By: Academy-Institue Management System</span>
            <span style="text-decoration:overline dotted; margin-left: 100px;">HeadMaster</span>
        </div>
        
      </div>
    </div>
</div>
@endforeach


