<div id="professorMsg">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="wqbGt">
                    <span class="ewKuy overflow-hidden">
                        <div class="d_shadow"></div>
                        @foreach ($speeches as $spech)
                            @if ($spech->designation_id == 1)
                            <img src="{{ asset('images/speech/' . $spech->pro_img) }}" alt="" width="375px">
                            @endif
                        @endforeach
                    </span>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="contentOfPr">
                    @foreach ($speeches as $spech)
                        @if ($spech->designation_id == 1)
                        <h1 class="p_name">{{ $spech->name }}</h1>
                        <h4 class="p_title">{{ $spech->designation->designation }}</h4>
                        <p class="p_msg text-justify" style="text-align: justify">
                            {{ Str::words($spech->message), 50 }}
                        </p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row vice">
            <div class="col-sm-6 col-md-6">
                <div class="contentOfPr">
                    @foreach ($speeches as $spech)
                    @if ($spech->designation_id == 2)
                        <h1 class="p_name">{{ $spech->name }}</h1>
                        <h4 class="p_title">{{ $spech->designation->designation }}</h4>
                        <p class="p_msg text-justify" style="text-align: justify" {{ $spech->message }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="wqbGt">
                    <span class="ewKuy overflow-hidden">
                        <div class="d_shadow"></div>
                        @foreach ($speeches as $spech)
                        @if ($spech->designation_id == 2)
                            <img src="{{ asset('images/speech/' . $spech->pro_img) }}" alt="" width="375px">
                            @endif
                        @endforeach
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>