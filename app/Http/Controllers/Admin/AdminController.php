<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use App\Http\Requests\Admin\AdminRequest;
use App\Services\Helpers\ImageService;
use Illuminate\Support\Facades\Hash;
use Auth;
use Exception;
use Session;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {   
        $data = $request->only([
            'ten',
            'role',
            'email',
            'gender',
        ]);

        $result = $this->adminService->store($data);
      
        if ($result) {
            Session::flash('message', trans('Thêm thành công ! '));

            return response()->json([
                'status' => true,
            ]);
        }

        Session::flash('error', trans('Thêm thất bại !'));

        return response()->json([
            'status' => false,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = $this->adminService->findOrFail($id)
        ->makeVisible(['role']);
        return view('admin.admin.profile',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = $this->adminService->findOrFail($id)
            ->makeVisible(['role']);

        return response()->json([
            'data' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'ten',
            'role',
            'gender',
        ]);

        $result = $this->adminService->update($data, $id);
      
        if ($result) {
            return redirect()->route('admin.manage.index')->with([
                'message' => trans('admin/message.update_success'),
            ]);
        }

        return redirect()->route('admin.manage.index')->with([
            'message' => trans('admin/message.update_failed'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedAdmin = $this->adminService->deleteAdmin($id);

        if ($deletedAdmin) {
            return redirect()->route('admin.manage.index')->with([
                'message' => trans('admin/message.delete_success'),
            ]);
        }

        return redirect()->route('admin.manage.index')->with([
            'message' => trans('admin/message.delete_failed'),
        ]);
    }

    public function list(Request $request)
    {
        return $this->adminService->getListAdmin($request);
    }

    public function changePassword(Request $request,$id){
    
        $admin = $this->adminService->findOrFail($id);
        // dd(!Hash::check($request->password_old, $admin->password));
        if (!Hash::check($request->password_old, $admin->password)) {
            // The passwords matches
            return redirect()->back()->with("error","Mật khẩu cũ không đúng.");
        }

        if(strcmp($request->password_old, $request->password) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Mật khẩu mới không trùng mật khẩu cũ");
        }
        $validatedData = $request->validate([
            'password_old' => 'required',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|same:password',
        ]);

        //Change Password
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->back()->with("message","Thay đổi mật khẩu thành công"); 
    }

    public function addAvatar(Request $request,$id){
        $data = $request->all();
        $admin = $this->adminService->findOrFail($id);
        if (isset($data['avatar'])) {
            $type = 'admin_avatar';
            $data['avatar'] = ImageService::uploadFile($data['avatar'], $type, config('images.paths.' . $type));
            $admin->avatar = $data['avatar'];
            $admin->save();
            return redirect()->back()->with("message","Cập nhật avatar thành công"); 
        }
        return back()->with('error','Cập nhật avatar lỗi');
    }

}
