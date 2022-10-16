<div id="recent_pic">
    <div class="container">
        <div class="dJuyt text-center">
          <h2>Recent Picture</h2>
        </div>
        <div class="imag">
          <div class="owl-carousel owl-theme">
            @foreach($galleries as $item)
            <div class="item">
              <img src="{{asset('images/gallery/'.$item->photo)}}" alt="">
            </div>
            @endforeach
          </div>
        </div>
    </div>
</div>