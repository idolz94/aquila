<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\HePhaiService;
use App\Http\Requests\Admin\HePhaiRequest;
use Exception;
use Session;
class HePhaiController extends Controller
{
    protected $hephaiService;

    public function __construct(HePhaiService $hephaiService)
    {
        $this->hephaiService = $hephaiService;
    }

    /**
     * Display a listing of the resource.
     *m
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('admin.giaovien.hephai.index');        
    }

    public function list(Request $request)
    {
        $list_hephai = $this->hephaiService->getListHePhai($request->all());
        return $list_hephai;
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
    public function store(HePhaiRequest $request)
    {
        $result = $this->hephaiService->store($request);
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
        //
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
        $id = explode('_',$id);
        $result = $this->hephaiService->update($request->all(),$id[1]);
        if ($result) {
            Session::flash('message', trans('Thêm thành công ! '));
            return redirect()->route('admin.hephai.index');
        }
        Session::flash('error', trans('Thêm thất bại !'));
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
            $this->hephaiService->delete($id);
            return redirect()->route('admin.hephai.index')->with('message', 'Xóa thành công');
        } catch (Exception $e) {
            report($e);
            return redirect()->route('admin.hephai.index')->with('error', 'Xóa không thành công');
        }
    }
}
