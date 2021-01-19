@extends('fontend.Member.master')
@section('content')
<script type="text/javascript">    
    var _token = '{{ csrf_token() }}';   
</script>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-8">
            <h4 class="page-title">Quẳn trị khách hàng</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">DASHBOARD</a></li>
                <li class="breadcrumb-item active">KHÁCH HÀNG</li>
            </ol>
        </div> 
    </div>
</div>
@if (Session::has('messenge'))
<div class="alert alert-success" role="alert">
  <strong> {{ Session::get('messenge') }}</strong>.
</div>
@endif

<div class="col-md-12 col-lg-12 col-xl-12"> 
            <form action="index.php">
            <h3 class="subheadline">PHẢN HỒI KHÁCH HÀNG</h3>
              <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" id="private_message" checked>
                    <label for="private_message">Chúng tôi muốn hợp tác phân phối sản phẩm của anh, xin cho liên hệ</label>
                  </div>
              </div>
              <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" id="item_message" checked>
                    <label for="item_message">Quý công ty đã có văn phòng tại Đà Lạt Chưa? chúng tôi muốn phân phối sản phẩm của bạn</label>
                  </div>
              </div>
            <h3 class="subheadline">THÔNG BÁO HỆ THỐNG</h3> 
            <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" id="marketing_emails" checked>
                    <label for="marketing_emails">Email: Bạn còn 500 khách hàng đang gửi Marketing emails, hãy <a href="#">Tiếp tục</a> thực hiện chiến dịch </label>
                  </div>
              </div>
              <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" id="monthly_newsletter" checked>
                    <label for="monthly_newsletter">Có 2 mẫu giao diện tốt đang chờ bạn, hãy xem <a href="#">chi tiết</a> </label>
                  </div>
              </div>
              <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" id="weekly_digest" checked>
                    <label for="weekly_digest">Gói Silver của bạn còn 10 ngày, hãy gia hạn ngay</label>
                  </div>
              </div>             
              <hr>
              <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary">Save Settings</button>
              </div>
            </form>
          </div>

</div> 
@endsection()