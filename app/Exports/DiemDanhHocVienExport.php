<?php

namespace App\Exports;

use App\Models\HocVien;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\DiemDanhHocVienSheet;

class DiemDanhHocVienExport implements WithMultipleSheets
{ 
    use Exportable;
    protected $hocvien;
    function __construct($hocvien) {
            $this->hocvien = $hocvien;
    }
   
/**
* @return \Illuminate\Support\Collection
*/
public function sheets(): array
{
    $sheets = [];
    foreach ($this->hocvien->lophoc()->get() as $lophoc) {
        $sheets[] =  new DiemDanhHocVienSheet($this->hocvien,$lophoc);
    }
    return $sheets;
    
    
}
// public function collection()
// {
   
//     $hocvien = HocVien::find($this->id);
//     dd($hocvien);
//     return MttRegistration::where('lifeskill_id',$this->id)->get()([
//         'first_name', 'email'
//     ]);
// }
}