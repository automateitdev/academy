<div class="info">
    <div class="container">

        <div class="my-2 col-md-2">
            <img src="{{ asset('images/avatar.png') }}" alt="" class="img-fluid rounded" style="max-width: 200px">
        </div>

        @foreach ($students as $student)
            @if ($student->std_id == $std_id && $student->institute_id == $ins_id)
                <p>Name : {{ $student->name }}</p>
            @endif
        @endforeach
    </div>
</div>
