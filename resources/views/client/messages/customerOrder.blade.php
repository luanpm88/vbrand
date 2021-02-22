<div class="section">
    <div class="header d-flex align-items-center mb-0">
      <h5 class="mr-auto mb-0">Sản phẩm</h5>
    </div>
    <div class="">
      <div class="">
          <div class="product-search d-flex align-items-center p-2">
            <div class="full-width pr-2">
              <select type="text" class="form-control" name="product_id">
                <option value="none">Nhập để tìm sản phẩm</option>
              </select>
            </div>
            <div class="text-right">
              <button class="btn btn-primary add-product">
                <div class="d-flex align-items-center">
                  <i class="material-icons-outlined">add</i>
                </div>
              </button>
            </div>
          </div>
          <div class="table-responsive">
            @if (!$order->details->isEmpty())
                <table class="table table-striped mt-2">
                    <tbody>
                      @foreach ($order->details as $detail)
                        <tr>
                          <td width="1%"><img width="50px" src="{{ action('Client\ProductController@image', $detail->product->id) }}" />
                          </td>
                          <td>
                            {{ $detail->product->title }}
                            <div class="text-muted">{{ App\Library\Currency::formatPrice($detail->product->price) }} · In stock</div>
                          </td>
                          <td>
                            <input min="0" style="width:65px;" class="form-control detail-quantity" data-id="{{ $detail->id }}" type="number" value="{{ $detail->quantity }}" />
                            <div class="mt-2">
                              <a href="javascript:;" data-id="{{ $detail->id }}" class="text-danger detail-remove">
                              <i class="link-icon material-icons-outlined">delete_forever</i> </a>
                            </div>
                          </td>
                          <td class="text-right text-nowrap">{{ App\Library\Currency::formatPrice($detail->itemsTotal()) }}</td>
                        </tr>
                      @endforeach
                        {{-- <tr>
                            <td width="1%"><img src="https://dummyimage.com/50x50/55595c/fff" />
                            </td>
                            <td>
                              Product Name Dada
                              <div class="text-muted">In stock</div>
                            </td>
                            <td>
                              <input style="width:65px;" class="form-control" type="number" value="2" />
                              <div class="mt-2">
                                <a href="" class="text-danger">
                                <i class="link-icon material-icons-outlined">delete_forever</i> </a>
                              </div>
                            </td>
                            <td class="text-right text-nowrap">150,000 ₫</td>
                        </tr> --}}
                        <tr>
                            <td colspan="3" class="text-right">Tổng</td>
                            <td class="text-right text-nowrap font-weight-bold">{{ App\Library\Currency::formatPrice($order->itemsTotal()) }}</td>
                        </tr>
                    </tbody>
                </table>
            @else
              <div class="alert alert-info mx-2">
                Chưa có sản phẩm. Vui lòng chọn và thêm sản phẩm ở khung tìm kiếm bên trên.
              </div>
            @endif
          </div>
      </div>
    </div>
  </div>

  <div class="section">
    <h5 class="header">Giao hàng</h5>

    <div class="custom-control custom-checkbox mb-4 pl-4 ml-3">
      <input type="checkbox" class="custom-control-input" id="same-address">
      <label class="custom-control-label" for="same-address">Địa chỉ giao hàng giống với địa chỉ liên hệ</label>
    </div>

    <div class="mb-3 px-3">
      <label for="address">Địa chỉ</label>
      <input type="text" class="form-control" id="address" placeholder="123 Cộng Hòa, Phường 17" required="">
      <div class="invalid-feedback">
        Nhập địa chỉ giao hàng
      </div>
    </div>

    <div class="px-3">
      <div class="row px-0">
        <div class="col-md-4 mb-3">
          <label for="country">Quốc gia</label>
          <select class="custom-select d-block w-100" id="country" required="">
            <option value="">Chọn...</option>
            <option value="vn" selected>Việt Nam</option>
          </select>
          <div class="invalid-feedback">
            Please select a valid country.
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="state">Tỉnh/Thành</label>
          <select class="custom-select d-block w-100" id="state" required="">
            <option value="">Chọn...</option>
            <option>TP. Hồ Chí Minh</option>
          </select>
          <div class="invalid-feedback">
            Please provide a valid state.
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="zip">Quận/Huyện</label>
          <select class="custom-select d-block w-100" id="state" required="">
            <option value="">Chọn...</option>
            <option>Quận Gò Vấp</option>
          </select>
          <div class="invalid-feedback">
            Please provide a valid state.
          </div>
        </div>
      </div>
    </div>

    <table class="table table-striped mb-4">
      <thead>
          <tr>
              <th scope="col" style="width:50px;"> </th>
              <th scope="col">Đơn vị</th>
              <th scope="col" class="text-right">Phí vận chuyển</th>
          </tr>
      </thead>
      <tbody>
          <tr>
            <td>
              <input class="form-control" type="radio" name="shipping_method" />
            </td>
            <td class="p-2">
              <img style="width:120px" src="{{ url('/images/ghn_logo.png') }}" />
            </td>
            <td class="text-right text-nowrap">36,000 ₫</td>
          </tr>
          <tr>
            <td>
              <input class="form-control" type="radio" name="shipping_method" />
            </td>
            <td class="p-2">
              <img style="width:150px" src="https://giaohangtietkiem.vn/wp-content/themes/giaohangtk/images/logo.png" />
            </td>
            <td class="text-right text-nowrap">20,000 ₫</td>
          </tr>
          <tr>
            <td>
              <input class="form-control" type="radio" name="shipping_method" />
            </td>
            <td class="p-2">
              <img style="width:150px" src="https://viettelpost.com.vn/wp-content/uploads/2019/06/logo-01.png" />
            </td>
            <td class="text-right text-nowrap">40,000 ₫</td>
          </tr>
      </tbody>
    </table>
  </div>

  <div class="section">
    <h5 class="header mb-0">Tổng cộng</h5>

    <div class="">
      <div class="">
          <div class="table-responsive">
              <table class="table table-striped mt-2">
                  <thead>
                      <tr>
                          <th scope="col" width="1%"> </th>
                          <th scope="col">Sản phẩm</th>
                          <th scope="col" class="text-center">Số lượng</th>
                          <th scope="col" class="text-right">Giá</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($order->details as $detail)
                      <tr>
                        <td>
                          <span class="badge badge-info">1</span>
                        </td>
                        <td class="order-summary-title">
                          {{ $detail->product->title }}
                        </td>
                        <td class="text-right">
                          {{ $detail->quantity }}
                        </td>
                        <td class="text-right text-nowrap">{{ App\Library\Currency::formatPrice($detail->itemsTotal()) }}</td>
                    </tr>
                    @endforeach
                      <tr>
                          <td colspan="3" class="text-right">Tổng</td>
                          <td class="text-right text-nowrap">{{ App\Library\Currency::formatPrice($order->itemsTotal()) }}</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right">Phí giao hàng</td>
                          <td class="text-right text-nowrap">36,000 ₫</td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right"><strong>Tổng cộng</strong></td>
                          <td class="text-right text-nowrap"><strong>{{ App\Library\Currency::formatPrice($order->allTotal()) }}</strong></td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>

  <hr class="mb-3">
  <div class="text-center px-3">
    <button class="btn btn-success">
      <i class="material-icons-outlined icon">check</i>
      Chốt đơn
    </button>
    <button class="btn btn-primary">
      <i class="material-icons-outlined icon">local_shipping</i>
      Giao hàng
    </button>
    <button class="btn btn-secondary">
      <i class="material-icons-outlined icon">credit_score</i>
      Đã thanh toán
    </button>
    <hr class="mb-3">
    <button class="btn btn-secondary">
      <i class="material-icons-outlined icon">print</i>
      In đơn hàng
    </button>
    <button class="btn btn-danger">
      <i class="material-icons-outlined icon">delete_forever</i>
      Hủy đơn
    </button>
</div>

<script>
  order.addProductUrl = '{{ action('Client\MessageController@addProduct', ['order_id' => $order->id]) }}';
  order.updateQuantityUrl = '{{ action('Client\MessageController@updateQuantity', ['order_id' => $order->id]) }}';

  $('.add-product').on('click', function() {
    var productId = $('[name=product_id]').select2('val');

    order.addProduct(productId);
  });


  $('[name=product_id]').select2({
    ajax: {
      url: '{{ action('Client\ProductController@select2') }}',
      data: function (params) {
        var query = {
          _token: '{{ csrf_token() }}',
          keyword: params.term,
          page: params.page || 1
        }

        // Query parameters will be ?search=[term]&page=[page]
        return query;
      }
    }
  });

  $('.detail-quantity').on('change', function() {
    var value = $(this).val();
    var detailId = $(this).attr('data-id');

    if (value < 0) {
      value = 0;
    }

    order.updateQuantity(detailId, value);
  });
  
  $('.detail-remove').on('click', function() {
    var value = 0;
    var detailId = $(this).attr('data-id');

    order.updateQuantity(detailId, value);
  });
</script>