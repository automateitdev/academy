<div class="info">
    <div class="container">
        @foreach($students as $student)
        @if($student->std_id == $std_id)
        <p>Name : {{$student->name}}</p>
        @endif
        @endforeach
    </div>
</div>