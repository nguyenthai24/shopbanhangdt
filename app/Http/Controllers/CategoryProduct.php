<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //db là database
use App\Http\Requests;
use App\models\Slider;
use Session;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Excel;

use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProduct extends Controller
{ 
  public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }  
   public function add_category_product() {
    $this->AuthLogin();
   		return view('admin.add_category_product');
   }
   public function all_category_product() {
    $this->AuthLogin();
   		// get lấy toàn bộ dữ liệu trong tbl
   		$all_category_product = DB::table('tbl_category_product')->get();
   		$manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
   		
   		return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
   }
   public function save_category_product(Request $request) {
    $this->AuthLogin();
   		$data = array();
   		$data['category_name'] = $request->category_product_name;
      $data['slug_category_product'] = $request->slug_category_product;
      $data['meta_keywords'] = $request->meta_keywords;
      $data['category_desc'] = $request->category_product_desc;
      $data['category_status'] = $request->category_product_status;
   		DB::table('tbl_category_product')->insert($data);
   		Session::put('message', 'Thêm danh mục thành công');
   		return Redirect::to('/add-category-product');
   }
   //update(['category_status'=>0]) là update theo mảng giá trị
   public function unactive_category_product ($category_product_id) {
    $this->AuthLogin();
   		DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>1]);
   		Session::put('message', 'Không kích hoạt danh mục thành công');
   		return Redirect::to('/all-category-product');
   }
   public function active_category_product($category_product_id){
      $this->AuthLogin();
    	DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status'=>0]);
    	Session::put('message',' Kích hoạt danh mục thành công');
    	return Redirect::to('all-category-product');
    }
    public function edit_category_product ($category_product_id) {
      $this->AuthLogin();
    	$edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
    	$manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product)->with('');
    	return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function	update_category_product (Request $request, $category_product_id) {
      $this->AuthLogin();
    	$data = array();
      $data['category_name'] = $request->category_product_name;
      $data['slug_category_product'] = $request->slug_category_product;
      $data['meta_keywords'] = $request->meta_keywords;
      $data['category_desc'] = $request->category_product_desc;
     
   		DB::table('tbl_category_product')->where('category_id' ,$category_product_id)->update($data);
   		Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
   		return Redirect::to('/all-category-product');
    }
    public function delete_category_product ($category_product_id) {
      $this->AuthLogin();
      DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
      Session::put('message', 'Xóa danh mục sản phẩm thành công');
      return Redirect::to('/all-category-product');
    }

    //end function admin pages

    public function show_category_home (Request $request ,$slug_category_product) {

       //slider
      $slider = Slider::orderBy('slider_id', 'desc')->where('slider_status', '1')->take(4)->get();

      $product_cate = DB::table('tbl_category_product')->where('category_status', '0')->orderby('category_id', 'desc')->get();
      $product_brand = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

      $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->where('tbl_category_product.slug_category_product', $slug_category_product)->get();
  
      $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product', $slug_category_product)->limit(1)->get();
          foreach($product_cate as $key => $val){
                //seo 
                $meta_desc = $val->category_desc; 
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->category_name;
                $url_canonical = $request->url();
                //--seo
                }
    
        return view('pages.category.show_category')->with('product_cate',$product_cate)->with('product_brand',$product_brand)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider', $slider);
    }
    

    public function export_csv() {

      //ExcelExport
      // new ExcelExport  trả về tất cả trong folder export 
      // public function collection()
      // {
      //     return CategoryProduct::all();
      // }

          return Excel::download(new ExcelExports , 'category_product.xlsx');
    }
    public function import_csv(Request $request) {
      // 'file' lấy theo tên name trong form importexcel (all_category_product)
      //->getRealPath() hàm trong excel
      // $path đương dẫn
      // tại
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();

    }
}
