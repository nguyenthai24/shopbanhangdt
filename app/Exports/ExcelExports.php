<?php

namespace App\Exports;

use App\models\CategoryProduct;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExports implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CategoryProduct::all();
    }
}
