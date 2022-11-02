<div class="header">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="top-nav-left text-sm">
                        @foreach($users as $item)
                        <span>EIIN No. {{$item->EIIN_number}}</span>
                        <i style="color:#3091f2 ;" class="fa fa-envelope" aria-hidden="true"></i>
                        <span>{{$item->email}}</span>&nbsp;&nbsp;
                        <i style="color:#3091f2 ;" class="fa fa-phone-square" aria-hidden="true"></i>
                        <span>{{$item->contact_no}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <ul style="float: right;" class="nav">
                        <li class="nav-item"> <a style="color:#ffffffd6;" class="nav-link active" href="{{route('student.auth.index')}}">
                                Payment </a> </li>
                        <li class="nav-item"> <a style="color:#ffffffd6;" class="nav-link active" href="contact.php">
                                Contact </a> </li>
                        <li class="nav-item">
                            @if (Route::has('login'))
                            <div class="login_part">
                                @auth
                                <a href="{{ route('home') }}" class="text-sm text-gray-700 dark:text-gray-500">Dashboard</a>
                                @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500">Log
                                    in</a>

                                @if (Route::has('register'))
                                <!-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a> -->
                                @endif
                                @endauth
                            </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-down">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="left_logo">
                        <img src="{{asset('images/logo/1665899289.png')}}" alt="" width="100px" height="80px">
                    </div>
                </div>
                <div class="col-md-8 text-center">
                    <h1>dhobakhola coronation school & college</h1>
                    <p class="address">Tongi, Gazipur, Dhaka</p>
                </div>
                <div class="col-md-2">
                    <div class="right_logo">
                        <img src="{{asset('images/logo/1665899289.png')}}" alt="" width="100px" height="80px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu">
        <div class="container">
            <div class="col-md-12 col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @foreach ($categories as $item)
                                <li class="nav-item dropdown">
                                    <a class="nav-link ecom_cat" data-value="{{ $item->id }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $item->name }}
                                    </a>
                                    <ul class="dropdown-menu subcatEcom  type_{{ $item->id }}" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#"></a></li>
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="news">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 text-center dfr">
                    <p>Latest News</p>
                </div>
                <div class="col-md-9">
                    <marquee behavior="alternate"><span class="marquee">This is a marquee!</span></marquee>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="nav-down">
        <div class="container">
            <div class="col-md-12 col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{route('landingpage')}}">
                        @php
                            $heee = DB::table('basics')->latest('id')->first();
                        @endphp
                            @if($heee->logo)
                            <img src="{{ asset('images/logo/'. $heee->logo) }}" alt="" width="100" height="60"
                                class="d-inline-block align-text-top">
                            @endif
                        </a>
                        @foreach($users as $item)
                        <a href="{{route('landingpage')}}" class="clg_name">{{$item->institute_name}}</a>
                        @endforeach
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @foreach ($categories as $item)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link ecom_cat" data-value="{{ $item->id }}" href="#"
                                            id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            {{ $item->name }}
                                        </a>
                                        <ul class="dropdown-menu subcatEcom  type_{{ $item->id }}"
                                            aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#"></a></li>
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div> -->
</div>