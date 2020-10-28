<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DienGiaiTaiChinhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dien_giai_tai_chinhs')->delete();
        $diengiai_taichinh =[
            [
            'ten_dien_giai' => "Chuyển từ tháng trước",
            'thu_chi' => 0,
            ],
            [
                'ten_dien_giai' => "Hỗ trợ từ HT Aquila",
                'thu_chi' => 0,
            ],
            [
                'ten_dien_giai' => "Học viên nộp tiền",
                'thu_chi' => 0,
            ],
            [
                'ten_dien_giai' => "Tiền ký quỹ/đặt cọc",
                'thu_chi' => 1,
            ],
            [
                'ten_dien_giai' => "Tiền ăn",
                'thu_chi' => 1,
            ],
            [
                'ten_dien_giai' => "Tiền HL",
                'thu_chi' => 1,
            ],
            [
                'ten_dien_giai' => "Chi Bảo Trì",
                'thu_chi' => 1,
            ],
            [
                'ten_dien_giai' => "XDCSVC/CP Đầu vào",
                'thu_chi' => 1,
            ],
            [
                'ten_dien_giai' => "Chăm sóc giải cứu",
                'thu_chi' => 1,
            ],
            [
                'ten_dien_giai' => "Chi Cá nhân",
                'thu_chi' => 1,
            ],
            [
                'ten_dien_giai' => "Dâng hiến",
                'thu_chi' => 1,
            ],
            [
                'ten_dien_giai' => "Chi khác",
                'thu_chi' => 1,
            ],
      ];
      DB::table('dien_giai_tai_chinhs')->insert($diengiai_taichinh);
    }
}
