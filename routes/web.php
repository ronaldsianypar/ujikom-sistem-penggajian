<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes(['register' => false, 'reset' => false]);

Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['admin']], function () {

    Route::get('/admin', '\App\Http\Controllers\AdminController@index')->name('admin');

    Route::prefix('perusahaan')->group(function () {
        Route::get('/', '\App\Http\Controllers\PerusahaanController@index')->name('admin.perusahaan.index');
        Route::get('/create', '\App\Http\Controllers\PerusahaanController@create')->name('admin.perusahaan.create');
        Route::post('/store', '\App\Http\Controllers\PerusahaanController@store')->name('admin.perusahaan.store');
        Route::get('/edit/{id}', '\App\Http\Controllers\PerusahaanController@edit')->name('admin.perusahaan.edit');
        Route::put('/update/{id}', '\App\Http\Controllers\PerusahaanController@update')->name('admin.perusahaan.update');
        Route::get('/detail/{id}', '\App\Http\Controllers\PerusahaanController@show')->name('admin.perusahaan.show');
        Route::get('/destroy/{id}', '\App\Http\Controllers\PerusahaanController@destroy')->name('admin.perusahaan.destroy');
    });
    
    Route::prefix('karyawan')->group(function () {
        Route::get('/', '\App\Http\Controllers\KaryawanController@index')->name('admin.karyawan.index');
        Route::get('/create', '\App\Http\Controllers\KaryawanController@create')->name('admin.karyawan.create');
        Route::post('/store', '\App\Http\Controllers\KaryawanController@store')->name('admin.karyawan.store');
        Route::get('/edit/{id}', '\App\Http\Controllers\KaryawanController@edit')->name('admin.karyawan.edit');
        Route::put('/update/{id}', '\App\Http\Controllers\KaryawanController@update')->name('admin.karyawan.update');
        Route::get('/detail/{id}', '\App\Http\Controllers\KaryawanController@show')->name('admin.karyawan.show');
        Route::get('/destroy/{id}', '\App\Http\Controllers\KaryawanController@destroy')->name('admin.karyawan.destroy');
    });

    Route::prefix('keterangan_gaji')->group(function () {
        Route::get('/', '\App\Http\Controllers\KeteranganGajiController@index')->name('admin.keterangan_gaji.index');
        Route::get('/create', '\App\Http\Controllers\KeteranganGajiController@create')->name('admin.keterangan_gaji.create');
        Route::post('/store', '\App\Http\Controllers\KeteranganGajiController@store')->name('admin.keterangan_gaji.store');
        Route::get('/edit/{id}', '\App\Http\Controllers\KeteranganGajiController@edit')->name('admin.keterangan_gaji.edit');
        Route::put('/update/{id}', '\App\Http\Controllers\KeteranganGajiController@update')->name('admin.keterangan_gaji.update');
        Route::get('/detail/{id}', '\App\Http\Controllers\KeteranganGajiController@show')->name('admin.keterangan_gaji.show');
        Route::get('/destroy/{id}', '\App\Http\Controllers\KeteranganGajiController@destroy')->name('admin.keterangan_gaji.destroy');
    });
    
    Route::prefix('slip_gaji')->group(function () {
        Route::get('/', '\App\Http\Controllers\SlipGajiController@index')->name('admin.slip_gaji.index');
        Route::get('/create', '\App\Http\Controllers\SlipGajiController@create')->name('admin.slip_gaji.create');
        Route::post('/store', '\App\Http\Controllers\SlipGajiController@store')->name('admin.slip_gaji.store');
        Route::get('/edit/{id}', '\App\Http\Controllers\SlipGajiController@edit')->name('admin.slip_gaji.edit');
        Route::put('/update/{id}', '\App\Http\Controllers\SlipGajiController@update')->name('admin.slip_gaji.update');
        Route::get('/detail/{id}', '\App\Http\Controllers\SlipGajiController@show')->name('admin.slip_gaji.show');
        Route::get('/destroy/{id}', '\App\Http\Controllers\SlipGajiController@destroy')->name('admin.slip_gaji.destroy');
    });
});

Route::group(['middleware' => ['auth']], function () {});