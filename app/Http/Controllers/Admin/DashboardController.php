<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HocVien;
use App\Models\LopHoc;
use App\Models\MonHoc;
use Illuminate\Support\Facades\Hash;
use Auth;
use Exception;
use Session;

class DashboardController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countHocVien = HocVien::count();
        $countLopHoc = LopHoc::count();
        $countMonHoc = MonHoc::count();

        return view('admin.dashboard.index',compact('countHocVien','countLopHoc','countMonHoc'));
    }

}
