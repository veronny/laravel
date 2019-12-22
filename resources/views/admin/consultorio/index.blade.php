@extends('adminlte::page') @section('title', 'Paciente') @section('content_header')
<h1>Auditoria en Consultorio Externo</h1>

<ol class="breadcrumb ">
    <li><a href="">Principal</a></a>
    </li>
    <li><a href="">Consulta Externa</a></a>
    </li>
</ol>
@stop @section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <div class="box-tools">
                {{ Form::open(['route' => 'admin.pacientesis' , 'method' => 'GET', 'class' => 'form-inline pull-right' ]) }}
                <div class="form-group">
                    {{ Form::text('cuenta', null, ['class' => 'form-control', 'placeholder'=> 'Cuenta']) }}
                </div>
                <div class="form-group">
                    {{ Form::text('hc', null, ['class' => 'form-control', 'placeholder'=> 'Historia Clinica']) }}
                </div>
                <div class="form-group">
                    {{ Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=> 'Apellido Paterno']) }}
                </div>    
                <div class="form-group">
                    {{ Form::text('fecha', null, ['class' => 'form-control', 'placeholder'=> 'Fecha (dd/mm/aaaa)']) }}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
                {{ Form::close()}}
            </div>
        </h3>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="20px">CUENTA</th>
                        <th>HC</th>
                        <th>PATERNO</th>
                        <th>MATERNO</th>
                        <th>NOMBRE</th>
                        <th>SERVICIO</th>
                        <th>FECHA</th>
                        <th colspan="4">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $p)
                    <tr>
                        <td>{{ $p->NroCuenta }}</td>
                        <td>{{ $p->NroHistoriaClinica }}</td>
                        <td>{{ $p->ApellidoPaterno }}</td>
                        <td>{{ $p->ApellidoMaterno }}</td>
                        <td>{{ $p->PrimerNombre }}</td>
                        <td>{{ $p->ServicioIngreso }}</td>
                        <td>{{ $p->FechaIngreso }}</td>
                        <td width="10px">
                            <a href="{{ route('admin.medicina.show', $p->NroCuenta) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-medkit"></i> Med</a>
                        </td>
                        <td width="10px">
                            <a href="{{ route('admin.insumo.show', $p->NroCuenta) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-flask"></i> Ins</a>
                        </td>
                        <td width="10px">
                            <a href="{{ route('admin.procedimiento.show', $p->NroCuenta) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-wheelchair"></i> Proc</a>
                        </td>
                        <td width="10px">
                            <a href="{{ route('admin.reporte.show', $p->NroCuenta) }}" class="btn btn-success btn-sm" target="_blank">
                                <i class="fa fa-print"></i> Imp</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->

        <!-- /.box-tools -->
    </div>

    <div class="box-footer">
        Desarrollado por: Unidad de Sistemas e Informatica
    </div>
    <!-- box-footer -->
</div>
<!-- /.box -->
@stop