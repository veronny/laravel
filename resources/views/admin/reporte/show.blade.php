<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
                table {
                    font-family: arial, sans-serif;
                    border-collapse: collapse;
                    width: auto;
                    font-size: x-small;
                }
                
                td, th {
                    border: 0.5px solid #0f0f0f;
                    text-align: center;
                    padding: 1px;
                    width: auto;
                }
                
                h3 {
                    text-align: center;
                    border: 0.1px solid #0f0f0f;
                    font-size: xx-small;
                    padding: 0px;
                }

                h4 {
                    text-align: center;
                    border: 0.5px solid #0f0f0f;
                    font-size: x-small;
                }

                #medidesc {
                    text-align: left;
                }
        </style>
    </head>

    <body>
        <h4><em>REPORTE ANEXO 02 - FORMATO UNICO DE ATENCION</em></h4>

        @if ($diagnosticos != [])
        <h3>DIAGNOSTICOS</h3>
            <table>
                                <thead>
                                    <tr>
                                        <th width="20px">CUENTA</th>
                                        <th width="20px">CODIGO</th>
                                        <th>DESCRIPCION</th>
                                        <th>TIPO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($diagnosticos as $d)

                                    <tr>
                                        <td>{{ $d->CUENTA }}</td>
                                        <td>{{ $d->CODIGO }}</td>
                                        <td>{{ $d->DESCRIPCION }}</td>
                                        <td>{{ $d->TIPO }}</td>
                                    </tr>
                                        
                                    @endforeach
                                </tbody>
            </table>
    @endif       
        @if ($medicamentos != [])
            <h3>PRODUCTOS FARMACEUTICOS/MEDICAMENTOS</h3>
                <table>
                                    <thead>
                                        <tr>
                                            <th width="20px">SISMED</th>
                                            <th>NOMBRE (Denom,Conc,Pres,FF)</th>
                                            <th>PRES</th>
                                            <th>ENTR</th>
                                            <th>DX</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($medicamentos as $p)
                                        
                                        @if ( $p->TipoProducto == 0)
                                        <tr>
                                            <td>{{ $p->Codigo }}</td>
                                            <td id="medidesc"> {{ $p->Nombre }}</td>
                                            <td>{{ $p->Cantidad }}</td>
                                            <td>{{ $p->SISDiagnostico }}</td>
                                            <td>{{ $p->SISDiagnostico }}</td>    
                                        @else
                                        
                                        @endif
                                        @endforeach
                                        

                                    </tbody>
                </table>
        @endif    
        @if ($insumos != [])    
            <h3>DISPOSITIVOS MEDICOS/PRODUCTOS SANITARIOS</h3>
                <table>
                                <thead>
                                    <tr>
                                        <th width="20px">SISMED</th>
                                        <th>NOMBRE (Denom,Conc,Pres,FF)</th>
                                        <th>PRES</th>
                                        <th>ENTR</th>
                                        <th>DX</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($insumos as $p)   
                                    @if ( $p->TipoProducto == 1)
                                    <tr>
                                        <td>{{ $p->Codigo }}</td>
                                        <td id="medidesc">{{ $p->Nombre }}</td>
                                        <td>{{ $p->Cantidad }}</td>
                                        <td>{{ $p->SISDiagnostico }}</td>
                                        <td>{{ $p->SISDiagnostico }}</td>
                                    @else
                                        
                                    @endif
                                    @endforeach
                                </tbody>
                </table>
        @endif
        @if ($proces != [])    
            <h3>PROCEDIMIENTOS</h3>    
                <table>
                                <thead>
                                    <tr>
                                        <th width="20px">CODIGO</th>
                                        <th>NOMBRE</th>
                                        <th>IND</th>
                                        <th>EJE</th>
                                        <th>DX</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proces as $pro)
                                    <tr>
                                        <td>{{ $pro->Codigo }}</td>
                                        <td id="medidesc">{{ $pro->Nombre }}</td>
                                        <td>{{ $pro->Cantidad }}</td>
                                        <td>{{ $pro->CantidadDespachada }}</td>
                                        <td>{{ $pro->SISDiagnostico }}</td>
                                        @endforeach    
                                </tbody>
                </table>
        @endif
        @if ($ordenes != [])   
            <h3>DIAGNOSTICOS POR IMAGENES/LABORATORIO</h3>    
                <table>
                                <thead>
                                    <tr>
                                        <th width="20px">CODIGO</th>
                                        <th>NOMBRE</th>
                                        <th>IND</th>
                                        <th>EJE</th>
                                        <th>DX</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ordenes as $p)
                                    <tr>
                                        <td>{{ $p->Codigo }}</td>
                                        <td id="medidesc">{{ $p->Nombre }}</td>
                                        <td>{{ $p->CantidadPedida }}</td>
                                        <td>{{ $p->CantidadDespachada }}</td>
                                        <td>{{ $p->SISDiagnostico }}</td>
                                    @endforeach
                                </tbody>
                </table>
        @endif
        </div>    
    </body>
</html>


