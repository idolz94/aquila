<?php

namespace App\Services\Admin;

use App\Models\Admin;
// use App\Services\Helpers\ImageService;
use Exception;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AdminService extends BaseService
{
    public function model()
    {
        return Admin::class;
    }

    public function getListAdmin($request)
    {
        $data = $this->all()->makeVisible(['role']);

        $data->map(function ($item) {
            $item->role = $item->getTextAttributeRole($item->role);
            $item->gender = $item->getTextAttributeGender($item->gender);
            
            return $item;
        });

        return response()->json([
            'data' => $data
        ]);
    }

    public function store($request)
    { 
        $request['password'] = Hash::make(config('admin.password_default'));

        return $this->create($request);
    }

    public function deleteAdmin($id)
    {
        try {
            $admin = $this->findOrFail($id);
            $admin->delete();

            return true;
        } catch (Exception $e) {
            Log::debug($e);

            return false;
        }
    }

}
