@extends('admin_layout')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Mã giảm giá
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <?php
                                    $message = Session::get('message');
                                    if($message) {
                                        echo '<div class="alert alert-success" style="text-align: center; font-size: 18px">'
                                            .$message.'</div>';
                                            
                                        Session::put('message', null);
                                    }
                                ?>
                                <form role="form" action="{{URL::to('/insert-coupons-code')}}" method="post">
                                	{{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" class="form-control" name="coupons_name" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" class="form-control" name="coupons_code" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng Mã</label>
                                    <input type="text" class="form-control" name="coupons_time" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tính năng mã</label>
                                     <select name="coupons_condition" class="form-control input-sm m-bot15">
		                                <option value="0">----Chọn----</option>
		                                <option value="1">Giảm giá theo phầm trăm sản phẩm</option>
		                                <option value="2">Giảm giáo theo tiền</option>
		                               
		                            </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập số phầm trăm hoặc số tiền được giảm giá</label>
                                   	 <input type="text" class="form-control" name="coupons_number" id="exampleInputEmail1">
                                </div>
                                  
                            
                                
                                <button type="submit" name="add_coupons" class="btn btn-info ">Thêm mã giảm giá</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection