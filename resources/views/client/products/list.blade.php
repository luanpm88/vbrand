<h5>Tất cả sản phẩm</h5>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td></td>
            <td width="30%">Sản phẩm</td>
            <td>Loại</td>
            <td>Nhãn hiệu</td>
            <td>Có thể bán</td>
            <td>Trạng thái</td>
            <td>Ngày khởi tạo</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td></td>
                <td class="img-col">
                    <div class="">
                        <img src="{{ action('Client\ProductController@image', $product->id) }}"
                        />
                    </div>
                </td>
                <td>{{ $product->title }}</td>
                <td>Laptop</td>
                <td>ASUS - ROG</td>
                <td>10</td>
                <td>
                    <span class="badge bg-info">Đang giao dịch</span>
                </td>
                <td>{{ $product->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('client.helpers.pagination')