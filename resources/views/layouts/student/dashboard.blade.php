<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/student.css') }}" rel="stylesheet">

</head>

<body>
    <div class="std_portal" style="min-height:100vh; background-color:#b1dae7">
        <div class="container pt-2 px-5" style="color:#fff; border-radius:5px 5px 0 0; background-color: #19686d">
            <div class="row align-items-center">
                <div class="my-2 col-md-2">
                    <img src="{{ asset('images/avatar.png') }}" alt="" class="img-fluid rounded">
                </div>
                <div class="my-2 col-md-10 d-flex justify-content-between align-items-center">
                    <ul class="d-block m-0 ml-2" style="list-style: none">
                        <li>
                            <span class="text-warning" style="font-weight:bold">Name: </span>
                            {{ $student->name }}
                        </li>
                        <li class="text-lg"><span class="text-warning" style="font-weight:bold">Student ID:
                            </span> {{ $student->std_id }}</li>
                        <li class="text-lg"><span class="text-warning" style="font-weight:bold">Institute ID:
                            </span> {{ $student->institute_id }}</li>
                    </ul>

                    <button class="btn btn-warning">Logout</button>


                </div>
            </div>
        </div>
        <div class="container py-5" style="background-color: #fff; border-radius:0 0 5px 5px;">
            <div class="row d-flex justify-content-around">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="col-md-12 pb-2">
                    <div class="nav nav-pills m-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link std_tab active" id="v-pills-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-info" type="button" role="tab" aria-controls="v-pills-info" aria-selected="true">Information</button>
                        <button class="nav-link std_tab" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false">Payment</button>
                        <button class="nav-link std_tab" id="v-pills-report-tab" data-bs-toggle="pill" data-bs-target="#v-pills-report" type="button" role="tab" aria-controls="v-pills-report" aria-selected="false">Report</button>
                        <button class="nav-link std_tab" id="v-pills-result-tab" data-bs-toggle="pill" data-bs-target="#v-pills-result" type="button" role="tab" aria-controls="v-pills-result" aria-selected="false">Result</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel" aria-labelledby="v-pills-info-tab">
                            @include('layouts.student.info')
                        </div>
                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                            @include('layouts.student.payment')
                        </div>
                        <div class="tab-pane fade" id="v-pills-report" role="tabpanel" aria-labelledby="v-pills-report-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-result" role="tabpanel" aria-labelledby="v-pills-result-tab">...</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{ asset('js/admin_dash.js') }}"></script>
<script src="{{ asset('js/payment.js') }}"></script>

</html>