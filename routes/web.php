<?php

use App\Http\Controllers\ordersController;
use Illuminate\Support\Facades\Route;

Route::post('/', [ordersController::class, 'store'])->name('store');
Route::delete('/{Custom:id}', [ordersController::class, 'destroy'])->name('destroy');
Route::get('/','App\Http\Controllers\ordersController@index');
Route::get('/updateTask/{id}', [ordersController::class, 'updateTask'])->name('updateTask');
Route::post('/updateData/{id}', [ordersController::class, 'updateData'])->name('updateData');
Route::get('/Project/{name}', [ordersController::class, 'findByProject'])->name('findByProject');
Route::post('Custom-sortable','App\Http\Controllers\ordersController@update');
Route::post('/delete-all', 'App\Http\Controllers\ordersController@deleteAll');