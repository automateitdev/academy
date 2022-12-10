@if(!empty($aboutinstitutes))
<div id="about_ins">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="lksUi" style="text-align: center">
                    
                    <div class="row p-5 d-flex justify-content-center">
                        
                        <div class="col-md-8">
                            
                            <img class="w-100 " style="border: 10px solid #fff" src="{{asset('images/about_institute/'.$aboutinstitutes->image)}}" alt="Institute Image" height="300px">
                        </div>

                        <div class="pt-5">
                            <h1 class="title" style="text-align: center"><i class="fa-sharp fa-solid fa-school"></i> About Institute</h1>
                        </div>
                        <div class="d-flex justify-content-center pb-5">
                            <p class="borde"></p>
                        </div>
                        
                        
                        
                            <p class="text-lg col-md-10" style="text-align: center">
                            {{$aboutinstitutes->description}}
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
