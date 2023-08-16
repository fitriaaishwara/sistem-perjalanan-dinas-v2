<?php

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
    Route::any('/user/{id}/createUser', [App\Http\Controllers\Web\UserController::class, 'createUser'])->name('user/buttonCreateUser');
    Route::post('user/status/{id}', [App\Http\Controllers\Web\UserController::class, 'status'])->name('user/status');

    Route::get('/assignRole', function () {
        $user = App\Models\User::find('9088519b-815f-4034-9800-bc040d8985ed');
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
    Route::post('/role/create', [App\Http\Controllers\Web\RoleController::class, 'store'])->name('role/create');
    Route::get('/role/edit/{id}', [App\Http\Controllers\Web\RoleController::class, 'edit'])->name('role/edit');
    Route::post('/role/edit/{id}', [App\Http\Controllers\Web\RoleController::class, 'update'])->name('role/edit');
    Route::post('/role/delete/{id}', [App\Http\Controllers\Web\RoleController::class, 'destroy'])->name('role/delete');

    //Pegawai
    Route::get('/staff', [App\Http\Controllers\Web\StaffController::class, 'index'])->name('staff');
    Route::post('/staff/getData', [App\Http\Controllers\Web\StaffController::class, 'getData'])->name('staff/getData');
    Route::post('/staff/store', [App\Http\Controllers\Web\StaffController::class, 'store'])->name('staff/store');
    Route::post('/staff/update', [App\Http\Controllers\Web\StaffController::class, 'update'])->name('staff/update');
    Route::get('/staff/{id}', [App\Http\Controllers\Web\StaffController::class, 'show'])->name('staff/show');
    Route::post('/staff/delete/{id}', [App\Http\Controllers\Web\StaffController::class, 'destroy'])->name('staff/delete');

    //Data Perjalanan
    Route::get('/data-perjalanan', [App\Http\Controllers\Web\PerjalananController::class, 'index'])->name('dataPerjalanan');
    Route::post('/data-perjalanan/getData', [App\Http\Controllers\Web\PerjalananController::class, 'getData'])->name('dataPerjalanan/getData');
    Route::get('/data-perjalanan/create', [App\Http\Controllers\Web\PerjalananController::class, 'create'])->name('dataPerjalanan/create');
    Route::post('/data-perjalanan/store', [App\Http\Controllers\Web\PerjalananController::class, 'store'])->name('dataPerjalanan/store');
    Route::get('/data-perjalanan/edit/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'edit'])->name('dataPerjalanan/edit');
    Route::post('/data-perjalanan/edit/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'update'])->name('dataPerjalanan/edit');
    Route::post('/data-perjalanan/delete/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'destroy'])->name('dataPerjalanan/delete');
    Route::get('/data-perjalanan/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'show'])->name('dataPerjalanan/show');

    //Jabatan
    Route::get('/jabatan', [App\Http\Controllers\Web\JabatanController::class, 'index'])->name('jabatan');
    Route::post('/jabatan/getData', [App\Http\Controllers\Web\JabatanController::class, 'getData'])->name('jabatan/getData');
    Route::post('/jabatan/store', [App\Http\Controllers\Web\JabatanController::class, 'store'])->name('jabatan/store');
    Route::post('/jabatan/update', [App\Http\Controllers\Web\JabatanController::class, 'update'])->name('jabatan/update');
    Route::get('/jabatan/{id}', [App\Http\Controllers\Web\JabatanController::class, 'show'])->name('jabatan/show');
    Route::post('/jabatan/delete/{id}', [App\Http\Controllers\Web\JabatanController::class, 'destroy'])->name('jabatan/delete');


    //Pengajuan
    Route::get('/pengajuan', [App\Http\Controllers\Web\PengajuanController::class, 'index'])->name('pengajuan');
    Route::post('/pengajuan/getData', [App\Http\Controllers\Web\PengajuanController::class, 'getData'])->name('pengajuan/getData');
    Route::get('/pengajuan/create', [App\Http\Controllers\Web\PengajuanController::class, 'create'])->name('pengajuan/create');
    Route::get('/pengajuan/create/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'createId'])->name('pengajuan/createId');
    Route::get('/pengajuan/stores', [App\Http\Controllers\Web\PengajuanController::class, 'stores'])->name('pengajuan/stores');
    Route::post('/pengajuan/store', [App\Http\Controllers\Web\PengajuanController::class, 'store'])->name('pengajuan/store');
    Route::get('/pengajuan/staff', [App\Http\Controllers\Web\PerjalananController::class, 'staff'])->name('pengajuan/staff');
    Route::get('/pengajuan/staff/{id}/by_id', [App\Http\Controllers\Web\PerjalananController::class, 'staff_by_id'])->name('pengajuan/staff/by_id');

    Route::get('/pengajuan/edit/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'edit'])->name('pengajuan/edit');
    Route::post('/pengajuan/edit/{id}', [App\Http\Controllers\Web\PengajuanController::class, 'update'])->name('pengajuan/edit');

    //Instansi
    Route::post('/instansi/getData', [App\Http\Controllers\Web\InstansiController::class, 'getData'])->name('instansi/getData');

    //Golongan
    Route::post('/golongan/getData', [App\Http\Controllers\Web\GolonganController::class, 'getData'])->name('golongan/getData');

    //statusPerjalanan
    Route::get('/statusPerjalanan/{id}', [App\Http\Controllers\Web\PerjalananController::class, 'show_status'])->name('statusPerjalanan/show');
    Route::post('/statusPerjalanan/update', [App\Http\Controllers\Web\PerjalananController::class, 'update_status'])->name('statusPerjalanan/update');

    // Route::get('/tujuan', [App\Http\Controllers\Web\TujuanController::class, 'index'])->name('tujuan');
    Route::post('/tujuan/getData', [App\Http\Controllers\Web\TujuanController::class, 'getData'])->name('tujuan/getData');
    Route::post('/tujuanById/getData/{id_perjalanan} ', [App\Http\Controllers\Web\TujuanController::class, 'getTujuanByIdPerjalanan'])->name('tujuanById/getData');
    Route::post('/tujuan/store', [App\Http\Controllers\Web\TujuanController::class, 'store'])->name('tujuan/store');
    Route::post('/tujuan/update', [App\Http\Controllers\Web\TujuanController::class, 'update'])->name('tujuan/update');
    Route::get('/tujuan/{id}', [App\Http\Controllers\Web\TujuanController::class, 'show'])->name('tujuan/show');
    Route::post('/tujuan/delete/{id}', [App\Http\Controllers\Web\TujuanController::class, 'destroy'])->name('tujuan/delete');

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
    Route::post('/nota-dinas/getData', [App\Http\Controllers\Web\NotaDinasController::class, 'getData'])->name('nota-dinas/getData');
    Route::get('/nota-dinas/create/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'create'])->name('nota-dinas/create');
    Route::any('/nota-dinas/store/', [App\Http\Controllers\Web\NotaDinasController::class, 'store'])->name('nota-dinas/store');
    Route::get('/nota-dinas/pdf/{id}', [App\Http\Controllers\Web\NotaDinasController::class, 'notaDinasPDF'])->name('nota-dinas/pdf');

    //SPT
    Route::get('/surat-perintah-tugas', [App\Http\Controllers\Web\SptController::class, 'index'])->name('spt');
    Route::post('/surat-perintah-tugas/getData', [App\Http\Controllers\Web\SptController::class, 'getData'])->name('spt/getData');
    Route::get('/surat-perintah-tugas/create/{id}', [App\Http\Controllers\Web\SptController::class, 'create'])->name('spt/create');
    Route::any('/surat-perintah-tugas/store/', [App\Http\Controllers\Web\SptController::class, 'store'])->name('spt/store');
    Route::get('/surat-perintah-tugas/pdf/{id}', [App\Http\Controllers\Web\SptController::class, 'sptPDF'])->name('spt/pdf');

    //SPD
    Route::get('/surat-perjalanan-dinas', [App\Http\Controllers\Web\SpdController::class, 'index'])->name('spd');
    Route::post('/surat-perjalanan-dinas/getData', [App\Http\Controllers\Web\SpdController::class, 'getData'])->name('spd/getData');
    Route::get('/surat-perjalanan-dinas/create/{id}', [App\Http\Controllers\Web\SpdController::class, 'create'])->name('spd/create');
    Route::any('/surat-perjalanan-dinas/store/', [App\Http\Controllers\Web\SpdController::class, 'store'])->name('spd/store');
    Route::get('/surat-perjalanan-dinas/pdf/{id}', [App\Http\Controllers\Web\SpdController::class, 'sptPDF'])->name('spd/pdf');

    //SPD
    Route::get('/bukti-perjalanan', [App\Http\Controllers\Web\SpdController::class, 'index'])->name('bukti');
    Route::post('/bukti-perjalanan/getData', [App\Http\Controllers\Web\SpdController::class, 'getData'])->name('bukti/getData');
    Route::get('/bukti-perjalanan/create/{id}', [App\Http\Controllers\Web\SpdController::class, 'create'])->name('bukti/create');
    Route::any('/bukti-perjalanan/store/', [App\Http\Controllers\Web\SpdController::class, 'store'])->name('bukti/store');
    Route::get('/bukti-perjalanan/pdf/{id}', [App\Http\Controllers\Web\SpdController::class, 'sptPDF'])->name('bukti/pdf');

    //Kwitansi
    Route::get('/kwitansi', [App\Http\Controllers\Web\SpdController::class, 'index'])->name('kwitansi');
    Route::post('/kwitansi/getData', [App\Http\Controllers\Web\SpdController::class, 'getData'])->name('kwitansi/getData');
    Route::get('/kwitansi/create/{id}', [App\Http\Controllers\Web\SpdController::class, 'create'])->name('kwitansi/create');
    Route::any('/kwitansi/store/', [App\Http\Controllers\Web\SpdController::class, 'store'])->name('kwitansi/store');
    Route::get('/kwitansi/pdf/{id}', [App\Http\Controllers\Web\SpdController::class, 'sptPDF'])->name('kwitansi/pdf');
});

require __DIR__.'/auth.php';
