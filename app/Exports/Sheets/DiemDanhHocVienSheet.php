<?php
namespace App\Exports\Sheets;


use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;
class DiemDanhHocVienSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize,WithStyles
{
    protected $lophoc;
    protected $hocvien;

    function __construct($hocvien,$lophoc) {
           $this->hocvien = $hocvien;
           $this->lophoc = $lophoc;

    }
   

    /**
     * @return Builder
     */
    public function collection()
    {   
        $diemdanh = $this->hocvien->diemdanh()->wherePivot('lop_hoc_id',$this->lophoc->id)->get();
        $thoikhoabieu = DB::table('thoi_khoa_bieus')
        ->Leftjoin('lop_hocs', 'thoi_khoa_bieus.lop_hoc_id', '=', 'lop_hocs.id')
        ->select('thoi_khoa_bieus.*', 'lop_hocs.ma_lop_hoc')
        ->where('lop_hocs.id',$this->lophoc->id)
        ->get();
        $data = [];
        $count = 0;
        foreach($thoikhoabieu as $key =>  $thoi_khoa_bieu){
            $data[$key] = ['ngay'=>date("d-m-Y",strtotime($thoi_khoa_bieu->ngay))];
           foreach($diemdanh as $diem_danh){
               if(date("Y-m-d",strtotime($thoi_khoa_bieu->ngay)) == date("Y-m-d",strtotime($diem_danh->pivot->ngay))){
                   if($diem_danh->pivot->ca_hoc == 0){
                        $diemdanh_hv = 'Có';
                        array_push($data[$key],$diemdanh_hv);
                   }
                   if( $diem_danh->pivot->ca_hoc == 1){
                        $diemdanh_hv = 'Có';
                        array_push($data[$key],$diemdanh_hv);
                   }
               }
              
           }
           if($thoi_khoa_bieu->ngay < date('Y-m-d') && $this->hocvien->checkNotDiemDanh($thoi_khoa_bieu->ngay,$this->lophoc->id,0) == null ){
               $diemdanh_hv = 'Vắng';
                array_push($data[$key],$diemdanh_hv);
           }if($thoi_khoa_bieu->ngay < date('Y-m-d') && $this->hocvien->checkNotDiemDanh($thoi_khoa_bieu->ngay,$this->lophoc->id,1) == null ){
            $diemdanh_hv = 'Vắng';
            array_push($data[$key],$diemdanh_hv);
           }
        }
        return collect($data);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Lớp '.$this->lophoc->ma_lop_hoc;
    }

    public function headings(): array
    {
        return[
            'Ngày',
            'Điểm danh sáng',
            'Điểm danh chiều',                      
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('B2:B500')->getAlignment()->applyFromArray(
            array('horizontal' => 'center')
        );
        $sheet->getStyle('C2:C500')->getAlignment()->applyFromArray(
            array('horizontal' => 'center')
        );
    }
}