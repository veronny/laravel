<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProcedimientoController extends Controller
{
    public function show($paciente)
    {
                  
        $procedimientos = DB::select('SELECT
                                        dbo.FactOrdenServicio.IdPuntoCarga,
                                        dbo.FactCatalogoServicios.IdProducto,
                                        dbo.FactCatalogoServicios.Codigo,
                                        dbo.FactCatalogoServicios.Nombre,
                                        dbo.FacturacionServicioDespacho.Cantidad,
                                        dbo.FactOrdenServicio.IdCuentaAtencion,
                                        dbo.FactOrdenServicio.IdOrden,
                                        dbo.FactOrdenServicio.idServicioPaciente AS idServicio,
                                        dbo.SisAuditor.CantidadDespachada,
                                        dbo.SisAuditor.SISDiagnostico
                                        FROM
                                        dbo.FactCatalogoServicios
                                        RIGHT JOIN dbo.FacturacionServicioDespacho ON dbo.FactCatalogoServicios.IdProducto = dbo.FacturacionServicioDespacho.IdProducto
                                        LEFT JOIN dbo.FactOrdenServicio ON dbo.FacturacionServicioDespacho.idOrden = dbo.FactOrdenServicio.IdOrden 
                                        LEFT JOIN dbo.SisAuditor ON dbo.FactOrdenServicio.IdOrden = dbo.SisAuditor.Idsisauditor AND dbo.FacturacionServicioDespacho.IdProducto = dbo.SisAuditor.IdProducto AND dbo.FactOrdenServicio.IdCuentaAtencion = dbo.SisAuditor.IdCuentaAtencion
                                        WHERE       ( dbo.FactOrdenServicio.IdEstadoFacturacion <> 9 ) AND
                                        (dbo.FactOrdenServicio.idPuntoCarga = 1) AND
                                                    dbo.FactOrdenServicio.IdCuentaAtencion=? 
                                                    ORDER BY
                                                    dbo.FactCatalogoServicios.Nombre', [$paciente]);

        $ordenes = DB::select('SELECT
                                    dbo.RecetaCabecera.idReceta,
                                    dbo.RecetaCabecera.IdPuntoCarga,
                                    dbo.RecetaCabecera.idCuentaAtencion,
                                    dbo.RecetaCabecera.idEstado,
                                    ( SELECT TOP 1 dbo.RecetaDetalleItem.DocumentoDespacho FROM dbo.RecetaDetalleItem WHERE dbo.RecetaDetalleItem.idReceta = dbo.RecetaCabecera.idReceta ) AS DocumentoDespacho,
                                    dbo.RecetaDetalle.idItem AS idProducto,
                                    dbo.RecetaDetalle.CantidadPedida,
                                    dbo.FactCatalogoServicios.Codigo,
                                    dbo.FactCatalogoServicios.Nombre,
                                    dbo.RecetaDetalle.Precio,
                                    dbo.SisAuditor.CantidadDespachada,
	                                dbo.SisAuditor.SISDiagnostico  
                                FROM
                                    dbo.RecetaCabecera
                                    INNER JOIN dbo.RecetaDetalle ON dbo.RecetaCabecera.idReceta = dbo.RecetaDetalle.idReceta
                                    LEFT JOIN dbo.FactCatalogoServicios ON dbo.RecetaDetalle.idItem = dbo.FactCatalogoServicios.IdProducto 
                                    LEFT JOIN dbo.SisAuditor ON dbo.RecetaCabecera.idCuentaAtencion = dbo.SisAuditor.idCuentaAtencion 
	                                AND dbo.RecetaDetalle.idItem = dbo.SisAuditor.Iditem 
	                                AND dbo.RecetaDetalle.idReceta = dbo.SisAuditor.Idsisauditor
                                WHERE
                                    dbo.RecetaCabecera.idPuntoCarga IN (2,3,4,11,20,21,22,23,31,33,34) 
                                    AND dbo.RecetaCabecera.idCuentaAtencion = ? 
                                ORDER BY
                                    dbo.FactCatalogoServicios.Nombre', [$paciente]);


       
       return view('admin.procedimiento.show', compact('procedimientos','ordenes'));
    }


}
