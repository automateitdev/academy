<div class="header">
    <div class="top-nav">
        <div class="container">
            <div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="top-nav-left"> <i style="color:#00bcd4;" class="fa fa-envelope" aria-hidden="true"></i> tongi@gmail.com <i style="color:#00bcd4;" class="fa fa-phone-square" aria-hidden="true"></i>  01302738495 (office)  </div>
				</div>
				<div class="col-md-6 col-sm-6">
					<ul style="float: right;" class="nav">
						<li class="nav-item"> <a style="color:#ffffffd6;" class="nav-link active" href="contact.php"> Contact </a> </li>
						<li class="nav-item"> <a style="color:#ffffffd6;" class="nav-link active" href="../e-result"> e-Result</a> </li>
						<li class="nav-item"> <a style="color:#ffffffd6;" class="nav-link" href="webmail">Web Mail</a> </li>
						<li class="nav-item">
                        @if (Route::has('login'))
                            <div class="login_part">
                                @auth
                                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500">Home</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500">Log in</a>

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
            <div class="col-md-12 col-sm-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="{{asset('images/logo.png')}}" alt="" width="100" height="60" class="d-inline-block align-text-top">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @foreach($categories as $item)
                                <li class="nav-item dropdown">
                                    <a class="nav-link ecom_cat" data-value="{{$item->id}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{$item->name}}
                                    </a>
                                    <ul class="dropdown-menu subcatEcom" aria-labelledby="navbarDropdown">
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
</div>