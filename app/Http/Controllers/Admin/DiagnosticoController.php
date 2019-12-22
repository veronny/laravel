<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DiagnosticoController extends Controller
{
    public function show($paciente)
    {
    $diagnosticos = DB::select('SELECT  DIA.CodigoCIE10 AS CODIGO,
                                DIA.Descripcion AS DESCRIPCION , SCD.Descripcion AS TIPO
                                FROM Atenciones AS ATE 
                                INNER JOIN Pacientes AS PAC ON ATE.IdPaciente=PAC.IdPaciente 
                                INNER JOIN AtencionesDiagnosticos AS ATD ON ATE.IdAtencion=ATD.IdAtencion
                                INNER JOIN Diagnosticos AS DIA ON  ATD.IdDiagnostico=DIA.IdDiagnostico
                                INNER JOIN Servicios AS SER ON ATE.IdServicioIngreso=SER.IdServicio
                                INNER JOIN SubclasificacionDiagnosticos AS SCD ON ATD.IdSubclasificacionDx=SCD.IdSubclasificacionDx
                                WHERE ATE.IdCuentaAtencion=?', [$paciente]);
       
       return view('admin.diagnostico.show', compact('diagnosticos'));
    }
}
