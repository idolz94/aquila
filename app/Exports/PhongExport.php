<?php

namespace App\Exports;

use App\Models\Phong;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\PhongSheetExport;
use App\Exports\Sheets\MonthOfYearPhongSheet;
use Carbon\Carbon;
class PhongExport implements WithMultipleSheets
{ 
    use Exportable;
    protected $phong;
    function __construct($phong) {
            $this->phong =  $phong;
    }
 
   
/**
* @return \Illuminate\Support\Collection
*/
    public function sheets(): array
    {
        // dd($this->phong);
        $sheets = [];
        $sheets[]   =  new PhongSheetExport($this->phong);
        for($i = 1; $i <= 12; $i++){
            $months = Carbon::create()->month($i)->format('m');
            $sheets[]   =  new MonthOfYearPhongSheet($this->phong,$months);
         }  
        //  dd($sheets);
        
        return $sheets;
    }

}