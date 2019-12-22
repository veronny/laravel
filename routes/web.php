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

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){

    //Reporte
    Route::get('reporte/{paciente}', 'ReporteController@show')->name('admin.reporte.show'); 
    
    //Procedimientos
    Route::get('diagnostico/{paciente}', 'DiagnosticoController@show')->name('admin.diagnostico.show'); 
    
    //Procedimientos
    Route::get('procedimientos/{paciente}', 'ProcedimientoController@show')->name('admin.procedimiento.show'); 
    
    //Insumos
    Route::get('insumo/{paciente}', 'InsumosController@show')->name('admin.insumo.show'); 
    
    //Medicinas
    Route::get('medicina', 'MedicinaController@index')->name('admin.medicina');
    Route::get('medicina/{paciente}', 'MedicinaController@show')->name('admin.medicina.show');


    //Paciente SIS
    Route::get('pacientesis', 'PacientesisController@index')->name('admin.pacientesis');
 
    //Paciente
    Route::get('paciente/{paciente}', 'PacienteController@show')->name('admin.paciente.show');
    Route::get('paciente', 'PacienteController@index')->name('admin.paciente');
    //Route::resource('paciente','PacienteController');    


    Route::get('/', 'AdminController@index')->name('admin.home');

});

Route::get('/', 'Site\SiteController@index')->name('home');

Auth::routes();


