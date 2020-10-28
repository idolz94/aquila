<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$host = env('APP_HOST');

/* admin route */

Route::domain(env('ADMIN_SUB_DOMAIN') . '.' . $host)->group(function () {
    Route::get('login', 'Auth\LoginController@index')->name('login.admin');
    Route::post('login', 'Auth\LoginController@store')->name('store.admin');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout.admin');
    Route::get('forgot', 'Auth\ForgotPasswordController@index')->name('forgot.admin');
    Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@formForgot')->name('formRequest.admin');
    Route::put('forgot', 'Auth\ForgotPasswordController@sendMailWithToken')->name('sendMailWithToken.forgot.admin');
    Route::post('forgot/{token}', 'Auth\ForgotPasswordController@changePassword')->name('changePassword.forgot.admin');

    Route::group(['as' => 'admin.','middleware' => 'auth.admin',  'namespace' => 'Admin'], function () {
        // Route::get('/', function () {

        //     return view('admin.dashboard.index');
        // })->name('dashboard');
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('/manage', 'AdminController')->middleware('check_role:supper_admin');
        Route::get('/manage-list', 'AdminController@list')->name('manage.list')->middleware('check_role:supper_admin');
        Route::post('/manage/avatar/{id}', 'AdminController@addAvatar')->name('manage.avatar')->middleware('check_role:supper_admin');
        Route::post('/manage-change/{id}', 'AdminController@changePassword')->name('manage.change')->middleware('check_role:supper_admin');

        /* Bộ môn */
        Route::resource('/bomon', 'BoMonController')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');
        Route::get('/bomon-list', 'BoMonController@list')->name('bomon.list')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');

        /* Môn Học */
        Route::resource('/monhoc', 'MonHocController')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');
        Route::get('/monhoc-list', 'MonHocController@list')->name('monhoc.list')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');

        /* Giáo viên */
        Route::resource('/giaovien', 'GiaoVienController')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::get('/giaovien-list', 'GiaoVienController@list')->name('giaovien.list')->middleware('check_role:supper_admin,quan_ly');
        Route::get('/giaovien/excel/get', 'GiaoVienController@excel')->name('giaovien.excel')->middleware('check_role:supper_admin,quan_ly');

        /* Chức vụ */
        Route::resource('/chucvu', 'ChucVuController')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::get('/chucvu-list', 'ChucVuController@list')->name('chucvu.list')->middleware('check_role:supper_admin,quan_ly');

        /* Hệ phai */
        Route::resource('/hephai', 'HePhaiController')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::get('/hephai-list', 'HePhaiController@list')->name('hephai.list')->middleware('check_role:supper_admin,quan_ly');

        /* Lớp Học */
        Route::resource('/lophoc', 'LopHocController')->middleware('check_role:supper_admin,dao_tao,quan_ly');
        Route::get('/lophoc-list', 'LopHocController@list')->name('lophoc.list')->middleware('check_role:supper_admin,dao_tao,quan_ly');
        Route::post('/lophoc/filter', 'LopHocController@filter')->name('lophoc.filter')->middleware('check_role:supper_admin,dao_tao,quan_ly');
        Route::get('/lophoc/hocvien/add/{id}', 'LopHocController@create')->name('lophoc.hocvien.create')->middleware('check_role:supper_admin,dao_tao,quan_ly');
        // Route::get('/lophoc/tkb/{id}', 'LopHocController@lopThoiKhoaBieu')->name('lophoc.tkb')->middleware('check_role:supper_admin,dao_tao,quan_ly');
        Route::get('/lophoc/tkb/list/{id}', 'LopHocController@listThoiKhoaBieu')->name('lophoc.tkb.list')->middleware('check_role:supper_admin,dao_tao,quan_ly');
        Route::get('/lophoc/diemdanh/list', 'LopHocController@listLopDiemDanh')->name('lophoc.diemdanh')->middleware('check_role:supper_admin,quan_ly,hanh_chinh,dao_tao');
        Route::get('/lophoc/{id}/diemdanh/create', 'LopHocController@lophocDiemDanh')->name('lophoc.diemdanh.create')->middleware('check_role:supper_admin,quan_ly,hanh_chinh,dao_tao');
        Route::get('/lophoc/{id}/diemdanh/create/ngay', 'LopHocController@lophocDiemDanhDetail')->name('lophoc.diemdanh.create.detail')->middleware('check_role:supper_admin,quan_ly,hanh_chinh,dao_tao');
        Route::post('/lophoc/list/diemdanh', 'LopHocController@listDiemDanh')->name('lophoc.diemdanh.list')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');
        Route::get('/lophoc/diemdanh/show/{id}/{lophoc}', 'LopHocController@showDiemDanh')->name('lophoc.diemdanh.show')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');
        Route::get('/lophoc/diem/list', 'LopHocController@listLopDiem')->name('lophoc.diem')->middleware('check_role:supper_admin,quan_ly');
        Route::post('/lophoc/diem/store', 'LopHocController@storeDiem')->name('lophoc.diem.store')->middleware('check_role:supper_admin,quan_ly');
        Route::get('/lophoc/diem/create/{id}', 'LopHocController@lopHocDiem')->name('lophoc.diem.create')->middleware('check_role:supper_admin,quan_ly');
        Route::get('/lophoc/create/images/{id}', 'LopHocController@createImages')->name('lophoc.create.images')->middleware('check_role:supper_admin,quan_ly');
        Route::post('/lophoc/create/images/{id}/post', 'LopHocController@storeImages')->name('lophoc.post.images')->middleware('check_role:supper_admin,quan_ly');

        Route::post('/lophoc/diem/lydo', 'LopHocController@monHocDiemLyDo')->name('lophoc.diem.lydo')->middleware('check_role:supper_admin,quan_ly');
        Route::post('/lophoc/monhoc/diemdanh', 'LopHocController@monHocDiemDanhPost')->name('lophoc.monhoc.diemdanh.post')->middleware('check_role:supper_admin,quan_ly');
        Route::post('/lophoc/monhoc/{id}', 'LopHocController@lopMonHoc')->name('lophoc.monhoc')->middleware('check_role:supper_admin,quan_ly');
        Route::post('/lophoc/hocvien/{id}', 'LopHocController@lopHocVien')->name('lophoc.hocvien')->middleware('check_role:supper_admin,quan_ly');
        Route::get('/lophoc/json/{id}', 'LopHocController@editJson')->name('lophoc.json')->middleware('check_role:supper_admin,quan_ly');
        Route::get('/lophoc/all/export', 'LopHocController@export')->name('lophoc.export')->middleware('check_role:supper_admin,quan_ly');
        Route::get('/lophoc/export/{id}', 'LopHocController@exportDetail')->name('lophoc.export.detail')->middleware('check_role:supper_admin,quan_ly');

        /* Lớp Học */
        Route::resource('/lydo', 'LyDoDiemController')->middleware('check_role:supper_admin,dao_tao,quan_ly');
        Route::get('/lydo-list', 'LyDoDiemController@list')->name('lydo.list')->middleware('check_role:supper_admin,dao_tao,quan_ly');

        /* Thời khoá biểu */
        Route::resource('/thoi-khoa-bieu', 'ThoiKhoaBieuController')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');
        Route::get('/thoi-khoa-bieu/index/{lophoc}', 'ThoiKhoaBieuController@index')->name('thoi-khoa-bieu.index')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');
        Route::get('/thoi-khoa-bieu/all/lophoc', 'ThoiKhoaBieuController@indexLopHoc')->name('thoi-khoa-bieu.all.lophoc')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');
        Route::post('/thoi-khoa-bieu/get/lophoc', 'ThoiKhoaBieuController@lopHoc')->name('thoi-khoa-bieu.lophoc')->middleware('check_role:supper_admin,quan_ly,dao_tao,hanh_chinh');

        /* Học Viên */
        Route::resource('/hoc-vien', 'HocVienController')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/hoc-vien-list', 'HocVienController@list')->name('hoc-vien.list')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/hoc-vien/list2', 'HocVienController@listCalander')->name('hoc-vien.list.calandar')->middleware('check_role:supper_admin');
        Route::post('/hoc-vien/import', 'HocVienController@import')->name('hoc-vien.import')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/hoc-vien/all/export', 'HocVienController@export')->name('hoc-vien.export')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        
        /* chỉnh sửa lại route view import học viên */
        Route::get('/hv-import', 'HocVienController@importView')->name('hoc-vien.importView')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        /* ------------------- */

        Route::get('/hoc-vien/theodoiyte/{id}', 'HocVienController@theoDoiYTe')->name('hoc-vien.theo-doi-y-te')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/hoc-vien/vephep/{id}', 'HocVienController@vePhep')->name('hoc-vien.ve-phep')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
       
        Route::get('/hoc-vien/taichinh/filter/{id}', 'HocVienController@filterTaiChinh')->name('hoc-vien.taichinh.filter')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/hoc-vien/anhquatrinh/{id}', 'HocVienController@indexAnhQuaTrinh')->name('hoc-vien.anhquatrinh.index')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::post('/hoc-vien/anhquatrinh', 'HocVienController@themAnhQuaTrinh')->name('hoc-vien.anhquatrinh.post')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/hoc-vien/diem/export/{id}', 'HocVienController@exportDiem')->name('hoc-vien.diem.export')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/hoc-vien/diemdanh/export/{id}', 'HocVienController@exportDiemDanh')->name('hoc-vien.diemdanh.export')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');

        /* Về phép */
        Route::resource('ve-phep', 'VePhepController')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/ve-phep-list/{id}', 'VePhepController@list')->name('ve-phep.list')->middleware('check_role:supper_admin,hanh_chinh,quan_ly');

        /* Phòng */
        Route::resource('phong', 'PhongController')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::get('phong-list', 'PhongController@list')->name('phong.list')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::get('phong/create-hv/{id}', 'PhongController@createHocVien')->name('phong.create.hv')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::post('phong/create-hv', 'PhongController@postHocVien')->name('phong.post.hv')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::post('phong/add-hv', 'PhongController@hocvienAll')->name('phong.add.hv')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::post('phong/chuyen-phong', 'PhongController@chuyenPhong')->name('phong.chuyenphong')->middleware('check_role:supper_admin');
        Route::get('phong/add_truong_phong/{id}', 'PhongController@show')->name('phong.truongphong.create')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::post('phong/add_truong_phong', 'PhongController@storeTruongPhong')->name('phong.truongphong')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::get('phong/show_hocvien/{id}', 'PhongController@showHocVien')->name('phong.show.hocvien')->middleware('check_role:supper_admin,admin,quan_ly');
        Route::get('/phong/export/{id}', 'PhongController@export')->name('phong.export')->middleware('check_role:supper_admin,admin,quan_ly');
     
         /* Diễm giải tài chính*/
        Route::resource('diengiai-taichinh', 'DienGiaiTaiChinhController')->middleware('check_role:supper_admin,quan_ly,tai_chinh');
        Route::get('/diengiai-taichinh-list', 'DienGiaiTaiChinhController@list')->name('diengiai-taichinh.list')->middleware('check_role:supper_admin,quan_ly,tai_chinh');

          /* Tài chính */
        Route::resource('/taichinh', 'TaiChinhController')->middleware('check_role:supper_admin,quan_ly,tai_chinh');
        Route::get('/taichinh/filter/{id}', 'TaiChinhController@filterMonth')->name('taichinh.filter')->middleware('check_role:supper_admin,quan_ly,tai_chinh');
        Route::get('/taichinh/export/{id}', 'TaiChinhController@export')->name('taichinh.export')->middleware('check_role:supper_admin,quan_ly,tai_chinh');

         /* Hạnh kiểm */
        Route::resource('hanhkiem', 'HanhKiemController')->middleware('check_role:supper_admin,dao_tao,quan_ly');
        Route::get('/hanhkiem-list', 'HanhKiemController@list')->name('hanhkiem.list')->middleware('check_role:supper_admin,dao_tao,quan_ly');

          /* Nhóm */
        Route::resource('/nhom', 'NhomController')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');
        Route::get('/nhom-list', 'NhomController@list')->name('nhom.list')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');
        Route::resource('/nhomcha', 'NhomChaController')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');
        Route::get('/nhomcha-list', 'NhomChaController@list')->name('nhomcha.list')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');
        Route::get('/nhom-hocvien/{id}', 'NhomController@nhomHocVien')->name('nhom.hocvien')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');
        Route::post('/nhom-hocvien', 'NhomController@nhomHocVienPost')->name('nhom.hocvien.post')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');
        Route::get('/nhom-hocvien-list/{id}', 'NhomController@nhomHocVienList')->name('nhom.hocvien.list')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');
        Route::get('/nhom-hocvien-export/{id}', 'NhomController@nhomHocVienExport')->name('nhom.hocvien.export')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');

          /* Kỷ luật */
        Route::resource('kyluat', 'KyLuatController',
        array('names' => array('create' => 'create/{id}')))->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');
        Route::get('/kyluat-list', 'KyLuatController@list')->name('kyluat.list')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');
        Route::get('kyluat/create/{id}', 'KyLuatController@create')->name('kyluat.created')->middleware('check_role:supper_admin,admin,dao_tao,quan_ly');

        /* Khám Sức Khoẻ */
        Route::resource('khamsuckhoe', 'KhamSucKhoeController')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/khamsuckhoe-list', 'KhamSucKhoeController@list')->name('khamsuckhoe.list')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('khamsuckhoe/create/{id}', 'KhamSucKhoeController@create')->name('khamsuckhoe.created')->middleware('check_role:supper_admin,hanh_chinh,quan_ly');
        Route::get('khamsuckhoe/count/{id}', 'KhamSucKhoeController@count')->name('khamsuckhoe.count')->middleware('check_role:supper_admin,hanh_chinh,quan_ly');
        Route::get('khamsuckhoe/excel/{id}', 'KhamSucKhoeController@excel')->name('khamsuckhoe.excel')->middleware('check_role:supper_admin,hanh_chinh,quan_ly');

        /* Tình Trạng Nghiện */
        Route::resource('tinhtrangnghien', 'TinhTrangNghienController')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('/tinhtrangnghien-list', 'TinhTrangNghienController@list')->name('tinhtrangnghien.list')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('tinhtrangnghien/create/{id}', 'TinhTrangNghienController@create')->name('tinhtrangnghien.created')->middleware('check_role:supper_admin,quan_ly');
        Route::get('tinhtrangnghien/count/{id}', 'TinhTrangNghienController@count')->name('tinhtrangnghien.count')->middleware('check_role:supper_admin,quan_ly');

      
        /* Sự kiện */
        Route::resource('sukien', 'SuKienController')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('sukien-list', 'SuKienController@list')->name('sukien.list')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('sukien-list-show/{id}', 'SuKienController@listShow')->name('sukien.list.show')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('sukien/hocvien/{id}', 'SuKienController@hocVien')->name('sukien.hocvien')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('sukien/{id}/excel', 'SuKienController@excel')->name('sukien.excel')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::post('sukien-hocvien', 'SuKienController@hocVienPost')->name('sukien.hocvien.post')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::post('sukien-ketqua', 'SuKienController@updateKetQua')->name('sukien.ketqua')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');

        /* Hướng Nghiệp */
        Route::resource('huongnghiep', 'HuongNghiepController')->middleware('check_role:supper_admin,quan_ly,hanh_chinh');
        Route::get('huongnghiep-list', 'HuongNghiepController@list')->name('huongnghiep.list')->middleware('check_role:supper_admin,quan_ly');
        Route::get('huongnghiep/create-hv/{id}', 'HuongNghiepController@createHocVien')->name('huongnghiep.create.hv')->middleware('check_role:supper_admin,quan_ly');
        Route::post('huongnghiep/post-hv/{id}', 'HuongNghiepController@postHocVien')->name('huongnghiep.post.hv')->middleware('check_role:supper_admin,quan_ly');
        Route::get('huongnghiep-hocvien-list/{id}', 'HuongNghiepController@listHocVien')->name('huongnghiep.hocvien.list')->middleware('check_role:supper_admin,quan_ly');

        /* Report */
        Route::resource('/report', 'ReportController')->middleware('check_role:supper_admin,quan_ly');
        Route::get('/report-list', 'ReportController@list')->name('report.list')->middleware('check_role:supper_admin,quan_ly');

         /* Báo Cáo */
        Route::resource('/baocao', 'BaoCaoController')->middleware('check_role:supper_admin,quan_ly');
        Route::post('/baocao/filter', 'BaoCaoController@filter')->name('baocao.filter')->middleware('check_role:supper_admin,quan_ly');
        Route::get('/baocao/excel/{month}', 'BaoCaoController@excel')->name('baocao.excel')->middleware('check_role:supper_admin,quan_ly');


    });
});

