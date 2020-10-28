<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'nguoibao_id', 
        'category_report',
        'content',
    ];

    public function nguoibaoho()
    {
        return $this->belongsTo(NguoiBaoHo::class);
    }
}
