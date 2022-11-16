<footer id="footer">
      <div class="footer-middle">
        <div class="container">
          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="widget widget-about">
              @foreach($basics as $item)
                <a href="{{route('landingpage')}}">
                  <img src="{{ asset('images/logo/'. $item->logo) }}" class="footer-logo" alt="Footer Logo" width="100" height="60">
                </a>
                
                <p>{{$item->institute_title}}</p>
                
                <div class="social-icons">
                  <a href="{{$item->fb_link}}" class="social-icon" title="Facebook"><i class="fa-brands fa-facebook"></i></a>
                  <a href="{{$item->twitter_link}}" class="social-icon" title="Twitter"><i class="fa-brands fa-square-twitter"></i></a>
                  <a href="{{$item->insta_link}}" class="social-icon" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                  <a href="{{$item->youtube_link}}" class="social-icon" title="Youtube"><i class="fa-brands fa-youtube"></i></a>
                  <a href="{{$item->pi_link}}" class="social-icon" title="Pinterest"><i class="fa-brands fa-pinterest"></i></a>
                </div>
                @endforeach
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="widget">
                <h4 class="widget-title">RELETTED LINKS</h4>
                <ul class="widget-list">
                  <li><a href="http://www.educationboardresults.gov.bd/">Education Board Result</a></li>
                  <li><a href="http://www.moedu.gov.bd/">Ministry of Education</a></li>
                  <li><a href="http://www.dshe.gov.bd/">DG Website</a></li>
                  <li><a href="http://www.banbeis.gov.bd">Banbeis</a></li>
                  <li><a href="http://www.nu.edu.bd">National University</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="widget">
                <h4 class="widget-title">IMPORTANT LINKS</h4>
                <ul class="widget-list">
                  <li><a href="https://www.bangladesh.gov.bd">National Portal</a></li>
                  <li><a href="https://bn.wikipedia.org/wiki/">Wikipedia</a></li>
                  <li><a href="https://10minuteschool.com">10 Minutes School</a></li>
                  <li><a href="https://bn.khanacademy.org">Khan Academy</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="widget">
                <h4 class="widget-title">CONTACT US</h4>
                <div class="wpb_wrapper">
                @foreach($users as $item)
                  <p><i class="fas fa-street-view"></i> Address: {{$item->address}}</p>
                  <p><i class="fas fa-phone"></i> Phone: {{$item->contact_no}}</p>
                  <p><i class="fas fa-envelope"></i> Email: {{$item->email}}</p>  
                @endforeach          
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
        @foreach($users as $item)
          <p>Copyright© {{$item->institute_name}} 2022, Design & Developed by Automate IT Limited.</p>
        @endforeach 
        </div>
      </div>
    </footer>