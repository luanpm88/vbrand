<div id="sidebar" class="sidebar-left">
    <div class="sidebar_inner">
        <div class="list-group no-border list-unstyled">
            <span class="list-group-item heading">SẢN PHẨM</span>
            <a href="{{ URL('member/products/add') }}" class="list-group-item"><i class="fas fa-plus-square"></i> Thêm Mới</a>
            <a href="{{ URL('member/products') }}" class="list-group-item ">
                <i class="fa fa-fw fa-bars"></i> Danh sách sản phẩm</a> 

            <a href="{{ URL('member/promotion') }}" class="list-group-item"><i class="fas fa-cog"></i> Khuyến mãi</a>
            <a href="{{ URL('member/voucher') }}" class="list-group-item"><i class="fas fa-cog"></i> Voucher </a>
            <a href="{{ URL('member/card') }}" class="list-group-item d-flex justify-content-between align-items-center"><span>
                <i class="fas fa-bookmark"></i> Đơn hàng</span> <span class="badge badge-primary badge-pill">10</span></a> 
            <a href="{{ URL('member/statistical') }}" class="list-group-item"><i class="fas fa-cog"></i> Báo cáo, Thống kê</a>

            
            <span class="list-group-item heading">THƯƠNG MẠI</span>
            <a href="{{ URL('member/customer') }}" class="list-group-item"><i class="fas fa-cog"></i> Khách hàng</a>
            <a href="{{ URL('member/domain') }}" class="list-group-item"><i class="fas fa-cog"></i> Quản trị Tên miền </a>
            <a href="{{ URL('member/email') }}" class="list-group-item"><i class="fas fa-cog"></i> Quản trị Email </a>
            <a href="{{ URL('member/template') }}" class="list-group-item"><i class="fas fa-cog"></i> Quản trị Giao Diện </a>
            <a href="{{ URL('member/package') }}" class="list-group-item"><i class="fas fa-cubes"></i> Nâng cấp tài khoản</a>
            <a href="{{ URL('member/payment') }}" class="list-group-item"><i class="fas fa-cubes"></i> Thanh toán</a>
            <a href="{{ URL('member/alert') }}" class="list-group-item d-flex justify-content-between align-items-center">
                <span><i class="fas fa-bell"></i> Thông báo</span>
                <span class="badge badge-primary badge-pill">7</span>
            </a>

        </div>
    </div>
</div>