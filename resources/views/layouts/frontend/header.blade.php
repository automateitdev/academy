<div class="header">
    <div class="top-nav" style="background-color: #19686d">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="nav-item text-sm">
                        <ul class="nav text-sm">
                            @foreach ($users as $item)
                                <li class="nav-link" style="color:#ffffff"><span>EIIN No.
                                        {{ $item->EIIN_number }}</span>
                                </li>
                                <li class="nav-link" style="color:#ffffff">
                                    <i style="color:#ffffff ;" class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>{{ $item->email }}</span>&nbsp;&nbsp;
                                </li>
                                <li class="nav-link" style="color:#ffffff">
                                    <i style="color:#ffffff ;" class="fa fa-phone-square" aria-hidden="true"></i>
                                    <span>{{ $item->contact_no }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <ul style="float: right;" class="nav">
                        <li class="nav-item"> <a style="color:#ffffff;" class="nav-link "
                                href="{{ route('student.auth.index') }}">
                                Payment </a> </li>
                        <li class="nav-item"> <a style="color:#ffffff;" class="nav-link " href="contact.php">
                                Contact </a> </li>
                        <li class="nav-item">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ route('home') }}" class="nav-link " style="color:#ffffff;">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="nav-link " style="color:#ffffff;">Log
                                        in</a>

                                    @if (Route::has('register'))
                                        <!-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a> -->
                                    @endif
                                @endauth

                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-4 pb-4 d-sm-none d-md-block" style="background-color: #FBFBFB">
        <div class="d-flex justify-content-around text-center align-items-end">
            <a class="" href="{{ route('landingpage') }}">
                
                @foreach($basics as $basic)
                    <img src="{{ asset('images/logo/' . $basic->logo) }}" alt="" width="100"
                        class="d-inline-block align-text-top">
                @endforeach
            </a>
            @foreach ($users as $item)
                <a href="{{ route('landingpage') }}" class="">

                    <h1 class="text-xl" style="color:#19686d; font-weight:bold">{{ $item->institute_name }}</h1>

                </a>
            @endforeach
            <a class="" href="{{ route('landingpage') }}">
                @foreach($basics as $basic)
                    <img src="{{ asset('images/logo/' . $basic->logo) }}" alt="" width="100"
                        class="d-inline-block align-text-top">
                @endforeach
            </a>
        </div>
    </div>

        <div class="news">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-2 py-2 text-center" style="background-color: #b1dae7">
                    Latest Notice
                </div>
                @foreach($notices as $key=>$notice)
                @php
                if($key == 1)
                {
                    break;
                }
                @endphp
                <marquee class="col-md-10 py-2" style="background-color: #F1F8E9"><span
                        class="marquee">{{$notice->name}}</span>
                </marquee>
                @endforeach
            </div>
        </div>
    </div>
    <div class="menu" style="background-color:#19686d">
        <div class="container">
            <div class="col-md-12 col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-dark ">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @foreach ($categories as $item)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" data-value="{{ $item->id }}"
                                            href="{{$item->link_name}}" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            {{ $item->name }}
                                             @if(count($item->subcategories) > 0)
                                                <span><i class="fa fa-chevron-down"></i></span>
                                             @endif
                                        </a>
                                        
                                        @if(count($item->subcategories) > 0)
                                        <ul class="dropdown-menu" style="background-color:#f1f8e9"
                                            aria-labelledby="navbarDropdown">
                                            @foreach($item->subcategories as $subcat)
                                            @php 
                                            $link = strtolower('/'.$item->name.'/'. $subcat->subcat_link.'/'.$subcat->id);
                                            @endphp
                                            <li class="text-center"><a class="dropdown-item" href="{{$link}}">{{$subcat->subcat_name}}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
