<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;


class ReporteController extends Controller
{
    public function show($paciente)
    {
        $medicamentos = DB::select('SELECT
                                    dbo.farmMovimientoDetalle.MovNumero,
                                    dbo.farmMovimientoDetalle.MovTipo,
                                    dbo.farmMovimientoDetalle.idProducto,
                                    dbo.farmMovimientoDetalle.Lote,
                                    dbo.farmMovimientoDetalle.FechaVencimiento,
                                    dbo.farmMovimientoDetalle.Item,
                                    dbo.farmMovimientoDetalle.Cantidad,
                                    dbo.farmMovimientoDetalle.Precio,
                                    dbo.farmMovimientoDetalle.Total,
                                    dbo.farmMovimientoDetalle.RegistroSanitario,
                                    dbo.FactCatalogoBienesInsumos.Codigo,
                                    dbo.FactCatalogoBienesInsumos.Nombre,
                                    dbo.farmMovimientoDetalle.idTipoSalidaBienInsumo,
                                    dbo.FactCatalogoBienesInsumos.TipoProducto,
                                    SA.SISDiagnostico
                                FROM
                                    dbo.farmMovimientoDetalle
                                LEFT OUTER JOIN dbo.FactCatalogoBienesInsumos ON dbo.farmMovimientoDetalle.idProducto = dbo.FactCatalogoBienesInsumos.IdProducto
                                INNER JOIN dbo.farmMovimientoVentas ON dbo.farmMovimientoDetalle.MovNumero = dbo.farmMovimientoVentas.MovNumero
                                INNER JOIN dbo.farmMovimiento ON dbo.farmMovimientoDetalle.MovNumero = dbo.farmMovimiento.MovNumero
                                LEFT JOIN SisAuditor SA ON dbo.farmMovimientoVentas.idCuentaAtencion = SA.idCuentaAtencion
                                WHERE
                                    dbo.farmMovimientoVentas.idCuentaAtencion = ? AND
                                    dbo.farmMovimiento.idEstadoMovimiento <> 0

                                ORDER BY
                                    dbo.farmMovimientoDetalle.Item', [$paciente]);
        
        $insumos = DB::select('SELECT
                                dbo.farmMovimientoDetalle.MovNumero,
                                dbo.farmMovimientoDetalle.MovTipo,
                                dbo.farmMovimientoDetalle.idProducto,
                                dbo.farmMovimientoDetalle.Lote,
                                dbo.farmMovimientoDetalle.FechaVencimiento,
                                dbo.farmMovimientoDetalle.Item,
                                dbo.farmMovimientoDetalle.Cantidad,
                                dbo.farmMovimientoDetalle.Precio,
                                dbo.farmMovimientoDetalle.Total,
                                dbo.farmMovimientoDetalle.RegistroSanitario,
                                dbo.FactCatalogoBienesInsumos.Codigo,
                                dbo.FactCatalogoBienesInsumos.Nombre,
                                dbo.farmMovimientoDetalle.idTipoSalidaBienInsumo,
                                dbo.FactCatalogoBienesInsumos.TipoProducto,
                                SA.SISDiagnostico
                            FROM
                                dbo.farmMovimientoDetalle
                            LEFT OUTER JOIN dbo.FactCatalogoBienesInsumos ON dbo.farmMovimientoDetalle.idProducto = dbo.FactCatalogoBienesInsumos.IdProducto
                            INNER JOIN dbo.farmMovimientoVentas ON dbo.farmMovimientoDetalle.MovNumero = dbo.farmMovimientoVentas.MovNumero
                            INNER JOIN dbo.farmMovimiento ON dbo.farmMovimientoDetalle.MovNumero = dbo.farmMovimiento.MovNumero
                            LEFT JOIN SisAuditor SA ON dbo.farmMovimientoVentas.idCuentaAtencion = SA.idCuentaAtencion
                            WHERE
                                dbo.farmMovimientoVentas.idCuentaAtencion = ? AND
                                dbo.farmMovimiento.idEstadoMovimiento <> 0

                            ORDER BY
                                dbo.farmMovimientoDetalle.Item', [$paciente]);

        $proces = DB::select('SELECT
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
                                        RIGHT OUTER JOIN dbo.FacturacionServicioDespacho ON dbo.FactCatalogoServicios.IdProducto = dbo.FacturacionServicioDespacho.IdProducto
                                        LEFT OUTER JOIN dbo.FactOrdenServicio ON dbo.FacturacionServicioDespacho.idOrden = dbo.FactOrdenServicio.IdOrden
                                        LEFT JOIN dbo.SisAuditor ON dbo.FactOrdenServicio.IdOrden = dbo.SisAuditor.Idsisauditor 
                                        AND dbo.FacturacionServicioDespacho.IdProducto = dbo.SisAuditor.IdProducto 
                                        AND dbo.FactOrdenServicio.IdCuentaAtencion = dbo.SisAuditor.IdCuentaAtencion 
                                    WHERE
                                        ( dbo.FactOrdenServicio.IdEstadoFacturacion <> 9 ) 
                                        AND ( dbo.FactOrdenServicio.idPuntoCarga = 1 ) 
                                        AND dbo.FactOrdenServicio.IdCuentaAtencion = ? 
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
                                LEFT OUTER JOIN dbo.FactCatalogoServicios ON dbo.RecetaDetalle.idItem = dbo.FactCatalogoServicios.IdProducto
                                LEFT JOIN dbo.SisAuditor ON dbo.RecetaCabecera.idCuentaAtencion = dbo.SisAuditor.idCuentaAtencion 
                                AND dbo.RecetaDetalle.idItem = dbo.SisAuditor.Iditem 
                                AND dbo.RecetaDetalle.idReceta = dbo.SisAuditor.Idsisauditor 
                            WHERE
                                dbo.RecetaCabecera.idPuntoCarga IN ( 2, 3, 4, 11, 20, 21, 22, 23, 31, 33, 34 ) 
                                AND dbo.RecetaCabecera.idCuentaAtencion = ? 
                            ORDER BY
                                dbo.FactCatalogoServicios.Nombre', [$paciente]);
        
        $diagnosticos = DB::select('SELECT  ATE.IdCuentaAtencion AS CUENTA,DIA.CodigoCIE10 AS CODIGO,DIA.Descripcion AS DESCRIPCION,SCD.Descripcion AS TIPO
                                    FROM Atenciones AS ATE 
                                    INNER JOIN Pacientes AS PAC ON ATE.IdPaciente=PAC.IdPaciente 
                                    INNER JOIN AtencionesDiagnosticos AS ATD ON ATE.IdAtencion=ATD.IdAtencion
                                    INNER JOIN Diagnosticos AS DIA ON  ATD.IdDiagnostico=DIA.IdDiagnostico
                                    INNER JOIN Servicios AS SER ON ATE.IdServicioIngreso=SER.IdServicio
                                    INNER JOIN SubclasificacionDiagnosticos AS SCD ON ATD.IdSubclasificacionDx=SCD.IdSubclasificacionDx
                                    WHERE ATE.IdCuentaAtencion=? ', [$paciente]);

       $pdf = PDF::loadView('admin.reporte.show', compact('medicamentos','insumos','proces','ordenes','diagnosticos'));
       return $pdf->stream('reporte.pdf');    
    }
}
