<!-- ======= Footer ======= -->
<footer id="footer">     
    <div class="footer-bg">
        <div class="container">
          <div class="row">
              <div class="col-lg-5"> 
                  <div class="fooeach">
                    <h3>PHÒNG KINH DOANH</h3> 
                </div>
            </div> 
            <div class="col-lg-3">
              <div class="fooeach">
                <h3>DỊCH VỤ</h3>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="fooeach text-lg-right">
              <h3>KÊNH CỦA CHÚNG TÔI</h3>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-lg-5">
                <div class="fooeach faddress">
                  <p>Địa chỉ: Boulevard Plaza, Level 23, Downtown Dubai</p>
                  <p>Điện thoại: <a href="tel:+971 563770531">+971 563 770 531</a></p>
                  <p>Email: <a href="mailto:info@neebank.info">Info@neebank.info</a></p> 
                </div>
            </div> 
            <div class="col-lg-3">
              <div class="fooeach">          
                <ul class="fsocial-service">            
                  <li><a href="#" class="" data-toggle="modal" data-target="#myModal">DỰ ÁN ĐANG TRIỂN KHAI</a></li>
                  <li><a href="#" class="" data-toggle="modal" data-target="#myModal">NGÂN HÀNG BẢO LÃNH</a></li>
                  <li><a href="#" class="" data-toggle="modal" data-target="#myModal">LIÊN HỆ ONLINE</a></li>             
                </ul>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="fooeach text-right">
                <div class="fsocial-title">KÊNH THÔNG TIN CHÍNH THỨC</div>
                      <div class="fsocial"> 
                        <div class="fsocial-links">
                          <a href="https://twitter.com/DrNEE_net" class="twitter"><span class="icon-twitter1"></span></a>
                          <a href="https://www.facebook.com/drnee.net" class="facebook"><span class="icon-facebook2"></span></a>
                          <a href="https://www.instagram.com/official_dr.nee/" class="instagram"><span class="icon-instagram"></span></a>
                          <a href="https://www.youtube.com/channel/UCSpsVul6j0_4jTQkh2-_6TQ" class="youtube"><span class="icon-youtube"></span></a>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-lg-6">
                    <div class="copyright">
                      © 2020 DANH KHOI CORP
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="language">
                      @guest
                      <a href="{{ route('login.provider', 'google') }}" class="btn btn-outline-secondary" >{{ __('Login with Google ') }}</a> 
                      @else            
                      Xin chào: <b>{{ Auth::user()->name }}</b>             
                        <a href="{{ route('logout') }}"  class="btn btn-outline-secondary"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('layout.logout') }}
                        </a>
                        @if(Auth::user()->is_admin ==1)
                        <a href="{{ url('admin') }}" class="btn btn-outline-secondary" >administrator</a>
                        @endif
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      @endguest 
                    </div>
                  </div>                  
              </div>
          </div>
      </div>

  

</footer> 

<div class="backtotop">
  <a href="#" class="back-to-top"><i class="fa fa-arrow-up"></i> </a>
</div>
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> 
<script type="text/javascript">
$(document).ready( function () { 
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {     
      $('.backtotop').addClass('header-scrolled');
      $('.header-top').addClass('hidden');
      $('.header-menu').addClass('menuhover');

    } else {
      $('.backtotop').removeClass('header-scrolled');
      $('.header-top').removeClass('hidden');
      $('.header-menu').removeClass('menuhover');
    }
  });
  if ($(window).scrollTop() > 100) {
    $('.backtotop').addClass('header-scrolled');
  }

  $('.carousel').carousel();

});
 
</script>
</body>
</html> 