<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class LopHoc extends Model
{
     
    protected $table = 'lop_hocs';

    protected $fillable = [
        'ma_lop_hoc', 
        'ngay_bat_dau', 
        'ngay_ket_thuc',
        'ghi_chu', 
        'mon_hoc_id', 
        'giao_vien_id', 
    ];

    public function hocvien()
    {
        return $this->belongsToMany('App\Models\HocVien','lop_hoc_hoc_vien');
    } 


    public function monhoc()
    {
        return $this->belongsTo('App\Models\MonHoc','mon_hoc_id');
    } 

    public function giaovien()
    {
        
        return $this->belongsTo('App\Models\GiaoVien','giao_vien_id');
    }
    
    public function diemdanh()
    {
        return $this->belongstoMany('App\Models\HocVien','diem_danh_lop_hocs')->withPivot('ca_hoc','ngay','created_at')->withTimestamps();
    } 

    public function diem_monhoc()
    {
        return $this->belongstoMany('App\Models\HocVien','diem_mon_hocs')->withPivot('diem', 'ly_do_id')->withTimestamps();
    } 

    public function anhlophoc()
    {
        return $this->hasMany('App\Models\AnhLopHoc','lop_hoc_id'); 
    }
    
    

    public function thoikhoabieu()
    {
        return $this->hasMany('App\Models\ThoiKhoaBieu'); 
    }

    public function thoikhoabieu_hocvien(){
        $thoikhoabieu = DB::table('thoi_khoa_bieus')
        ->Leftjoin('lop_hocs', 'thoi_khoa_bieus.lop_hoc_id', '=', 'lop_hocs.id')
        ->select('thoi_khoa_bieus.*', 'lop_hocs.ma_lop_hoc')
        ->where('lop_hocs.id',$this->id)
        ->get()->toArray();
        // dd($thoikhoabieu);
        return $thoikhoabieu;
    }


}
