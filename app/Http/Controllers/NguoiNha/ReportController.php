<?php

namespace App\Http\Controllers\NguoiNha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ReportRequest;
use App\Http\Models\Report;
use Auth;

class ReportController extends Controller
{

    public function index()
    {
        return view('nguoinha.hocvien.report-hv');
    }

    public function store(ReportRequest $request)
    {
        $data = $request->only([
            'content',
            'category_report',
        ]);
        $nguoibaoho = Auth::guard('nguoibaoho')->user();

        $report = $nguoibaoho->reports()->create($data);

        return redirect()->route('nguoibaoho.home');
    }
}
