<?php

namespace App\Exports;

use App\Models\Phong;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\DiemLopHocExport;
use App\Exports\Sheets\DiemDanhLopHocExport;
use Carbon\Carbon;
class ChiTietLopHocExport implements WithMultipleSheets
{ 
    use Exportable;
    protected $lophoc;
    function __construct($lophoc) {
            $this->lophoc =  $lophoc;
    }
 
   
/**
* @return \Illuminate\Support\Collection
*/
    public function sheets(): array
    {
        $sheets[]  = new DiemLopHocExport($this->lophoc);
        $sheets[]  = new DiemDanhLopHocExport($this->lophoc);
        return $sheets;
    }

}