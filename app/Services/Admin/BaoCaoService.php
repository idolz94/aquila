<?php

namespace App\Services\Admin;

use App\Models\BaoCao;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;

class BaoCaoService extends BaseService
{
    public function model()
    {
        return BaoCao::class;
    }

}
