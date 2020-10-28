<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\MonHocService;
use App\Http\Requests\Admin\MonHocRequest;
use App\Models\BoMon;
use App\Models\MonHoc;
use App\Models\GiaoVien;
use Carbon\Carbon;
//use App\Http\Requests\Admin\LopHocRequest;
use Exception;
use Session;
class MonHocController extends Controller
{
    protected $monhocService;

    public function __construct(MonHocService $monhocService)
    {
        $this->monhocService = $monhocService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $bomons = BoMon::all();
        return view('admin.monhoc.index',compact('bomons'));
    }

    public function list(Request $request)
    {
        $listClass = $this->monhocService->getListMonHoc($request->all());
        return $listClass;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MonHocRequest $request)
    {   

        $result = $this->monhocService->store($request->all());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $monhoc = $this->monhocService->find($id);
        $bomons = BoMon::all();
        return response()->json(['monhoc'=>$monhoc,'bomon'=>$bomon]);
        // return view('admin.monhoc.edit',compact('monhoc','bomons'));
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
        if(MonHoc::where('mon_hoc',$request->mon_hoc)->where('id',$id)->first()){
            $request->request->remove('mon_hoc');
        }
        $result = $this->monhocService->update($request->all(),$id);
        if ($result) {
            Session::flash('message', trans('Thêm thành công ! '));
            // return response()->json([
            //     'status' => true,
            // ]);
            return redirect()->route('admin.monhoc.index')->with('message', 'sửa môn học thành công');;
        }

        Session::flash('error', trans('Thêm thất bại !'));
        // return response()->json([
        //     'status' => false,
        // ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->monhocService->delete($id);
            return redirect()->route('admin.monhoc.index')->with('message', 'Xóa thành công');
        } catch (Exception $e) {
            report($e);

            return redirect()->route('admin.monhoc.index')->with('error', 'Xóa không thành công');
        }
    }
}
