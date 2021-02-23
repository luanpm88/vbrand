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
          <td class="text-right text-nowrap">{{ App\Library\Currency::formatPrice($fee['total']) }}</td>
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