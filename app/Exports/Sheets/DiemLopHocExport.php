<?php
namespace App\Exports\Sheets;


use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\LyDoDiem;
use DB;
class DiemLopHocExport implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    protected $lophoc;

    function __construct($lophoc) {
           $this->lophoc = $lophoc;
    }
   

    /**
     * @return Builder
     */
    public function collection()
    {
        $data = [];
        $lydodiem = LyDoDiem::all();
        $hocviens = $this->lophoc->hocvien;
        $diems = DB::table('diem_mon_hocs')
        ->Leftjoin('lop_hocs', 'diem_mon_hocs.lop_hoc_id', '=', 'lop_hocs.id')
        ->Leftjoin('ly_do_diem', 'diem_mon_hocs.ly_do_id', '=', 'ly_do_diem.id')
        ->Leftjoin('hoc_viens', 'diem_mon_hocs.hoc_vien_id', '=', 'hoc_viens.id')
        ->select('hoc_viens.ten','ly_do_diem.ten as ly_do_diem','diem_mon_hocs.ly_do_id','diem_mon_hocs.diem','diem_mon_hocs.created_at','diem_mon_hocs.hoc_vien_id')
        ->where('lop_hocs.id',$this->lophoc->id)
        ->get();

        $data = [];
        foreach($hocviens as $key => $hocvien ){
            $data[$key] = ['ten'=>$hocvien->ten];
            foreach($diems as $diem) {
                if($diem->hoc_vien_id == $hocvien->id){
                //    foreach ($lydodiem as $lydo) {
                //       if($lydo->id == $diem->ly_do_id){
                //         $diem_hv = [$diem->diem,$lydo->ten];
                //       }
                //    }
                $diem_hv = $diem->ly_do_diem . ' - '. $diem->diem . '    -    '.date("d-m-Y",strtotime($diem->created_at)); 
                    array_push($data[$key],$diem_hv);
                }
            }
        }
        return collect($data);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Điểm'.$this->lophoc->ma_lop_hoc;
    }

    public function headings(): array
    {
        return[
            'Tên học viên',
            'Lý do điểm',
            'Điểm',                      
        ];
    }
}