@foreach($allData as $data)
    @foreach($data['data'] as $key=>$value)
            @php 
            var_dump($data['data']['name']);
            @endphp
    @endforeach
@endforeach


<div class="card" style="width: 45rem; border-color: blue; border-width: 0.5rem;">
        <div style = "text-align: center; background-color: skyblue;">
            <p><b>Bangladesh Marine Academy. Sylhet</b></p>
            <p>Sylhet sadar, Sylhet</p>
            <div class="container" style = "background-color: blue; width:20%; border-radius: 0.5rem;"><b style="text-align: center; color: white;">Admit card</b></div>
        </div>
        <div class="card-body">
          <table width = "100%">
            <tr>
                <td>
                    <label id="std_name">Name: </label>
                </td>
                <td>
                    <label>Exam name: </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Student ID: </label>
                </td>
                <td>
                    <label>Academic Year: </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Roll No: </label>
                </td>
                <td>
                    <label>Session: </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Class: </label>
                </td>
                <td>
                    <label>Date of Issue: </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Department/Section</label>
                </td>
                <td>
                    <label>Mobile No: </label>
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