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
      <div class="row px-0 order-shipping-area-select">
        <div class="col-md-4 mb-3">
          <label for="province">Tỉnh/Thành</label>
          <select name="province_id" class="custom-select d-block w-100" id="country" required="">
            <option value="">Chọn...</option>
            @foreach(App\Models\Province::all() as $province)
              <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            Please select a valid country.
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="state">Quận/Huyện</label>
          <div class="districts-box">
            <select name="district_id" class="custom-select d-block w-100" id="state" required="">
              <option value="">Chọn...</option>
            </select>
          </div>
          <div class="invalid-feedback">
            Please provide a valid state.
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="zip">Phường/Xã</label>
          <div class="wards-box">
            <select name="ward_id" class="custom-select d-block w-100" id="state" required="">
              <option value="">Chọn...</option>
            </select>
          </div>
          <div class="invalid-feedback">
            Please provide a valid state.
          </div>
        </div>
      </div>
      <script>
        var districtBox = new Box($('.districts-box'), '{{ action('Client\DistrictController@selectBox') }}');
        var wardBox = new Box($('.wards-box'), '{{ action('Client\WardController@selectBox') }}');

        $('.order-shipping-area-select').on('change', '[name=province_id]', function() {
          var province_id = $(this).val();

          districtBox.load({
            data: {
              province_id: province_id
            },
            callback: loadShippingFee
          })
        });

        $('.order-shipping-area-select').on('change', '[name=district_id]', function() {
          var district_id = $(this).val();

          wardBox.load({
            data: {
              district_id: district_id
            },
            callback: loadShippingFee
          })
        });

        $('.order-shipping-area-select').on('change', '[name=ward_id]', function() {
          loadShippingFee();
        });
      </script>
    </div>

    <div class="shipping-fee-table">
      
    </div>

    <script>
      var shippingFeeBox = new Box($('.shipping-fee-table'), '{{ action('Client\MessageController@shippingFee', [
        'order_id' => $order->id
      ]) }}');

      function loadShippingFee() {
        var district_id = $('.order-shipping-area-select [name=district_id]').val();
        var ward_id = $('.order-shipping-area-select [name=ward_id]').val();

        if (ward_id || district_id) {
          shippingFeeBox.load({
            data: {
              ward_id: ward_id,
              district_id: district_id
            }
          });
        } else {
          shippingFeeBox.loadHtml(`
            <div class="alert alert-info mx-2">
              Chọn địa chỉ giao hàng để xem bảng giá.
            </div>
          `);
        }
      }

      loadShippingFee();
    </script>
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