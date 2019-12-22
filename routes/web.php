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

Route::get('/', function () {
   return View::make('pages.home.home');
});
Route::get('/dasbhoard', function () {
    return View::make('pages.home.home');
 });
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
// End Keluarga

// Penduduk
Route::get('/kependudukan/penduduk','PendudukController@index');
Route::get('/kependudukan/penduduk/add','PendudukController@create');
Route::post('/kependudukan/penduduk/create','PendudukController@store');
Route::get('/kependudukan/penduduk/get_wilayah/{id}/{part}','PendudukController@get_wilayah');
Route::get('/kependudukan/penduduk/edit/{id}','PendudukController@edit');
Route::post('/kependudukan/penduduk/update/{id}', 'PendudukController@update');
Route::get('/kependudukan/penduduk/delete/{id}', 'PendudukController@destroy');
Route::get('/kependudukan/penduduk/view/{id}', 'PendudukController@show');
// End Penduduk

// Kelahiran
Route::get('/kependudukan/kelahiran','KelahiranController@index');
Route::get('/kependudukan/kelahiran/add','KelahiranController@create');
Route::post('/kependudukan/kelahiran/create','KelahiranController@store');
Route::get('/kependudukan/kelahiran/view/{id}','KelahiranController@show');
// End Kelahiran

// Kematian
Route::get('/kependudukan/kematian','KematianController@index');
Route::get('/kependudukan/kematian/add','KematianController@create');
Route::post('/kependudukan/kematian/create','KematianController@store');
Route::get('kependudukan/kematian/get-data-penduduk/{id}','KematianController@get_data_penduduk');
Route::get('kependudukan/kematian/edit/{id}','KematianController@edit');
Route::post('kependudukan/kematian/update/{id}','KematianController@update');
Route::get('/kependudukan/kematian/delete/{id}', 'KematianController@destroy');
// End Kematian

// Pendatang
Route::get('/kependudukan/pendatang','PendatangController@index');
Route::get('/kependudukan/pendatang/add','PendatangController@create');
Route::post('/kependudukan/pendatang/create','PendatangController@store');
Route::get('kependudukan/pendatang/edit/{id}','PendatangController@edit');
Route::post('kependudukan/pendatang/update/{id}','PendatangController@update');
Route::get('/kependudukan/pendatang/delete/{id}', 'PendatangController@destroy');
Route::get('/kependudukan/pendatang/view/{id}', 'PendatangController@show');
// End Pendatang

// Identitas Desa
Route::get('/pengaturan/identitas','IdentitasController@index');
Route::post('/pengaturan/identitas/update','IdentitasController@update');
// End Indetitas Desa

// Staff
Route::get('/staff','StaffController@index');
Route::get('/staff/add','StaffController@create');
Route::post('/staff/create','StaffController@store');
Route::get('/staff/edit/{id}', 'StaffController@edit');
Route::post('/staff/update/{id}', 'StaffController@update');
Route::get('/staff/delete/{id}', 'StaffController@destroy');
// End Staff