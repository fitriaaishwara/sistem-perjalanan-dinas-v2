<?php

use App\Http\Controllers\Web\TiketController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('pages.dashboard.index');
// })->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('dashboard');

    //User
    Route::get('/user', [App\Http\Controllers\Web\UserController::class, 'index'])->name('user');
    Route::post('/user/getData', [App\Http\Controllers\Web\UserController::class, 'getData'])->name('user/getData');
    Route::get('/user/{id}/edit', [App\Http\Controllers\Web\UserController::class, 'show'])->name('user/show');
    Route::post('/user/store', [App\Http\Controllers\Web\UserController::class, 'store'])->name('user/store');
    Route::post('/user/update', [App\Http\Controllers\Web\UserController::class, 'update'])->name('user/update');
    Route::post('/user/password', [App\Http\Controllers\Web\UserController::class, 'changePassword'])->name('user/password');
    Route::post('/user/updateActive', [App\Http\Controllers\Web\UserController::class, 'updateActive'])->name('user/updateActive');
    Route::post('/user/delete/{id}', [App\Http\Controllers\Web\UserController::class, 'destroy'])->name('user/delete');
    Route::post('/user/{nip}/createUser', [App\Http\Controllers\Web\UserController::class, 'createUser'])->name('user.create');
    Route::post('user/status/{id}', [App\Http\Controllers\Web\UserController::class, 'status'])->name('user/status');

    Route::get('/assignRole', function () {
        $user = App\Models\User::find('828fc769-3f31-4e8a-9d72-f7a88acd1831');
        $user->assignRole('Super Admin');
        return 'success';
    });

    Route::get('/assignPermission', function () {
        $role = Role::find('1');
        // 1
        // 2
        // 3
        // 4
        // 5
        // 6
        // 7
        // 8
        // 9
        // 10
        // 11
        // 12
        // 13

        $permission = Permission::whereIn('id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14])->get();
        $role->syncPermissions($permission);
        return 'success';

    });

    //Role
    Route::get('/role', [App\Http\Controllers\Web\RoleController::class, 'index'])->name('role');
    Route::post('/role', [App\Http\Controllers\Web\RoleController::class, 'getData'])->name('role/getData');
    Route::get('/role/create', [App\Http\Controllers\Web\RoleController::class, 'create'])->name('role/create');
    Route::post('/role/store', [App\Http\Controllers\Web\RoleController::class, 'store'])->name('role/store');
    Route::get('/role/edit/{id}', [App\Http\Controllers\Web\RoleController::class, 'edit'])->name('role/edit');
    Route::post('/role/update/{id}', [App\Http\Controllers\Web\RoleController::class, 'update'])->name('role/update');
    Route::post('/role/delete/{id}', [App\Http\Controllers\Web\RoleController::class, 'destroy'])->name('role/delete');

    //Pegawai
    Route::get('/staff', [App\Http\Controllers\Web\StaffController::class, 'index'])->name('staff');
    Route::post('/staff/getData', [App\Http\Controllers\Web\StaffController::class, 'getData'])->name('staff/getData');
    Route::post('/staff/store', [App\Http\Controllers\Web\StaffController::class, 'store'])->name('staff/store');
    Route::post('/staff/update', [App\Http\Controllers\Web\StaffController::class, 'update'])->name('staff/update');
    Route::get('/staff/{nip}', [App\Http\Controllers\Web\StaffController::class, 'show'])->name('staff/show');
    Route::post('/staff/delete/{nip}', [App\Http\Controllers\Web\StaffController::class, 'destroy'])->name('staff/delete');

    //Data Perjalanan
    Route::get('/data-perjalanan', [App\Http\Controllers\Web\PerjalananController::class, 'index'])->name('dataPerjalanan');
    Route::post('/data-perjalanan/getData', [App\Http\Controllers\Web\PerjalananController::class, 'getData'])->name('dataPerjalanan/getData');
    Route::post('/data-perjalanan/getData/rekap', [App\Http\Controllers\Web\PerjalananController::class, 'getDataRekap'])->name('dataPerjalanan/getData/rekap');
    Route::get('/data-perjalanan/create', [App\Http\Controllers\Web\PerjalananController::class, 'create'])->name('dataPerjalanan/create');
    Route::post('/data-perjalanan/store', [App\Http\Controllers\Web\PerjalananController::class, 'store'])->name('dataPerjalanan/store');
    Route::get('/data-perjalanan/edit/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'edit'])->name('dataPerjalanan/edit');
    Route::post('/data-perjalanan/update/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'update'])->name('dataPerjalanan/update');
    Route::post('/data-perjalanan/delete/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'destroy'])->name('dataPerjalanan/delete');
    Route::get('/data-perjalanan/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'show'])->name('dataPerjalanan/show');
    Route::get('/perjalanan/detail/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'detail'])->name('perjalanan/detail');
    //Data Perjalanan
    Route::get('/rekap-data', [App\Http\Controllers\Web\RekapController::class, 'index'])->name('rekap-data');

    //Jabatan
    Route::get('/jabatan', [App\Http\Controllers\Web\JabatanController::class, 'index'])->name('jabatan');
    Route::post('/jabatan/getData', [App\Http\Controllers\Web\JabatanController::class, 'getData'])->name('jabatan/getData');
    Route::post('/jabatan/store', [App\Http\Controllers\Web\JabatanController::class, 'store'])->name('jabatan/store');
    Route::post('/jabatan/update', [App\Http\Controllers\Web\JabatanController::class, 'update'])->name('jabatan/update');
    Route::get('/jabatan/{id}', [App\Http\Controllers\Web\JabatanController::class, 'show'])->name('jabatan/show');
    Route::post('/jabatan/delete/{id}', [App\Http\Controllers\Web\JabatanController::class, 'destroy'])->name('jabatan/delete');

    //sbm
    Route::get('/uang_harian', [App\Http\Controllers\Web\UangHarianController::class, 'index'])->name('uang_harian');
    Route::post('/uang_harian/getData', [App\Http\Controllers\Web\UangHarianController::class, 'getData'])->name('uang_harian/getData');
    Route::post('/uang_harian/store', [App\Http\Controllers\Web\UangHarianController::class, 'store'])->name('uang_harian/store');
    Route::post('/uang_harian/update', [App\Http\Controllers\Web\UangHarianController::class, 'update'])->name('uang_harian/update');
    Route::get('/uang_harian/{id}', [App\Http\Controllers\Web\UangHarianController::class, 'show'])->name('uang_harian/show');
    Route::post('/uang_harian/delete/{id}', [App\Http\Controllers\Web\UangHarianController::class, 'destroy'])->name('uang_harian/delete');

    Route::get('/sbm-translok', [App\Http\Controllers\Web\TranslokController::class, 'index'])->name('sbm-translok');
    Route::post('/sbm-translok/getData', [App\Http\Controllers\Web\TranslokController::class, 'getData'])->name('sbm-translok/getData');
    Route::post('/sbm-translok/store', [App\Http\Controllers\Web\TranslokController::class, 'store'])->name('sbm-translok/store');
    Route::post('/sbm-translok/update', [App\Http\Controllers\Web\TranslokController::class, 'update'])->name('sbm-translok/update');
    Route::get('/sbm-translok/{id}', [App\Http\Controllers\Web\TranslokController::class, 'show'])->name('sbm-translok/show');
    Route::post('/sbm-translok/delete/{id}', [App\Http\Controllers\Web\TranslokController::class, 'destroy'])->name('sbm-translok/delete');

    Route::get('/sbm-tiket', [App\Http\Controllers\Web\TiketController::class, 'index'])->name('sbm-tiket');
    Route::post('/sbm-tiket/getData', [App\Http\Controllers\Web\TiketController::class, 'getData'])->name('sbm-tiket/getData');
    Route::post('/sbm-tiket/store', [App\Http\Controllers\Web\TiketController::class, 'store'])->name('sbm-tiket/store');
    Route::post('/sbm-tiket/update', [App\Http\Controllers\Web\TiketController::class, 'update'])->name('sbm-tiket/update');
    Route::get('/sbm-tiket/{id}', [App\Http\Controllers\Web\TiketController::class, 'show'])->name('sbm-tiket/show');
    Route::post('/sbm-tiket/delete/{id}', [App\Http\Controllers\Web\TiketController::class, 'destroy'])->name('sbm-tiket/delete');

    Route::get('/sbm-hotel', [App\Http\Controllers\Web\HotelController::class, 'index'])->name('sbm-hotel');
    Route::post('/sbm-hotel/getData', [App\Http\Controllers\Web\HotelController::class, 'getData'])->name('sbm-hotel/getData');
    Route::post('/sbm-hotel/store', [App\Http\Controllers\Web\HotelController::class, 'store'])->name('sbm-hotel/store');
    Route::post('sbm-hotel/update', [App\Http\Controllers\Web\HotelController::class, 'update'])->name('sbm-hotel/update');
    Route::get('/sbm-hotel/{id}', [App\Http\Controllers\Web\HotelController::class, 'show'])->name('sbm-hotel/show');
    Route::post('/sbm-hotel/delete/{id}', [App\Http\Controllers\Web\HotelController::class, 'destroy'])->name('sbm-hotel/delete');


    //Pengajuan
    Route::get('/pengajuan', [App\Http\Controllers\Web\PengajuanController::class, 'index'])->name('pengajuan');
    Route::any('/pengajuan/getData', [App\Http\Controllers\Web\PengajuanController::class, 'getData'])->name('pengajuan/getData');
    Route::any('/pengajuan/getDataAll/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'getDataAll'])->name('pengajuan/getDataAll');
    Route::get('/pengajuan/create', [App\Http\Controllers\Web\PengajuanController::class, 'create'])->name('pengajuan/create');
    Route::get('/pengajuan/create/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'createId'])->name('pengajuan/createId');
    Route::get('/pengajuan/stores', [App\Http\Controllers\Web\PengajuanController::class, 'stores'])->name('pengajuan/stores');
    Route::post('/pengajuan/store', [App\Http\Controllers\Web\PengajuanController::class, 'store'])->name('pengajuan/store');
    Route::get('/pengajuan/staff', [App\Http\Controllers\Web\PerjalananController::class, 'staff'])->name('pengajuan/staff');
    Route::get('/pengajuan/staff/{nip}/by_nip', [App\Http\Controllers\Web\PerjalananController::class, 'staff_by_nip'])->name('pengajuan/staff/by_nip');

    Route::get('/pengajuan/edit/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'edit'])->name('pengajuan/edit');
    Route::post('/pengajuan/update/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'update'])->name('update/edit');
    Route::post('/pengajuan/edit/{id}/save-staff', [App\Http\Controllers\Web\PengajuanController::class, 'save_staff'])->name('pengajuan/edit/save_staff');

    Route::post('/pengajuan/delete/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'destroy'])->name('pengajuan/delete');

    Route::post('/pengajuan/update/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'update'])->name('pengajuan/update');

    Route::post('/provinsi/getData', [App\Http\Controllers\Web\PerjalananController::class, 'getDataProvinsi'])->name('provinsi/getData');

    //Instansi
    Route::post('/instansi/getData', [App\Http\Controllers\Web\InstansiController::class, 'getData'])->name('instansi/getData');

    //Golongan
    Route::post('/golongan/getData', [App\Http\Controllers\Web\GolonganController::class, 'getData'])->name('golongan/getData');

    //statusPerjalanan
    Route::get('/status_perjalanan/show/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'show_status'])->name('statusPerjalanan/show');
    Route::post('/status_perjalanan/store', [App\Http\Controllers\Web\PengajuanController::class, 'store_status'])->name('statusPerjalanan/store');
    Route::post('/status_perjalanan/update', [App\Http\Controllers\Web\PengajuanController::class, 'update_status'])->name('statusPerjalanan/update');

    //detail-status
    Route::get('/detail-status/{id}', [App\Http\Controllers\Web\DetailStatusController::class, 'index'])->name('detail-status');
    Route::post('/detail-status/getData/{id_perjalanan}', [App\Http\Controllers\Web\DetailStatusController::class, 'getData'])->name('detail-status/getData');

    // Route::get('/tujuan', [App\Http\Controllers\Web\TujuanController::class, 'index'])->name('tujuan');
    Route::post('/tujuan/getData', [App\Http\Controllers\Web\TujuanController::class, 'getData'])->name('tujuan/getData');
    Route::any('/tujuanById/{id_perjalanan} ', [App\Http\Controllers\Web\TujuanController::class, 'getTujuanByIdPerjalanan'])->name('tujuanById/getData');
    Route::post('/tujuan/store', [App\Http\Controllers\Web\TujuanController::class, 'store'])->name('tujuan/store');
    Route::post('/tujuan/update', [App\Http\Controllers\Web\TujuanController::class, 'update'])->name('tujuan/update');
    Route::get('/tujuan/{id}', [App\Http\Controllers\Web\TujuanController::class, 'show'])->name('tujuan/show');
    Route::get('/showStaff/{id}', [App\Http\Controllers\Web\TujuanController::class, 'showStaff'])->name('tujuan/showStaff');
    Route::post('/tujuan/delete/{id}', [App\Http\Controllers\Web\TujuanController::class, 'destroy'])->name('tujuan/delete');

    Route::post('/kegiatan/getData', [App\Http\Controllers\Web\KegiatanController::class, 'getData'])->name('kegiatan/getData');
    Route::any('/kegiatanById/{id_perjalanan} ', [App\Http\Controllers\Web\KegiatanController::class, 'getKegiatanByIdPerjalanan'])->name('kegiatanById/getData');
    Route::post('/kegiatan/store', [App\Http\Controllers\Web\KegiatanController::class, 'store'])->name('kegiatan/store');
    Route::post('/kegiatan/update', [App\Http\Controllers\Web\KegiatanController::class, 'update'])->name('kegiatan/update');
    Route::get('/kegiatan/{id}', [App\Http\Controllers\Web\KegiatanController::class, 'show'])->name('kegiatan/show');
    // Route::get('/showStaff/{id}', [App\Http\Controllers\Web\TujuanController::class, 'showStaff'])->name('tujuan/showStaff');
    Route::post('/kegiatan/delete/{id}', [App\Http\Controllers\Web\KegiatanController::class, 'destroy'])->name('kegiatan/delete');

    Route::any('/staffById/getData/{id_perjalanan} ', [App\Http\Controllers\Web\TujuanController::class, 'getStaffByIdPerjalanan'])->name('staffById/getData');

    // Route::get('/tujuan', [App\Http\Controllers\Web\TujuanController::class, 'index'])->name('tujuan');
    Route::post('/DataStaffPerjalananDinas/getData', [App\Http\Controllers\Web\DataStaffPerjalananDinasController::class, 'getData'])->name('staffData/getData');
    Route::post('/DataStaffPerjalananDinas/store', [App\Http\Controllers\Web\DataStaffPerjalananDinasController::class, 'store'])->name('staffData/store');
    Route::post('/DataStaffPerjalananDinas/update', [App\Http\Controllers\Web\DataStaffPerjalananDinasController::class, 'update'])->name('staffData/update');
    Route::get('/DataStaffPerjalananDinas/{id}', [App\Http\Controllers\Web\DataStaffPerjalananDinasController::class, 'show'])->name('staffData/show');
    Route::post('/DataStaffPerjalananDinas/delete/{id}', [App\Http\Controllers\Web\DataStaffPerjalananDinasController::class, 'destroy'])->name('staffData/delete');


    //Jabatan
    Route::get('/mak', [App\Http\Controllers\Web\MakController::class, 'index'])->name('mak');
    Route::post('/mak/getData', [App\Http\Controllers\Web\MakController::class, 'getData'])->name('mak/getData');
    Route::post('/mak/store', [App\Http\Controllers\Web\MakController::class, 'store'])->name('mak/store');
    Route::post('/mak/update', [App\Http\Controllers\Web\MakController::class, 'update'])->name('mak/update');
    Route::get('/mak/{id}', [App\Http\Controllers\Web\MakController::class, 'show'])->name('mak/show');
    Route::post('/mak/delete/{id}', [App\Http\Controllers\Web\MakController::class, 'destroy'])->name('mak/delete');

    //Nota Dinas
    Route::get('/nota-dinas', [App\Http\Controllers\Web\NotaDinasController::class, 'index'])->name('nota-dinas');
    Route::any('/nota-dinas/getData', [App\Http\Controllers\Web\NotaDinasController::class, 'getData'])->name('nota-dinas/getData');
    Route::get('/nota-dinas/create/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'create'])->name('nota-dinas/create');
    Route::get('/nota-dinas/edit/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'edit'])->name('nota-dinas/edit');
    Route::any('/nota-dinas/store/', [App\Http\Controllers\Web\NotaDinasController::class, 'store'])->name('nota-dinas/store');
    Route::any('/nota-dinas/update/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'update'])->name('nota-dinas/update');
    Route::get('/nota-dinas/pdf/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'pdf'])->name('nota-dinas/pdf');
    Route::put('nota-dinas/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'updateStatus'])->name('nota-dinas.update');
    Route::get('/nota-dinas/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'detail'])->name('nota-dinas-detail');
    Route::post('/nota-dinas/upload', [App\Http\Controllers\Web\NotaDinasController::class, 'upload'])->name('nota-dinas.upload');
    Route::post('/nota-dinas/upload/edit', [App\Http\Controllers\Web\NotaDinasController::class, 'upload'])->name('nota-dinas.upload.edit');
    Route::get('/nota-dinas/show/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'showND'])->name('nota-dinas.show');
    Route::get('/nota-dinas/download/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'downloadFile'])->name('nota-dinas/download');

    //SPT
    Route::get('/surat-perintah-tugas', [App\Http\Controllers\Web\SptController::class, 'index'])->name('spt');
    Route::any('/surat-perintah-tugas/getData', [App\Http\Controllers\Web\SptController::class, 'getData'])->name('spt/getData');
    Route::get('/surat-perintah-tugas/create/{id}', [App\Http\Controllers\Web\SptController::class, 'create'])->name('spt/create');
    Route::any('/surat-perintah-tugas/store/', [App\Http\Controllers\Web\SptController::class, 'store'])->name('spt/store');
    Route::get('/surat-perintah-tugas/pdf/{id}', [App\Http\Controllers\Web\SptController::class, 'sptPDF'])->name('spt/pdf');
    Route::get('/surat-perintah-tugas/{id}', [App\Http\Controllers\Web\SptController::class, 'detail'])->name('spt-detail');
    Route::post('/surat-perintah-tugas/upload', [App\Http\Controllers\Web\SptController::class, 'upload'])->name('spt.upload');
    Route::post('/surat-perintah-tugas/upload/edit', [App\Http\Controllers\Web\SptController::class, 'upload'])->name('spt.upload.edit');
    Route::get('/surat-perintah-tugas/show/{id}', [App\Http\Controllers\Web\SptController::class, 'showSpt'])->name('spt.show');
    Route::get('/surat-perintah-tugas/download/{id}', [App\Http\Controllers\Web\SptController::class, 'downloadFile'])->name('spt/download');

    //SPD
    Route::get('/surat-perjalanan-dinas', [App\Http\Controllers\Web\SpdController::class, 'index'])->name('spd');
    Route::post('/surat-perjalanan-dinas/getData', [App\Http\Controllers\Web\SpdController::class, 'getData'])->name('spd/getData');
    Route::get('/surat-perjalanan-dinas/create/{id}', [App\Http\Controllers\Web\SpdController::class, 'create'])->name('spd/create');
    Route::any('/surat-perjalanan-dinas/store/', [App\Http\Controllers\Web\SpdController::class, 'store'])->name('spd/store');
    Route::get('/surat-perjalanan-dinas/pdf/{id}', [App\Http\Controllers\Web\SpdController::class, 'spdPDF'])->name('spd/pdf');
    Route::get('/surat-perjalanan-dinas/pdf2/{id}', [App\Http\Controllers\Web\SpdController::class, 'spdPDF2'])->name('spd/pdf2');
    Route::get('/surat-perjalanan-dinas/{id}', [App\Http\Controllers\Web\SpdController::class, 'detail'])->name('spd-detail');
    Route::post('/surat-perjalanan-dinas/upload', [App\Http\Controllers\Web\SpdController::class, 'upload'])->name('spd.upload');
    Route::post('/surat-perjalanan-dinas/upload/edit', [App\Http\Controllers\Web\SpdController::class, 'upload'])->name('spd.upload.edit');
    Route::get('/surat-perjalanan-dinas/show/{id}', [App\Http\Controllers\Web\SpdController::class, 'showSpt'])->name('spd.show');
    Route::get('/surat-perjalanan-dinas/download/{id}', [App\Http\Controllers\Web\SpdController::class, 'downloadFile'])->name('spd/download');

    Route::get('/bukti-perjalanan', [App\Http\Controllers\Web\UploadBuktiController::class, 'index'])->name('bukti');
    Route::any('/bukti-perjalananBerangkatById/getData/{id_staff_perjalanan} ', [App\Http\Controllers\Web\UploadBuktiController::class, 'getUploadByIdBerangkat'])->name('uploadByIdBerangkat/getData');
    Route::any('/bukti-perjalananPulangById/getData/{id_staff_perjalanan} ', [App\Http\Controllers\Web\UploadBuktiController::class, 'getUploadByIdPulang'])->name('uploadByIdPulang/getData');
    Route::any('/bukti-perjalananHotelById/getData/{id_staff_perjalanan} ', [App\Http\Controllers\Web\UploadBuktiController::class, 'getUploadByIdHotel'])->name('uploadByIdHotel/getData');
    Route::post('/bukti-perjalanan/getData', [App\Http\Controllers\Web\UploadBuktiController::class, 'getData'])->name('bukti/getData');
    Route::get('/bukti-perjalanan/create/{id}', [App\Http\Controllers\Web\UploadBuktiController::class, 'create'])->name('bukti/create');
    Route::any('/bukti-perjalanan/store/', [App\Http\Controllers\Web\UploadBuktiController::class, 'store'])->name('bukti/store');
    Route::get('/bukti-perjalanan/pdf/{id}', [App\Http\Controllers\Web\UploadBuktiController::class, 'sptPDF'])->name('bukti/pdf');

    //Kwitansi
    Route::get('/kwitansi', [App\Http\Controllers\Web\KwitansiController::class, 'index'])->name('kwitansi');
    Route::post('/kwitansi/getData', [App\Http\Controllers\Web\KwitansiController::class, 'getData'])->name('kwitansi/getData');
    Route::get('/kwitansi/create/{id}', [App\Http\Controllers\Web\KwitansiController::class, 'create'])->name('kwitansi/create');
    Route::any('/kwitansi/store/', [App\Http\Controllers\Web\KwitansiController::class, 'store'])->name('kwitansi/store');
    Route::get('/kwitansi/pdf/{id}', [App\Http\Controllers\Web\KwitansiController::class, 'kwitansiPDF'])->name('kwitansi/pdf');
    Route::get('/kwitansi/pdf2/{id}', [App\Http\Controllers\Web\KwitansiController::class, 'kwitansiPDF2'])->name('kwitansi/pdf2');
    Route::get('/kwitansi/pdf3/{id}', [App\Http\Controllers\Web\KwitansiController::class, 'kwitansiPDF3'])->name('kwitansi/pdf3');
    Route::get('/kwitansi/{id}', [App\Http\Controllers\Web\KwitansiController::class, 'detail'])->name('kwitansi-detail');
    Route::post('/kwitansi/upload', [App\Http\Controllers\Web\KwitansiController::class, 'upload'])->name('kwitansi.upload');
    Route::post('/kwitansi/upload/edit', [App\Http\Controllers\Web\KwitansiController::class, 'upload'])->name('kwitansi.upload.edit');
    Route::get('/kwitansi/show/{id}', [App\Http\Controllers\Web\KwitansiController::class, 'showKwitansi'])->name('kwitansi.show');
    Route::get('/kwitansi/download/{id}', [App\Http\Controllers\Web\KwitansiController::class, 'downloadFile'])->name('kwitansi/download');
    //Transportasi
    Route::post('/transportasi/getData', [App\Http\Controllers\Web\TransportasiController::class, 'getData'])->name('transportasi/getData');
    Route::get('/transportasi', [App\Http\Controllers\Web\TransportasiController::class, 'index'])->name('transportasi');
    Route::post('/transportasi/update', [App\Http\Controllers\Web\TransportasiController::class, 'update'])->name('transportasi/update');
    Route::post('/transportasi/store', [App\Http\Controllers\Web\TransportasiController::class, 'store'])->name('transportasi/store');
    Route::post('/transportasi/delete/{id}', [App\Http\Controllers\Web\TransportasiController::class, 'destroy'])->name('transportasi/delete');
    Route::get('/transportasi/{id}', [App\Http\Controllers\Web\TransportasiController::class, 'show'])->name('transportasi/show');

    //Transportasi Berangkat
    Route::post('/transportasiBerangkat/getData', [App\Http\Controllers\Web\TransportasiBerangkatController::class, 'getData'])->name('transportasiBerangkat/getData');
    Route::get('/transportasiBerangkat', [App\Http\Controllers\Web\TransportasiBerangkatController::class, 'index'])->name('transportasiBerangkat');
    Route::post('/transportasiBerangkat/update', [App\Http\Controllers\Web\TransportasiBerangkatController::class, 'update'])->name('transportasiBerangkat/update');
    Route::post('/transportasiBerangkat/store', [App\Http\Controllers\Web\TransportasiBerangkatController::class, 'store'])->name('transportasiBerangkat/store');
    Route::post('/transportasiBerangkat/delete/{id}', [App\Http\Controllers\Web\TransportasiBerangkatController::class, 'destroy'])->name('transportasiBerangkat/delete');
    Route::get('/transportasiBerangkat/{id}', [App\Http\Controllers\Web\TransportasiBerangkatController::class, 'show'])->name('transportasiBerangkat/show');

    //Transportasi Berangkat
    Route::post('/transportasiPulang/getData', [App\Http\Controllers\Web\TransportasiPulangController::class, 'getData'])->name('transportasiPulang/getData');
    Route::get('/transportasiPulang', [App\Http\Controllers\Web\TransportasiPulangController::class, 'index'])->name('transportasiPulang');
    Route::post('/transportasiPulang/update', [App\Http\Controllers\Web\TransportasiPulangController::class, 'update'])->name('transportasiPulang/update');
    Route::post('/transportasiPulang/store', [App\Http\Controllers\Web\TransportasiPulangController::class, 'store'])->name('transportasiPulang/store');
    Route::post('/transportasiPulang/delete/{id}', [App\Http\Controllers\Web\TransportasiPulangController::class, 'destroy'])->name('transportasiPulang/delete');
    Route::get('/transportasiPulang/{id}', [App\Http\Controllers\Web\TransportasiPulangController::class, 'show'])->name('transportasiPulang/show');

    //Hotel
    Route::post('/hotel/getData', [App\Http\Controllers\Web\AkomodasiHotelController::class, 'getData'])->name('hotel/getData');
    Route::get('/hotel', [App\Http\Controllers\Web\AkomodasiHotelController::class, 'index'])->name('hotel');
    Route::post('/hotel/update', [App\Http\Controllers\Web\AkomodasiHotelController::class, 'update'])->name('hotel/update');
    Route::post('/hotel/store', [App\Http\Controllers\Web\AkomodasiHotelController::class, 'store'])->name('hotel/store');
    Route::post('/hotel/delete/{id}', [App\Http\Controllers\Web\AkomodasiHotelController::class, 'destroy'])->name('hotel/delete');
    Route::get('/hotel/{id}', [App\Http\Controllers\Web\AkomodasiHotelController::class, 'show'])->name('hotel/show');

    Route::get('/hotel/pdf/{id}', [App\Http\Controllers\Web\AkomodasiHotelController::class, 'downloadFile'])->name('hotel/pdf');

    Route::get('/transportasiBerangkat/pdf/{id}', [App\Http\Controllers\Web\TransportasiBerangkatController::class, 'downloadFile'])->name('transportasi-berangkat/pdf');

    Route::get('/transportasiPulang/pdf/{id}', [App\Http\Controllers\Web\TransportasiPulangController::class, 'downloadFile'])->name('transportasi-pulang/pdf');

    //Laporan
    Route::get('/laporan', [App\Http\Controllers\Web\UploadLaporanController::class, 'index'])->name('laporan');
    Route::post('/laporan/getData', [App\Http\Controllers\Web\UploadLaporanController::class, 'getData'])->name('laporan/getData');
    // Route::get('/laporan/create/{id}', [App\Http\Controllers\Web\UploadLaporanController::class, 'create'])->name('laporan/create');
    Route::post('/laporan/store', [App\Http\Controllers\Web\UploadLaporanController::class, 'store'])->name('laporan/store');
    Route::get('/laporan/pdf/{id}', [App\Http\Controllers\Web\UploadLaporanController::class, 'downloadFile'])->name('laporan/pdf');
    Route::post('/laporan/update', [App\Http\Controllers\Web\UploadLaporanController::class, 'update'])->name('laporan/update');
    Route::get('/laporan/{id}', [App\Http\Controllers\Web\UploadLaporanController::class, 'show'])->name('laporan/show');
    Route::get('/laporan/show/{id}', [App\Http\Controllers\Web\UploadLaporanController::class, 'showing'])->name('laporan/showing');

    Route::get('/laporan/pdf/{id}', [App\Http\Controllers\Web\UploadLaporanController::class, 'downloadFile'])->name('laporan/pdf');

    //Gallery
    Route::get('/gallery', [App\Http\Controllers\Web\UploadGalleryController::class, 'index'])->name('gallery');
    Route::post('/gallery/getData', [App\Http\Controllers\Web\UploadGalleryController::class, 'getData'])->name('gallery/getData');
    Route::get('/gallery/create/{id}', [App\Http\Controllers\Web\UploadGalleryController::class, 'create'])->name('gallery/create');

    Route::post('/gallery/store', [App\Http\Controllers\Web\UploadGalleryController::class, 'store'])->name('gallery/store');
    Route::get('/gallery/pdf/{id}', [App\Http\Controllers\Web\UploadGalleryController::class, 'downloadFile'])->name('gallery/pdf');
    Route::post('/gallery/update', [App\Http\Controllers\Web\UploadGalleryController::class, 'update'])->name('gallery/update');
    Route::get('/gallery/{id}', [App\Http\Controllers\Web\UploadGalleryController::class, 'show'])->name('gallery/show');
    Route::any('/gallery/delete/{id}', [App\Http\Controllers\Web\UploadGalleryController::class, 'destroy'])->name('gallery/delete');

    Route::get('/gallery/pdf/{id}', [App\Http\Controllers\Web\UploadLaporanController::class, 'downloadFile'])->name('gallery/pdf');

    //Geo Tagging
    Route::get('/geo-tagging', [App\Http\Controllers\Web\GeoTaggingController::class, 'index'])->name('geo-tagging');
    Route::post('/geo-tagging/getData', [App\Http\Controllers\Web\GeoTaggingController::class, 'getData'])->name('geo-tagging/getData');
    Route::get('/geo-tagging/{id}', [App\Http\Controllers\Web\GeoTaggingController::class, 'create'])->name('geo-tagging/create');
    // Route::any('/geo-tagging/store/', [App\Http\Controllers\Web\GeoTaggingController::class, 'store'])->name('geo-tagging/store');
    Route::get('/geo-tagging/pdf/{id}', [App\Http\Controllers\Web\GeoTaggingController::class, 'kwitansiPDF'])->name('geo-tagging/pdf');
    Route::post('webcam', [App\Http\Controllers\Web\GeoTaggingController::class, 'store'])->name('webcam.capture');
    Route::get('/geo-tagging/view/{id}', [App\Http\Controllers\Web\GeoTaggingController::class, 'show'])->name('geo-tagging/show');

    //kkp
    Route::get('/kkp', [App\Http\Controllers\Web\KkpController::class, 'index'])->name('kkp');
    Route::post('/kkp/getData', [App\Http\Controllers\Web\KkpController::class, 'getData'])->name('kkp/getData');
    Route::get('/kkp/{id}', [App\Http\Controllers\Web\KkpController::class, 'create'])->name('kkp/create');
    Route::get('/kkp/pdf/{id}', [App\Http\Controllers\Web\KkpController::class, 'kkpPDF'])->name('kkp/pdf');
    Route::get('/kkp-detail/{id}', [App\Http\Controllers\Web\KkpController::class, 'detail'])->name('kkp-detail');
    Route::post('/kkp-detail/getData/{id}', [App\Http\Controllers\Web\KkpController::class, 'getData'])->name('kkp-detail/getData');

    //profile
    Route::get('/profile/{id}', [App\Http\Controllers\Web\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update/{id}', [App\Http\Controllers\Web\ProfileController::class, 'update'])->name('profile/update');

    Route::get('/exportSpd/{id}', [App\Http\Controllers\Web\ExportController::class, 'exportToExcelSpd'])->name('exportSpd');
    Route::get('/exportSpt/{id}', [App\Http\Controllers\Web\ExportController::class, 'exportToExcelSpt'])->name('exportSpt');
    Route::get('/exportKwitansi1/{id}', [App\Http\Controllers\Web\ExportController::class, 'exportToExcelKwitansi1'])->name('exportKwitansi1');
    Route::get('/exportKwitansi2/{id}', [App\Http\Controllers\Web\ExportController::class, 'exportToExcelKwitansi2'])->name('exportKwitansi2');

    Route::post('/status_perjalanan/getData', [App\Http\Controllers\Web\StatusPerjalananController::class, 'getData'])->name('status_perjalanan/getData');

    Route::get('sbm-translok/import', [App\Http\Controllers\Web\TranslokController::class, 'showImportForm'])->name('sbm-translok.import');
    Route::post('sbm-translok/import', [App\Http\Controllers\Web\TranslokController::class, 'import'])->name('sbm-translok.import.post');
    Route::get('sbm-translok/getData', [App\Http\Controllers\Web\TranslokController::class, 'getData'])->name('sbm-translok.getData');
    Route::get('sbm-translok/show/{id}', [App\Http\Controllers\Web\TranslokController::class, 'show'])->name('sbm-translok.show');
    Route::get('sbm-translok/download-template', [App\Http\Controllers\Web\TranslokController::class, 'downloadTemplate'])->name('sbm-translok.downloadTemplate');

    Route::post('sbm-tiket/import', [TiketController::class, 'import'])->name('sbm-tiket/import');

});

require __DIR__.'/auth.php';
