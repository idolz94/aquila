<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaoCao extends Model
{
    protected $table = 'bao_caos';

    protected $fillable = [
        'nguoi_bao_ho_id', 
        'ghi_chu', 
        'noi_dung',
    ];
    public function nguoibaoho()
    {
        return $this->belongsTo('App\Models\NguoiBaoHo','hoc_vien_id');
    }
}
