<?php
use Illuminate\Support\Facades\Route;



Route::get('/', 'ProfesoresController@listProfesores')->name('listProfesores'); //Lista de listProfesores
Route::DELETE('delete/{id}', 'ProfesoresController@eliminarProfe')->name('eliminarProfe'); 
