<div class="container-fluid py-5">
    <div class="row align-items-center">
        <div id="carouselAcademy" class="carousel slide col-md-8" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders as $item)
                    <div class="carousel-item active">
                        <img src="{{ asset('images/carousel/' . $item->slider_img) }}" class="d-block w-100"
                            alt="...">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselAcademy" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselAcademy" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="card col-md-4 p-2 "
                    style="background-color:#F1F8E9; border:6px solid #fff; border-radius:5px; color:#19686d">
                    <div class="text-center p-2">
                        <i class="fa-solid fa-bullhorn fa-2xl"></i>
                        <br>
                        <a href="" class="d-block text-uppercase py-2" style="font-weight: 700">Notice</a>
                    </div>
                </div>
                <div class="card col-md-4 p-2 "
                    style="background-color:#F1F8E9; border:6px solid #fff; border-radius:5px; color:#19686d">
                    <div class="text-center p-2">
                        <i class="fa-solid fa-square-poll-horizontal fa-2xl"></i>
                        <br>
                        <a href="" class="d-block text-uppercase py-2" style="font-weight: 700">Results</a>
                    </div>
                </div>
                <div class="card col-md-4 p-2 "
                    style="background-color:#F1F8E9; border:6px solid #fff; border-radius:5px; color:#19686d">
                    <div class="text-center p-2">
                        <i class="fa-solid fa-table fa-2xl"></i>
                        <br>
                        <a href="" class="d-block text-uppercase py-2" style="font-weight: 700">Routine</a>
                    </div>
                </div>
                <div class="card col-md-4 p-2 "
                    style="background-color:#F1F8E9; border:6px solid #fff; border-radius:5px; color:#19686d">
                    <div class="text-center p-2">
                        <i class="fa-solid fa-landmark fa-2xl"></i>
                        <br>
                        <a href="" class="d-block text-uppercase py-2" style="font-weight: 700">Departments</a>
                    </div>
                </div>
                <div class="card col-md-4 p-2 "
                    style="background-color:#F1F8E9; border:6px solid #fff; border-radius:5px; color:#19686d">
                    <div class="text-center p-2">
                        <i class="fa-solid fa-person-chalkboard fa-2xl"></i>
                        <br>
                        <a href="" class="d-block text-uppercase py-2" style="font-weight: 700">Teachers</a>
                    </div>
                </div>
                <div class="card col-md-4 p-2 "
                    style="background-color:#F1F8E9; border:6px solid #fff; border-radius:5px; color:#19686d">
                    <div class="text-center p-2">
                        <i class="fa-solid fa-people-group fa-2xl"></i>
                        <br>
                        <a href="" class="d-block text-uppercase py-2" style="font-weight: 700">Students</a>
                    </div>
                </div>
                <div class="card col-md-4 p-2 "
                    style="background-color:#F1F8E9; border:6px solid #fff; border-radius:5px; color:#19686d">
                    <div class="text-center p-2">
                        <i class="fa-solid fa-money-check fa-2xl"></i>
                        <br>
                        <a href="" class="d-block text-uppercase py-2" style="font-weight: 700">Payment</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>



<!-- <div class="carousel-top">
    <h1 class="col_name">Tongi Govt. College, Gazipur</h1>
    <a href="#" class="his_btn">
        <button class="btn">History</button>
    </a>
</div> -->
