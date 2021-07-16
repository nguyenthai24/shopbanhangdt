@extends('admin_layout')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
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
                                
                            	 {{-- enctype='multipart/form-data'nghĩa trong một phương pháp mã hóa HTML --}}
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                	{{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự" class="form-control" name="product_name" id="exampleInputEmail1" placeholder="Enter email" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm trong kho</label>
                                    <input type="text" class="form-control" name="product_quantity" data-validation="number" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự và điền đúng số">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm đã bán</label>
                                    <input type="text" class="form-control" name="product_sold" data-validation="number" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự và điền đúng số">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control" name="product_slug" id="exampleInputEmail1" placeholder="Enter email" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Từ khóa sản phẩm</label>
                                    <input type="text" class="form-control" name="meta_keywords" id="exampleInputEmail1" placeholder="Enter email" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" name="product_price" id="exampleInputEmail1" placeholder="Enter email" data-validation="number" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự và điền đúng số">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm cũ</label>
                                    <input type="text" class="form-control" name="product_price_old" id="exampleInputEmail1" placeholder="Enter email" data-validation="number" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự và điền đúng số">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="product_image" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows: 8;  type="password" class="form-control" id="editor" name="product_desc" placeholder="Mô tả danh mục" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows: 8;  type="password" class="form-control" id="editor1" name="product_content" placeholder="Mô tả danh mục" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
		                            @foreach($product_cate as $key => $cate_product)    
		                                <option value="{{$cate_product->category_id}}">{{$cate_product->category_name}}</option>		                               
		                            @endforeach  
		                            </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
		                            @foreach($product_brand as $key => $brand_product)    
		                                <option value="{{$brand_product->brand_id}}">{{$brand_product->brand_name}}</option>
		                            @endforeach  
		                               
		                            </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
		                                <option value="0">Ẩn</option>
		                                <option value="1">Hiển thị</option>
		                               
		                            </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection