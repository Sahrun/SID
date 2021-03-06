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

use App\Http\Controllers\HomeController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/dashboard', 'HomeController@index');
    Route::get('/login', function () {
        return View::make('manage.auth.login');
    });

    // Wilayah
    Route::get('/kependudukan/wilayah', 'WilayahController@index');
    Route::get('/kependudukan/wilayah/add', 'WilayahController@create');
    Route::post('/kependudukan/wilayah/create', 'WilayahController@store');
    Route::get('/kependudukan/wilayah/edit/{id}', 'WilayahController@edit');
    Route::post('/kependudukan/wilayah/update/{id}', 'WilayahController@update');
    Route::get('/kependudukan/wilayah/view/{id}', 'WilayahController@show');
    Route::get('/kependudukan/wilayah/delete/{id}', 'WilayahController@destroy');
    Route::get('/kependudukan/wilayah/view-rw/{id}', 'WilayahController@show_rw');
    Route::get('/kependudukan/wilayah/add-rw/{id}', 'WilayahController@add_rw');
    Route::post('/kependudukan/wilayah/create-rw/{id}', 'WilayahController@create_rw');
    Route::get('/kependudukan/wilayah/edit-rw/{id}', 'WilayahController@edit_rw');
    Route::post('/kependudukan/wilayah/update-rw/{id}', 'WilayahController@update_rw');
    Route::get('/kependudukan/wilayah/add-rt/{id}', 'WilayahController@add_rt');
    Route::post('/kependudukan/wilayah/create-rt/{id}', 'WilayahController@create_rt');
    Route::get('/kependudukan/wilayah/edit-rt/{id}', 'WilayahController@edit_rt');
    Route::post('/kependudukan/wilayah/update-rt/{id}', 'WilayahController@update_rt');
    // End Wilayah

    // Keluarga
    Route::get('/kependudukan/keluarga', 'KeluargaController@index');
    Route::get('/kependudukan/keluarga/add', 'KeluargaController@create');
    Route::post('/kependudukan/keluarga/create', 'KeluargaController@store');
    Route::get('/kependudukan/keluarga/edit/{id}', 'KeluargaController@edit');
    Route::post('/kependudukan/keluarga/update/{id}', 'KeluargaController@update');
    Route::get('/kependudukan/keluarga/delete/{id}', 'KeluargaController@destroy');
    Route::get('/kependudukan/keluarga/view/{id}', 'KeluargaController@show');
    Route::get('/kependudukan/keluarga/delete-anggota/{id}', 'KeluargaController@destroy_anggota');
    Route::post('/kependudukan/keluarga/tambah-anggota/{id}', 'KeluargaController@store_keluarga');
    Route::get('/kependudukan/keluarga/edit-anggota/{id}', 'KeluargaController@edit_keluarga');
    Route::post('/kependudukan/keluarga/update-anggota/{id}', 'KeluargaController@update_keluarga');
    Route::get('/kependudukan/keluarga/get-data-keluarga/{id}', 'KeluargaController@get_data_keluarga');
    Route::get('/kependudukan/keluarga/validation-no-kk/{kk}/{id}', 'KeluargaController@validation_no_kk');
    // End Keluarga

    // Penduduk
    Route::get('/kependudukan/penduduk', 'PendudukController@index');
    Route::get('/kependudukan/penduduk/add', 'PendudukController@create');
    Route::post('/kependudukan/penduduk/create', 'PendudukController@store');
    Route::get('/kependudukan/penduduk/get_wilayah/{id}/{part}', 'PendudukController@get_wilayah');
    Route::get('/kependudukan/penduduk/edit/{id}', 'PendudukController@edit');
    Route::post('/kependudukan/penduduk/update/{id}', 'PendudukController@update');
    Route::get('/kependudukan/penduduk/delete/{id}', 'PendudukController@destroy');
    Route::get('/kependudukan/penduduk/view/{id}', 'PendudukController@show');
    Route::get('/kependudukan/penduduk/validation-nik/{nik}/{id}','PendudukController@validation_nik');
    Route::get('/kependudukan/penduduk/excel-penduduk', 'PendudukController@excel_penduduk');
    Route::get('/kependudukan/pemilih-tetap', 'PendudukController@pemilih_tetap');
    Route::get('/kependudukan/penduduk/pemilih-tetap-export', 'PendudukController@pemilih_tetap_export');
    // End Penduduk

    // Kelahiran
    Route::get('/kependudukan/kelahiran','KelahiranController@index');
    Route::get('/kependudukan/kelahiran/add','KelahiranController@create');
    Route::post('/kependudukan/kelahiran/create','KelahiranController@store');
    Route::get('/kependudukan/kelahiran/edit/{id}','KelahiranController@edit');
    Route::post('/kependudukan/kelahiran/update/{id}','KelahiranController@update');
    Route::get('/kependudukan/kelahiran/view/{id}','KelahiranController@show');
    Route::get('/kependudukan/kelahiran/delete/{id}','KelahiranController@destroy');
    // End Kelahiran

    // Pendatang
    Route::get('/kependudukan/pendatang','PendatangController@index');
    Route::get('/kependudukan/pendatang/add','PendatangController@create');
    Route::post('/kependudukan/pendatang/create','PendatangController@store');
    Route::get('/kependudukan/pendatang/edit/{id}','PendatangController@edit');
    Route::post('kependudukan/pendatang/update/{id}','PendatangController@update');
    Route::get('/kependudukan/pendatang/delete/{id}', 'PendatangController@destroy');
    Route::get('/kependudukan/pendatang/view/{id}', 'PendatangController@show');
    // End Pendatang

    // Penduduk Pindah
    Route::get('/kependudukan/penduduk-pindah','PendudukPindahController@index');
    Route::get('/kependudukan/penduduk-pindah/add','PendudukPindahController@create');
    Route::post('/kependudukan/penduduk-pindah/create','PendudukPindahController@store');
    Route::get('/kependudukan/penduduk-pindah/edit/{id}', 'PendudukPindahController@edit');
    Route::post('/kependudukan/penduduk-pindah/update/{id}', 'PendudukPindahController@update');
    Route::get('/kependudukan/penduduk-pindah/delete/{id}', 'PendudukPindahController@destroy');
    Route::get('kependudukan/penduduk-pindah/get-data-penduduk/{id}','PendudukPindahController@get_data_penduduk');
    // End Penduduk Pindah

    // Kematian
    Route::get('/kependudukan/kematian','KematianController@index');
    Route::get('/kependudukan/kematian/add','KematianController@create');
    Route::post('/kependudukan/kematian/create','KematianController@store');
    Route::get('/kependudukan/kematian/get-data-penduduk/{id}','KematianController@get_data_penduduk');
    Route::get('/kependudukan/kematian/edit/{id}','KematianController@edit');
    Route::post('kependudukan/kematian/update/{id}','KematianController@update');
    Route::get('/kependudukan/kematian/delete/{id}', 'KematianController@destroy');
    // End Kematian

    // Daftar Pemilih
    Route::get('/kependudukan/dpt/daftar-pemilih', 'DaftarpemilihController@index')->middleware('isUser');
    // End Daftar Pemilih

    // Identitas Desa
    Route::get('/pengaturan/identitas','IdentitasController@index')->middleware('isUser');
    Route::post('/pengaturan/identitas/update','IdentitasController@update')->middleware('isUser');
    // End Indetitas Desa

    // Staff
    Route::get('/staff','StaffController@index')->middleware('isUser');
    Route::get('/staff/add','StaffController@create')->middleware('isUser');
    Route::post('/staff/create','StaffController@store')->middleware('isUser');
    Route::get('/staff/edit/{id}', 'StaffController@edit')->middleware('isUser');
    Route::post('/staff/update/{id}', 'StaffController@update')->middleware('isUser');
    Route::get('/staff/delete/{id}', 'StaffController@destroy')->middleware('isUser');
    // End Staff
    
    // Surat
    Route::get('/surat/format-surat','SuratController@format_surat')->middleware('isUser');
    Route::post('/surat/upload', 'SuratController@upload')->middleware('isUser');
    Route::get('/surat/download/{file}','SuratController@download')->middleware('isUser');
    Route::post('/surat/cetak-surat-kematian/','SuratController@cetak_surat_kematian')->middleware('isUser');
    Route::get('/surat/daftar-cetak-surat','SuratController@daftar_cetak_surat')->middleware('isUser');
    Route::get('/surat/form-cetak-surat/{kode_surat}','SuratController@form_cetak_surat')->middleware('isUser');
    Route::post('/surat/cetak-surat-pengantar/','SuratController@cetak_surat_pengantar')->middleware('isUser');
    Route::post('/surat/cetak-surat-kelahiran/','SuratController@cetak_surat_kelahiran')->middleware('isUser');
    Route::post('/surat/cetak-surat-penduduk-pindah/','SuratController@cetak_surat_penduduk_pindah')->middleware('isUser');
    Route::post('/surat/cetak-surat-kurang-mampu/','SuratController@cetak_surat_kurang_mampu')->middleware('isUser');
    Route::get('surat/get-surat/{id}','SuratController@get_surat')->middleware('isUser');
    Route::get('/surat/salinan-kk/{id}','SuratController@salinan_kk')->middleware('isUser');
    Route::get('/surat/rekap-surat/','SuratController@rekap_surat')->middleware('isUser');
    Route::post('/surat/rekap-surat/','SuratController@rekap_surat')->middleware('isUser');
    Route::get('/surat/delete/{id}','SuratController@destroy')->middleware('isUser');
    // End Surat
    
    //region Laporan dan Export Excel
    Route::get('/lap/statistik', 'LaporanController@statistik');

    Route::get('/lap/lap-penduduk-pindah', 'LaporanController@penduduk_pindah');
    Route::get('/lap/lap-penduduk-pindah/{tgl_awal}/{tgl_akhir}', 'LaporanController@penduduk_pindah_filter');
    Route::get('/lap/excel-penduduk-pindah', 'LaporanController@excel_penduduk_pindah');
    Route::get('/lap/excel-penduduk-pindah/{tgl_awal}/{tgl_akhir}', 'LaporanController@excel_penduduk_pindah_filter');

    Route::get('/lap/lap-pendatang', 'LaporanController@pendatang');
    Route::get('/lap/lap-pendatang/{tgl_awal}/{tgl_akhir}', 'LaporanController@pendatang_filter');
    Route::get('/lap/excel-pendatang', 'LaporanController@excel_pendatang');
    Route::get('/lap/excel-pendatang/{tgl_awal}/{tgl_akhir}', 'LaporanController@excel_pendatang_filter');

    Route::get('/lap/lap-kelahiran', 'LaporanController@kelahiran');
    Route::get('/lap/lap-kelahiran/{tgl_awal}/{tgl_akhir}', 'LaporanController@kelahiran_filter');
    Route::get('/lap/excel-kelahiran', 'LaporanController@excel_kelahiran');
    Route::get('/lap/excel-kelahiran/{tgl_awal}/{tgl_akhir}', 'LaporanController@excel_kelahiran_filter');

    Route::get('/lap/lap-kematian', 'LaporanController@kematian');
    Route::get('/lap/lap-kematian/{tgl_awal}/{tgl_akhir}', 'LaporanController@kematian_filter');
    Route::get('/lap/excel-kematian', 'LaporanController@excel_kematian');
    Route::get('/lap/excel-kematian/{tgl_awal}/{tgl_akhir}', 'LaporanController@excel_kematian_filter');
    //endregion Laporan dan Export Excel

    // User
    Route::get('/user', 'UserController@index')->middleware('isUser');
    Route::get('/user/add','UserController@create')->middleware('isUser');
    Route::post('/user/create','UserController@store')->middleware('isUser');
    Route::get('/user/edit/{id}', 'UserController@edit')->middleware('isUser');
    Route::post('/user/update/{id}', 'UserController@update')->middleware('isUser');
    Route::get('/user/delete/{id}', 'UserController@destroy')->middleware('isUser');
    // End User
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