/* nguoibaoho route */

Route::domain(env('STUDENT_SUB_DOMAIN') . '.' . $host)->group(function () {
    Route::get('login', 'Auth\LoginController@index')->name('login.nguoibaoho');
    Route::post('login', 'Auth\LoginController@store')->name('store.nguoibaoho');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout.nguoibaoho');
    Route::get('change-password', 'Auth\ChangePasswordController@index')->name('changepassword.nguoibaoho');
    Route::post('change-password', 'Auth\ChangePasswordController@store')->name('changepassword.store.nguoibaoho');
    Route::group(['as' => 'nguoibaoho.', 'middleware' => 'auth.admin', 'namespace' => 'NguoiNha'], function () {
        Route::get('/', 'HocVienController@index')->name('home');
        Route::get('report', 'ReportController@index')->name('formReport');
        Route::post('report', 'ReportController@store')->name('submitReport');
        Route::get('diem-danh', 'HocVienController@diemDanh')->name('diem-danh');
        Route::get('suc-khoe', 'HocVienController@sucKhoe')->name('suc-khoe');
        Route::get('hoc-phi', 'HocVienController@hocPhi')->name('hoc-phi');
        Route::get('hoc-phi/filter/{id}', 'HocVienController@filterHocPhi')->name('hoc-phi.filter');
        Route::get('diem-so', 'HocVienController@diemSo')->name('diem-so');
        Route::post('filter-diem-danh', 'HocVienController@filterDiemDanh')->name('filter-diemdanh');
        Route::post('filter-diem-danh', 'HocVienController@filterDiemDanh')->name('filter-diemdanh');

        
        Route::post('filter-diem-so', 'HocVienController@filterDiemSo')->name('filter-diemso');
        Route::post('tinhtrangnghien', 'HocVienController@tinhTrangNghien')->name('tinhtrangnghien');
        Route::post('suckhoe/detail', 'HocVienController@sucKhoeDetail')->name('suckhoe.detail');
    });
});
