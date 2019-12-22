<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MedicinaController extends Controller
{
    public function show($paciente)
    {
    
    $diagnosticos = DB::select('SELECT
                                    AtencionesDiagnosticos.IdDiagnostico,
                                    Diagnosticos.CodigoCIE2004,
                                    Diagnosticos.Descripcion,
                                    Diagnosticos.ClaseDxHIS,
                                    AtencionesDiagnosticos.labConfHIS,
                                    AtencionesDiagnosticos.IdSubClasificacionDx AS IdTipoDiagnostico,
                                    SubClasificacionDiagnosticos.Descripcion AS DescripcionTipoDx,
                                    AtencionesDiagnosticos.grupoHIS,
                                    AtencionesDiagnosticos.subgrupoHIS 
                                FROM
                                    ( AtencionesDiagnosticos LEFT JOIN SubClasificacionDiagnosticos ON AtencionesDiagnosticos.IdSubClasificacionDx = SubClasificacionDiagnosticos.IdSubClasificacionDx )
                                    LEFT JOIN Diagnosticos ON AtencionesDiagnosticos.IdDiagnostico = Diagnosticos.IdDiagnostico 
                                WHERE
                                    AtencionesDiagnosticos.IdAtencion = ?', [$paciente]);
    
    $medicinas = DB::select('SELECT
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
       //dd($medicinas);
       return view('admin.medicina.show', compact('medicinas','diagnosticos'));
    }
}
