<?php

namespace App\Exports;
use App\Models\SuKien;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\SuKienHocVienSheet;
use App\Exports\Sheets\ChiTietSuKienSheet;
use Carbon\Carbon;
class SuKienExport implements WithMultipleSheets
{ 
    use Exportable;
    protected $sukien;
    function __construct($sukien) {
            $this->sukien =  $sukien;
    }
   
/**
* @return \Illuminate\Support\Collection
*/
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new ChiTietSuKienSheet($this->sukien);
        $sheets[] = new SuKienHocVienSheet($this->sukien);
        
        return $sheets;
    }

}