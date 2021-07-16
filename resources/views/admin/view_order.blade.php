@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     	Thông tin khách hàng đăng nhập
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php
          $message = Session::get('message');
          //nếu tồn tại biến $message thỳ thực hiện lệnh
          if($message) {
            echo '<span class="text-alert">'.$message.' </span';
            Session::put('message', null);
          }
        ?>
        <thead>

          <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
          </tr>
        </thead>
        {{-- k cần phải foreach  first()--}}
        <tbody>
       
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
      
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     	Thông tin vận chuyển hàng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php
          $message = Session::get('message');
          //nếu tồn tại biến $message thỳ thực hiện lệnh
          if($message) {
            echo '<span class="text-alert">'.$message.' </span';
            Session::put('message', null);
          }
        ?>
        <thead>
            
            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
          </tr>
        </thead>
        <tbody>
          <tr>
           
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_notes}}</td>
            <td>@if($shipping->shipping_method==0) Chuyển khoản @else Tiền mặt @endif</td>
            
          
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br><br>
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
    </div>
    <div class="row w3-res-tb">
      
    </div>
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th >
              Thứ tự
            </th>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho</th>
            <th>Mã giảm giá</th>
            <th>Phí vận chuyển</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            
           
          </tr>
        </thead>
        <tbody>
          @php
            $i = 0;
            $total = 0;
          @endphp
         @foreach($order_details_product as $key => $ord)
          @php
            $i++;
            $subtotal = $ord->product_price*$ord->product_sales_quantity;
            $total += $subtotal;
          @endphp
          <tr class="color_qty_{{$ord->product_id}}">
           
            <td><i>{{$i}}</i></td>
            <td>{{$ord->product_name}}</td>
            <td>{{$ord->product->product_quantity}}</td>
            <td>
              @if($ord->product_coupons !='no')
                {{$ord->product_coupons}}
              @else 
                Không mã giảm giá
              @endif
            </td>
            <td>
                {{number_format($ord->product_feeship,0,',','.')}}đ
            </td>
            <td>
              <input type="number" {{$order_status == 2 ? 'disabled' : ''}} class="order_qty_{{$ord->product_id}}" value="{{$ord->product_sales_quantity}}" min="1" name="product_sales_quantity" style="width: 80px; text-align: center;">
               <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$ord->product_id}}" value="{{$ord->product->product_quantity}}">
              <input type="hidden" name="order_code" class="order_code" value="{{$ord->order_code}}">
              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$ord->product_id}}">

              @if($order_status != 2)
                <button class="btn btn-default update_quantity_order" data-product_id="{{$ord->product_id}}" name="update_quantity_order">Cập nhật</button>
              @endif
              {{-- data-product_id: cái data mang tên product_id --}}
            </td>

            <td>{{number_format($ord->product_price,0,',','.')}}đ</td>
            <td>{{number_format($subtotal,0,',','.')}}đ</td>
           
          </tr>
          @endforeach
          <tr>
            <td colspan="2">
              @php
                $total_after_coupons = 0;
                $total_coupons = 0;
              @endphp
              @if($coupons_condition == 1)
                @php
                  $total_after_coupons = ($total*$coupons_number)/100;
                  echo 'Tổng giảm: '.number_format($total_after_coupons,0,',','.').'đ'.'<br>';
                  $total_coupons = $total - $total_after_coupons - $ord->product_feeship;
                @endphp
              @else
                 @php
                 echo 'Tổng giảm: '.number_format($coupons_number,0,',','.').'đ'.'<br>';
                  $total_coupons= $total-$coupons_number -$ord->product_feeship;
                @endphp
              @endif
              Phí ship: {{number_format($ord->product_feeship ,0,',','.')}}đ
              <br>
              Thanh toán: {{number_format($total_coupons,0,',','.')}}đ
            </td>
          </tr>
          <tr>
           <td colspan="6">
              @foreach($order as $key => $or)
                @if($or->order_status==1)
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}"  value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @elseif($or->order_status==2)
                <form>
                  @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @else
                <form>
                   @csrf
                  <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                    <option id="{{$or->order_id}}"  value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @endif
                @endforeach


            </td>
          </tr>
        </tbody>
      </table>
      <a  target="_blank" href="{{url('/print-order/'.$ord->order_code)}}">In đơn hàng</a>
      {{-- target="_blank" thêm tab mới --}}
    </div>
    
  </div>
</div>
@endsection