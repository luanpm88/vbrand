
  <div class="tab-header">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active"
          id="contact-tab" data-toggle="tab"
          href="#contact" role="tab" aria-controls="contact" aria-selected="true">
            Khách hàng
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="false">
          Đơn hàng
        </a>
      </li>
      <li class="nav-item">
        
      </li>
    </ul>
    <div class="actions ml-auto">
      <a class="" href="javascript:;" onclick="messenger.loadRightbar();">
        <i class="material-icons-outlined">refresh</i>
      </a>
    </div>
  </div>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      <div class="row mt-4 mx-0">
        <div class="col-md-12 order-md-1 pb-3">
          <div class="d-flex align-items-center sidebar-contact">
              <img class="avatar" src="{{ $conversation->picture }}" />
              <div class="ml-3">
                  <h4 class="mb-0">{{ $conversation->name }}</h4>
                  <p class="text-muted mb-0">new contact</p>
              </div>
              <div class="text-right ml-auto">
                <button class="btn btn-primary mr-1">Đơn hàng</button>
              </div>
          </div>
          <form class="needs-validation" novalidate="">
            <div class="row mt-3">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="Tên" value="{{ $conversation->contact['first_name'] }}" required="">
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Họ" value="{{ $conversation->contact['last_name'] }}" required="">
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>
    
            <div class="mb-3">
              <label for="username">Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="username" placeholder="Email" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="username">Điện thoại</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="material-icons-outlined">phonelink_ring</i></span>
                </div>
                <input type="text" class="form-control" id="username" placeholder="Số điện thoại" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>
    
            <div class="mb-3">
              <label for="address">Địa chỉ</label>
              <input type="text" class="form-control" id="address" placeholder="123 Cộng Hòa, Phường 17" required="">
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>
    
            <div class="row">
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
            <hr class="mb-4">
            
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Địa chỉ giao hàng giống với địa chỉ liên hệ</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Đồng bộ thông tin theo Facebook</label>
            </div>
            
            <hr class="mb-4">
            <div class="text-center">
              <button class="btn btn-primary mr-1">Tạo đơn hàng</button>
              <button class="btn btn-secondary">Xóa liên hệ</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
      <div class="mb-4 pt-3">
        <div class="section">
          <div class="header d-flex align-items-center mb-0">
            <h5 class="mr-auto mb-0">Sản phẩm</h5>
          </div>
          <div class="">
            <div class="">
                <div class="product-search d-flex align-items-center p-2">
                  <div class="full-width pr-2">
                    <select type="text" class="form-control" name="product_id">
                      <option>Nhập để tìm sản phẩm</option>
                    </select>
                  </div>
                  <div class="text-right">
                    <button class="btn btn-primary">
                      <div class="d-flex align-items-center">
                        <i class="material-icons-outlined">add</i>
                      </div>
                    </button>
                  </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped mt-2">
                        {{-- <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col" class="text-center">Số lượng</th>
                                <th scope="col" class="text-right">Giá</th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            <tr>
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
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">Tổng</td>
                                <td class="text-right text-nowrap">300,000 ₫</td>
                            </tr>
                        </tbody>
                    </table>
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
                            <tr>
                                <td>
                                  <span class="badge badge-info">1</span>
                                </td>
                                <td>
                                  Product Name Dada
                                </td>
                                <td class="text-right">
                                  2
                                </td>
                                <td class="text-right text-nowrap">150,000 ₫</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">Tổng</td>
                                <td class="text-right text-nowrap">300,000 ₫</td>
                            </tr>
                            <tr>
                              <td colspan="3" class="text-right">Phí giao hàng</td>
                                <td class="text-right text-nowrap">36,000 ₫</td>
                            </tr>
                            <tr>
                              <td colspan="3" class="text-right"><strong>Tổng cộng</strong></td>
                                <td class="text-right text-nowrap"><strong>336,000 ₫</strong></td>
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

      </div>
    </div>
</div>

<script>
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
</script>