<div id="carouselAcademy" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach($sliders as $item)
      @if($item->institute_id == "a0143")
      <div class="carousel-item active">
        <img src="{{asset('images/carousel/'. $item->slider_img)}}" class="d-block w-100" alt="...">
      </div>
      @endif
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

<div class="carousel-top">
    <h1 class="col_name">Tongi Govt. College, Gazipur</h1>
    <a href="#" class="his_btn">
        <button class="btn">History</button>
    </a>
</div>