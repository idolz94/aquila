<?php
namespace App\Exports\Sheets;


use Modules\Report\Entities\Aereport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;
class MonthOfYearPhongSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    protected $phong;
    protected $months;

    function __construct($phong,$months) {
           $this->phong = $phong;
           $this->months = $months;

    }
   

    /**
     * @return Builder
     */
    public function collection()
    {
        return DB::table('phong_hoc_viens')
        ->Leftjoin('hoc_viens', 'phong_hoc_viens.hoc_vien_id', '=', 'hoc_viens.id')
        ->Leftjoin('phongs', 'phong_hoc_viens.phong_id', '=', 'phongs.id')
        ->select('hoc_viens.ten',
        DB::raw('DATE_FORMAT(phong_hoc_viens.created_at, "%d-%m-%Y") as created_at'),
        DB::raw('DATE_FORMAT(phong_hoc_viens.updated_at, "%d-%m-%Y") as updated_at'))
        ->whereMonth('phong_hoc_viens.created_at',$this->months)
        ->where('phongs.id',$this->phong->id)
        ->get();
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Tháng '.$this->months;
    }

    public function headings(): array
    {
        return[
            'Tên học viên',
            'Ngày vào',
            'Ngày ra',
                            
        ];
    }
}