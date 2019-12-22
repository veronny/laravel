<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pacisess_sis;
use Illuminate\Support\Facades\DB;


class PacientesisController extends Controller
{
    public function index(Request $request)
    {
        $cuenta = $request->get('cuenta');
        $hc = $request->get('hc');
        $nombre = $request->get('nombre');
        $fecha = $request->get('fecha');
               
        $pacientes = DB::select('SELECT
                    dbo.Atenciones.IdPaciente,
                    dbo.Atenciones.IdAtencion ,
                    dbo.Atenciones.IdCuentaAtencion AS NroCuenta,
                    dbo.Pacientes.ApellidoPaterno,
                    dbo.Pacientes.ApellidoMaterno,
                    dbo.Pacientes.PrimerNombre,
                    dbo.Pacientes.SegundoNombre,
                    dbo.Pacientes.NroHistoriaClinica,
                    dbo.Pacientes.FichaFamiliar,
                    dbo.Pacientes.FechaNacimiento AS FecNacim,
                    CONVERT ( CHAR ( 10 ), dbo.Atenciones.FechaIngreso, 103 ) AS FechaIngreso,
                    dbo.Atenciones.HoraIngreso,
                    dbo.Atenciones.HoraEgreso,
                    dbo.Servicios.Nombre AS ServicioIngreso,
                    dbo.Atenciones.Edad AS Edad,
                    dbo.Citas.IdCita,
                    dbo.Pacientes.IdTipoNumeracion,
                    dbo.Atenciones.IdServicioIngreso,
                    dbo.Atenciones.IdMedicoIngreso,
                    dbo.TiposNumeracionHistoria.Descripcion AS TipoNumeracion,
                    dbo.Atenciones.idEstadoAtencion,
                    dbo.Atenciones.IdFormaPago,
                    dbo.TiposFinanciamiento.GeneraPago,
                    dbo.Servicios.idEspecialidad
                FROM
                    dbo.Atenciones
                    LEFT OUTER JOIN dbo.TiposFinanciamiento ON dbo.Atenciones.IdFormaPago = dbo.TiposFinanciamiento.IdTipoFinanciamiento
                    LEFT OUTER JOIN dbo.Servicios ON dbo.Atenciones.IdServicioIngreso = dbo.Servicios.IdServicio
                    LEFT OUTER JOIN dbo.Pacientes ON dbo.Atenciones.IdPaciente = dbo.Pacientes.IdPaciente
                    LEFT OUTER JOIN dbo.Citas ON dbo.Citas.IdAtencion = dbo.Atenciones.IdAtencion
                    LEFT OUTER JOIN dbo.TiposNumeracionHistoria ON dbo.Pacientes.IdTipoNumeracion = dbo.TiposNumeracionHistoria.IdTipoNumeracion
                    WHERE dbo.Atenciones.IdCuentaAtencion = ?
                    ORDER BY FechaIngreso', [$cuenta]);
        
        if ($hc != "") 
        {
            $pacientes = DB::select('SELECT
                    dbo.Atenciones.IdPaciente,
                    dbo.Atenciones.IdAtencion,
                    dbo.Atenciones.IdCuentaAtencion AS NroCuenta,
                    dbo.Pacientes.ApellidoPaterno,
                    dbo.Pacientes.ApellidoMaterno,
                    dbo.Pacientes.PrimerNombre,
                    dbo.Pacientes.SegundoNombre,
                    dbo.Pacientes.NroHistoriaClinica,
                    dbo.Pacientes.FichaFamiliar,
                    dbo.Pacientes.FechaNacimiento AS FecNacim,
                    CONVERT ( CHAR ( 10 ), dbo.Atenciones.FechaIngreso, 103 ) AS FechaIngreso,
                    dbo.Atenciones.HoraIngreso,
                    dbo.Atenciones.HoraEgreso,
                    dbo.Servicios.Nombre AS ServicioIngreso,
                    dbo.Atenciones.Edad AS Edad,
                    dbo.Citas.IdCita,
                    dbo.Pacientes.IdTipoNumeracion,
                    dbo.Atenciones.IdServicioIngreso,
                    dbo.Atenciones.IdMedicoIngreso,
                    dbo.TiposNumeracionHistoria.Descripcion AS TipoNumeracion,
                    dbo.Atenciones.idEstadoAtencion,
                    dbo.Atenciones.IdFormaPago,
                    dbo.TiposFinanciamiento.GeneraPago,
                    dbo.Servicios.idEspecialidad
                FROM
                    dbo.Atenciones
                    LEFT OUTER JOIN dbo.TiposFinanciamiento ON dbo.Atenciones.IdFormaPago = dbo.TiposFinanciamiento.IdTipoFinanciamiento
                    LEFT OUTER JOIN dbo.Servicios ON dbo.Atenciones.IdServicioIngreso = dbo.Servicios.IdServicio
                    LEFT OUTER JOIN dbo.Pacientes ON dbo.Atenciones.IdPaciente = dbo.Pacientes.IdPaciente
                    LEFT OUTER JOIN dbo.Citas ON dbo.Citas.IdAtencion = dbo.Atenciones.IdAtencion
                    LEFT OUTER JOIN dbo.TiposNumeracionHistoria ON dbo.Pacientes.IdTipoNumeracion = dbo.TiposNumeracionHistoria.IdTipoNumeracion
                    WHERE dbo.Pacientes.NroHistoriaClinica = ?
                    ORDER BY FechaIngreso', [$hc]);
        } 
        if ($nombre != "")
        {
            $pacientes = DB::select('SELECT
                    dbo.Atenciones.IdPaciente,
                    dbo.Atenciones.IdAtencion,
                    dbo.Atenciones.IdCuentaAtencion AS NroCuenta,
                    dbo.Pacientes.ApellidoPaterno,
                    dbo.Pacientes.ApellidoMaterno,
                    dbo.Pacientes.PrimerNombre,
                    dbo.Pacientes.SegundoNombre,
                    dbo.Pacientes.NroHistoriaClinica,
                    dbo.Pacientes.FichaFamiliar,
                    dbo.Pacientes.FechaNacimiento AS FecNacim,
                    CONVERT ( CHAR ( 10 ), dbo.Atenciones.FechaIngreso, 103 ) AS FechaIngreso,
                    dbo.Atenciones.HoraIngreso,
                    dbo.Atenciones.HoraEgreso,
                    dbo.Servicios.Nombre AS ServicioIngreso,
                    dbo.Atenciones.Edad AS Edad,
                    dbo.Citas.IdCita,
                    dbo.Pacientes.IdTipoNumeracion,
                    dbo.Atenciones.IdServicioIngreso,
                    dbo.Atenciones.IdMedicoIngreso,
                    dbo.TiposNumeracionHistoria.Descripcion AS TipoNumeracion,
                    dbo.Atenciones.idEstadoAtencion,
                    dbo.Atenciones.IdFormaPago,
                    dbo.TiposFinanciamiento.GeneraPago,
                    dbo.Servicios.idEspecialidad
                FROM
                    dbo.Atenciones
                    LEFT OUTER JOIN dbo.TiposFinanciamiento ON dbo.Atenciones.IdFormaPago = dbo.TiposFinanciamiento.IdTipoFinanciamiento
                    LEFT OUTER JOIN dbo.Servicios ON dbo.Atenciones.IdServicioIngreso = dbo.Servicios.IdServicio
                    LEFT OUTER JOIN dbo.Pacientes ON dbo.Atenciones.IdPaciente = dbo.Pacientes.IdPaciente
                    LEFT OUTER JOIN dbo.Citas ON dbo.Citas.IdAtencion = dbo.Atenciones.IdAtencion
                    LEFT OUTER JOIN dbo.TiposNumeracionHistoria ON dbo.Pacientes.IdTipoNumeracion = dbo.TiposNumeracionHistoria.IdTipoNumeracion
                    WHERE dbo.Pacientes.ApellidoPaterno = ?
                    ORDER BY FechaIngreso', [$nombre]);
        }
        if ($fecha != "")
        {
            $pacientes = DB::select('SELECT
                    dbo.Atenciones.IdPaciente,
                    dbo.Atenciones.IdAtencion,
                    dbo.Atenciones.IdCuentaAtencion AS NroCuenta,
                    dbo.Pacientes.ApellidoPaterno,
                    dbo.Pacientes.ApellidoMaterno,
                    dbo.Pacientes.PrimerNombre,
                    dbo.Pacientes.SegundoNombre,
                    dbo.Pacientes.NroHistoriaClinica,
                    dbo.Pacientes.FichaFamiliar,
                    dbo.Pacientes.FechaNacimiento AS FecNacim,
                    CONVERT ( CHAR ( 10 ), dbo.Atenciones.FechaIngreso, 103 ) AS FechaIngreso,
                    dbo.Atenciones.HoraIngreso,
                    dbo.Atenciones.HoraEgreso,
                    dbo.Servicios.Nombre AS ServicioIngreso,
                    dbo.Atenciones.Edad AS Edad,
                    dbo.Citas.IdCita,
                    dbo.Pacientes.IdTipoNumeracion,
                    dbo.Atenciones.IdServicioIngreso,
                    dbo.Atenciones.IdMedicoIngreso,
                    dbo.TiposNumeracionHistoria.Descripcion AS TipoNumeracion,
                    dbo.Atenciones.idEstadoAtencion,
                    dbo.Atenciones.IdFormaPago,
                    dbo.TiposFinanciamiento.GeneraPago,
                    dbo.Servicios.idEspecialidad
                FROM
                    dbo.Atenciones
                    LEFT OUTER JOIN dbo.TiposFinanciamiento ON dbo.Atenciones.IdFormaPago = dbo.TiposFinanciamiento.IdTipoFinanciamiento
                    LEFT OUTER JOIN dbo.Servicios ON dbo.Atenciones.IdServicioIngreso = dbo.Servicios.IdServicio
                    LEFT OUTER JOIN dbo.Pacientes ON dbo.Atenciones.IdPaciente = dbo.Pacientes.IdPaciente
                    LEFT OUTER JOIN dbo.Citas ON dbo.Citas.IdAtencion = dbo.Atenciones.IdAtencion
                    LEFT OUTER JOIN dbo.TiposNumeracionHistoria ON dbo.Pacientes.IdTipoNumeracion = dbo.TiposNumeracionHistoria.IdTipoNumeracion
                    WHERE FechaIngreso = ?
                    ORDER BY FechaIngreso', [$fecha]);
                     
        }

        return view('admin.consultorio.index', compact('pacientes'));
    }
}
