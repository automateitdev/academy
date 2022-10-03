<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-title">
                <i class="fa fa-clone" aria-hidden="true"></i>
                Departments
            </h5>
            <div class="d-flex flex-wrap">
                @foreach ($departments as $dept)
                    <div class="m-1 btn btn-sm btn-info">
                        <a href="{{ route('department', $dept) }}"
                            style="color:#fff; text-transform: capitalize; font-size:larger; font-weight:regular">
                            {{ $dept }} </a>
                    </div>
                @endforeach
                <br>
            </div>
        </div>
    </div>
</div>
