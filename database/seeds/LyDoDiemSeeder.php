<?php

use Illuminate\Database\Seeder;

class LyDoDiemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ly_do_diem')->delete();
        $lydo_diem =[
            [
            'ten' => "Điểm 15p",
            
            ],
            [
                'ten' => "Điểm 30p",
                
            ],
            [
                'ten' => "Điểm 1 tiết",
                
            ],
            [
                'ten' => "Điểm cuối kỳ",
                
            ],
      ];
      DB::table('ly_do_diem')->insert($lydo_diem);
    }
}
