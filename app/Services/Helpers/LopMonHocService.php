<?php

namespace App\Services\Helpers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Exception;
use Log;

class LopMonHocService
{


   public static function checkLopMonHoc($data){
      return count($data->monhoc) > 0;
   }


   public static function checkLopHocVien($data){
      return count($data->hocvien) > 0;
   }
}
