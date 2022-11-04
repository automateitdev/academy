<table class="table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>Roll No.</th>
                                                <th>Name</th>
                                                <th>Group</th>
                                                <th>Category</th>
                                                <th>Process</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $student)
                                                @if($student->institute_id ==  Auth::user()->institute_id)
                                                <tr>
                                                    <td>{{$student->std_id}}</td>
                                                    <td>{{$student->roll}}</td>
                                                    <td>{{$student->name}}</td>
                                                    <td>{{$student->group_id}}</td>
                                                    <td>{{$student->std_category_id}}</td>
                                                    <td>+</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>