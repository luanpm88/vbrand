<nav class="navbar navbar-expand-lg navbar-dark  menu-bg" id="menu">
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
            <a href="index.html" class="dropdown-item">Xây dựng website</a>
            <a href="index.html" class="dropdown-item">Xây dựng ứng dụng</a>
            <a href="index5.html" class="dropdown-item">Domain, Hosting SEO</a>
            <a href="index7.html" class="dropdown-item">Email Hosting</a>
            <a href="index5.html" class="dropdown-item">Sản xuất Media</a>
            <a href="index6.html" class="dropdown-item">Giấy phép kinh doanh</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          DỊCH VỤ
        </a>
        <div class="dropdown-menu">
            <a href="property_grid.html" class="dropdown-item">Phát triển website</a>
            <a href="property_listing_map.html" class="dropdown-item">Email Marketing</a>
            <a href="property_single.html" class="dropdown-item">Zalo Marketing</a>
            <a href="property_single2.html" class="dropdown-item">Facebook Marketing</a>
            <a href="property_single3.html" class="dropdown-item">Google Ads Marketing</a>
            <a href="property_single3.html" class="dropdown-item">Youtube Marketing</a>
            <a href="property_single3.html" class="dropdown-item">Các kênh Marketing khác</a>
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
        <a type="button" class="btn topfree nav-btn"  data-toggle="modal" data-target="#exampleModal" ><span><i class="fa fa-plus" aria-hidden="true"></i> DÙNG THỬ MIỄN PHÍ</span></a></li>
      @else
      <li class="nav-item dropdown user-account">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(!empty($user->phone))
            <span class="user-image" style="background-image:url('{{ url('upload/Avatar/'. $user->phone) }}')"></span>
          @else
            @if(!empty($user->avatar))
              <span class="user-image" style="background-image:url('{{ url($user->avatar) }}')"></span>
            @endif
          @endif
          {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu">
            <a href="{{ URL('member/profile') }}" class="dropdown-item"><i class="fas fa-user-circle"></i>  Tài khoản</a>
            <a href="{{ URL('member/password') }}" class="dropdown-item"><i class="fa fa-fw fa-lock"></i> Đổi mật khẩu</a>
            <a href="{{ URL('member/alert') }}" class="dropdown-item"><i class="fas fa-bell"></i> Thông báo</a>
            <a href="{{ URL('member/payment') }}" class="dropdown-item"><i class="fa fa-fw fa-credit-card"></i> Thanh toán</a>
            <a  href="{{ route('logout') }}" class="dropdown-item"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> 
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



 