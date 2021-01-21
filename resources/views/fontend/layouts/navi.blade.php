<header>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top menu-bg" id="menu">
  <div class="container">
  <a class="navbar-brand" href="{{ url('/') }}">
    <span class="icon-brand"></span> 
  </a>
  <div class="slogonmobi">
    Xây dựng thương hiệu
  </div>
  <button class="navbar-toggler logo" type="button" data-toggle="collapse" data-target="#menu-content" aria-controls="menu-content" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="menu-content">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          SẢN PHẨM  
        </a>
        <div class="dropdown-menu">
            <a href="{{ url('web-design') }}" class="dropdown-item">Xây dựng website</a>
            <a href="{{ url('applocation') }}" class="dropdown-item">Xây dựng ứng dụng</a>
            <a href="{{ url('domain-hosting') }}" class="dropdown-item">Domain, Hosting SEO</a>
            <a href="{{ url('email-hosting') }}" class="dropdown-item">Email Hosting</a>
            <a href="{{ url('media') }}" class="dropdown-item">Sản xuất Media</a>
            <a href="{{ url('wwebsite-laws') }}" class="dropdown-item">Giấy phép kinh doanh</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          DỊCH VỤ
        </a>
        <div class="dropdown-menu">
            <a href="{{ url('web-advance') }}" class="dropdown-item">Phát triển website</a>
            <a href="{{ url('email-marketing') }}" class="dropdown-item">Email Marketing</a>
            <a href="{{ url('email-marketing') }}" class="dropdown-item">Zalo Marketing</a>
            <a href="{{ url('email-marketing') }}" class="dropdown-item">Facebook Marketing</a>
            <a href="{{ url('email-marketing') }}" class="dropdown-item">Google Ads Marketing</a>
            <a href="{{ url('email-marketing') }}" class="dropdown-item">Youtube Marketing</a>
            <a href="{{ url('other-marketing') }}" class="dropdown-item">Các kênh Marketing khác</a>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#">ĐẠI LÝ</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#">
          KHÁCH HÀNG
        </a>
         
      </li>
      
    </ul>
    
     <ul class="navbar-nav ml-auto">
      @guest
      <li class="nav-item">
        <a href="{{ url('login') }}" class="btn topfree nav-btn" ><span><i class="bi bi-person-fill"></i> ĐĂNG NHẬP</span></a></li>
      @else
      <li class="nav-item dropdown user-account">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="user-image" style="background-image:url('{{ url('images/profile3.jpg') }}');"></span>{{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu">
            <a href="{{ URL('member/profile') }}" class="dropdown-item"><i class="bi bi-person-fill"></i>  Tài khoản</a>
            <a href="{{ URL('member/password') }}" class="dropdown-item"><i class="bi bi-pencil-square"></i> Đổi mật khẩu</a>
            <a href="{{ URL('member/alert') }}" class="dropdown-item"><i class="bi bi-bell"></i> Thông báo</a>
            <a href="{{ URL('member/payment') }}" class="dropdown-item"><i class="bi bi-credit-card"></i> Thanh toán</a>
            <a href="{{ URL('member/account') }}" class="dropdown-item"><i class="bi bi-gear"></i> Cấu hình</a> 
            <a  href="{{ route('logout') }}" class="dropdown-item"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-power"></i>
                  {{ __('layout.logout') }}  
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
        </div>
      </li>          
      @endguest 
    </ul>  
 
    
  </div>
  </div>
</nav> 
</header>