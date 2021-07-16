 @extends('admin_layout')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Slider
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
                                <form role="form" action="{{URL::to('/insert-slider')}}" method="post" 
                                enctype="multipart/form-data">
                                	{{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Slider</label>
                                    <input type="text" class="form-control" name="slider_name"  data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" name="slider_image" id="exampleInputEmail1" placeholder="Enter email" >
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả slider</label>
                                    <textarea style="resize: none" rows: 8;  type="password" class="form-control" id="editor" name="slider_desc" placeholder="Mô tả danh mục" required  ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="slider_status" class="form-control input-sm m-bot15">
		                                <option value="1">Hiển thị slider</option>
		                                <option value="0">Ẩn slider</option>
		                               
		                            </select>
                                </div>
                                
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm Slider</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection