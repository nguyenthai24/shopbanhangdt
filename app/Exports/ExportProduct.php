<?php

namespace App\Exports;

use App\models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportProduct implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
}
