<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Carbon\Carbon;
class HocVien extends Model
{
    // use SoftDeletes;
    
    const CHUA_SU_DUNG = 0;
    const DA_SU_DUNG = 1;

    protected $table = 'hoc_viens';

    protected $fillable = [
        'nguoi_bao_ho_id', 
        'ma_hoc_vien', 
        'ten',
        'dia_chi', 
        'ngay_sinh', 
        'gioi_tinh',
        'ngay_vao',
        'ngay_tot_nghiep',
        'so_cmnd',
        'ngay_cap_cmnd', 
        'noi_cap_cmnd', 
        'trinh_do_van_hoa',
        'hon_nhan', 
        'vo_chong',
        'con_1',
        'con_2',
        'nghe_nghiep', 
        'tinh_trang',
        'tien_an', 
        've_toi_tien_an', 
        'tien_su',
        've_toi_tien_su', 
        'ma_tuy_su_dung', 
        'hinh_thuc_su_dung',
        'tien_su_benh_ly', 
        'chieu_cao', 
        'can_nang',
        'avatar_url',
        'tai_chinh_con_lai',
        'import',
    ];

    public function kyluat()
    {
        return $this->hasOne('App\Models\KyLuat');
    }

    public function vephep()
    {
        return $this->hasOne('App\Models\VePhep');
    }

    public function khamsuckhoe()
    {
        return $this->hasOne('App\Models\KhamSucKhoe');
    }
    
    public function tinhtrangnghien()
    {
        return $this->hasOne('App\Models\TinhTrangNghien');
    }

    public function truongnhom()
    {
        return $this->hasOne('App\Models\Nhom','truong_nhom_id');
    }

    public function truongphong()
    {
        return $this->hasOne('App\Models\Phong','ten_truong_phong');
    }
    
    public function nguoibaoho()
    {
        return $this->belongsTo('App\Models\NguoiBaoHo','nguoi_bao_ho_id');
    }

    public function trungtam()
    {
        return $this->hasOne('App\Models\TrungTam');
    }

    public function ngayhocvien()
    {
        return $this->hasMany('App\Models\NgayHocVien');
    }

    public function anhhocvien()
    {
        return $this->hasMany(AnhHocVien::class, 'hoc_vien_id');
    }

    public function anhquatrinh()
    {
        return $this->hasMany(AnhQuaTrinh::class, 'hoc_vien_id');
    }

    public function phong()
    {
        return $this->belongsToMany('App\Models\Phong','phong_hoc_viens')->withPivot('ly_do','type')->withTimestamps();
    } 

    public function taichinh()
    {
        return $this->hasMany('App\Models\TaiChinh');
    }

    public function hanhkiem()
    {
        return $this->hasOne('App\Models\HanhKiem');
    }

    public function nhom()
    {
        return $this->belongsToMany('App\Models\Nhom','nhom_hoc_vien')->withTimestamps();
    }

    public function sukien()
    {
        return $this->belongsToMany('App\Models\SuKien','su_kien_hoc_vien');
    }

    public function lophoc()
    {
        return $this->belongsToMany('App\Models\LopHoc','lop_hoc_hoc_vien');
    } 


    public function diemdanh()
    {
        return $this->belongstoMany('App\Models\LopHoc','diem_danh_lop_hocs')->withTimestamps()->withPivot('ca_hoc','ngay','created_at');
    } 

    public function diem_monhoc()
    {
        return $this->belongstoMany('App\Models\LopHoc','diem_mon_hocs')->withPivot('diem', 'ly_do_id')->withTimestamps();
    } 

    public function huongnghiep()
    {
        return $this->belongsToMany('App\Models\HuongNghiep','huong_nghiep_hoc_vien')->withTimestamps();
    }

    public function checkNotDiemDanh($ngay,$lop_hoc_id,$ca_hoc){
        return DB::table('diem_danh_lop_hocs')
        ->Leftjoin('lop_hocs', 'diem_danh_lop_hocs.lop_hoc_id', '=', 'lop_hocs.id')
        ->Leftjoin('hoc_viens', 'diem_danh_lop_hocs.hoc_vien_id', '=', 'hoc_viens.id')
        ->select('diem_danh_lop_hocs.*')
        ->where('diem_danh_lop_hocs.ngay',$ngay)
        ->where('diem_danh_lop_hocs.lop_hoc_id',$lop_hoc_id)
        ->where('diem_danh_lop_hocs.ca_hoc',$ca_hoc)
        ->first();
    }

}
