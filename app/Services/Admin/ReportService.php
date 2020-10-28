<?php

namespace App\Services\Admin;

use App\Models\Report;
use Exception;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
class ReportService extends BaseService
{
    public function model()
    {
        return Report::class;
    }

    public function getListReport($request)
    {
        $data = $this->model->with('nguoibaoho.hocvien')->get()->toArray();
        foreach ($data as $value => $item) {
            foreach (Config::get('admin.category_report') as $key => $category){
                if($category['val'] == $item['category_report']){
                    $item['category_report'] = $category['text'];
                }
            }
            $data[$value] = $item;
        }
        return response()->json([
            'data' => $data
        ]);
    }

    public function deleteReport($id)
    {
        try {
            $report = $this->findOrFail($id);
            $report->delete();

            return true;
        } catch (Exception $e) {
            Log::debug($e);

            return false;
        }
    }

}
