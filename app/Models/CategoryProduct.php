<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    public $timestamps = false; //set time to false
    // fillable có thể làm đầy khi insert dữ liệu vào các cột
    protected $fillable = [
    	'category_name', 'slug_category_product', 'category_desc','category_status','meta_keywords'
    ];
    protected $primaryKey = 'category_id';
 	protected $table = 'tbl_category_product';
}
