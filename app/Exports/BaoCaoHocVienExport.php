<?php

namespace App\Exports;

use App\Models\HocVien;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\HocVienExport;
use App\Exports\Sheets\HocVienNewMonthExport;
use App\Exports\Sheets\HocVienBoTronMonthExport;
class BaoCaoHocVienExport implements WithMultipleSheets
{ 
    use Exportable;
    protected $month;
    function __construct($month) {
            $this->month = $month;
    }
   
/**
* @return \Illuminate\Support\Collection
*/
    public function sheets(): array
    {
        // $hocvien = HocVien::find();
        $sheets = [];
        $sheets[]   =  new HocVienExport();
        $sheets[]   =  new HocVienNewMonthExport($this->month);
        $sheets[]   =  new HocVienBoTronMonthExport($this->month);
        return $sheets;
        
    }
}