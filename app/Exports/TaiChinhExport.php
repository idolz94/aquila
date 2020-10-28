<?php

namespace App\Exports;

use App\Models\Phong;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\TaiChinhSheet;
use Carbon\Carbon;
class TaiChinhExport implements WithMultipleSheets
{ 
    use Exportable;
    protected $hocvien;
    function __construct($hocvien) {
            $this->hocvien =  $hocvien;
    }
 
   
/**
* @return \Illuminate\Support\Collection
*/
    public function sheets(): array
    {
        // dd($this->phong);
        $sheets = [];
        for($i = 1; $i <= 12; $i++){
            $months = Carbon::create()->month($i)->format('m');
            $sheets[]   =  new TaiChinhSheet($this->hocvien,$months);
         }  
        //  dd($sheets);
        return $sheets;
    }

}