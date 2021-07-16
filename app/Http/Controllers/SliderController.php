<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\models\Slider;
use DB; //db là database
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class SliderController extends Controller
{	
	 public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function manage_banner(){
    	$slide = Slider::orderBy('slider_id', 'desc')->get();
    	return view('admin.slider.list_slider')->with(compact('slide'));
    }
    public function add_slider() {
    	return view('admin.slider.add_slider');
    }
    public function insert_slider(Request $request) {
    	$this->AuthLogin();
    	$data = $request->all();   		
   		$get_image = $request->file('slider_image');
   		// echo '<pre>';
   		// print_r ($data);
   		// echo '</pre>';
   		if($get_image) {
   			//getClientOriginalName() lấy cái name
   			$get_name_image = $get_image->getClientOriginalName();
   			//current lấy đầu tên sau dấu chấm
   			$name_image = current(explode('.', $get_name_image ));
   			//getClienOriginalExtension() thêm đuôi mở rộng của file ảnh
   			$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
   			$get_image->move('uploads/slider', $new_image);

   			$slider = new Slider();
   			$slider->slider_name = $data['slider_name'];
   			$slider->slider_image = $new_image;
   			$slider->slider_desc = $data['slider_desc'];
   			$slider->slider_status = $data['slider_status'];
   			$slider->save();


	   		Session::put('message', 'Thêm slider thành công');
	   		return Redirect::to('/add-slider');
   		}
   		else{
   			Session::put('message', 'Hãy chèn hình ảnh cho slider');
   			return Redirect::to('/add-slider');
   		}
   		
    }
    public function unactive_slider($slider_id) {
      $this->AuthLogin();
   		DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status'=>0]);
   		Session::put('message', 'Không kích slide  thành công');
   		return Redirect::to('manage-banner');
   }
   	public function active_slider($slider_id){
      $this->AuthLogin();  
    	DB::table('tbl_slider')->where('slider_id', $slider_id)->update(['slider_status'=>1]);
   		Session::put('message', ' Kích hoạt slide  thành công');
   		return Redirect::to('manage-banner');
    }
    public function delete_slider($slider_id) {
      $this->AuthLogin();
      DB::table('tbl_slider')->where('slider_id', $slider_id)->delete();
      Session::put('message', 'Xóa slider thành công');
      return Redirect::to('/manage-banner');
      
      DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
      Session::put('message', 'Xóa danh mục sản phẩm thành công');
      return Redirect::to('/all-category-product');
    }
}
