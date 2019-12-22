@extends('adminlte::page') @section('title', 'Paciente') @section('content_header')
<h1>Busqueda de Paciente</h1>

<ol class="breadcrumb ">
    <li><a href="">Principal</a></a>
    </li>
    <li><a href="">Listado de Paciente</a></a>
    </li>
</ol>
@stop @section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
        <div class="box-tools">                       
            {{ Form::open(['route' => 'admin.paciente' , 'method' => 'GET', 'class' => 'form-inline pull-right' ]) }}
                <div class="form-group">
                    {{ Form::text('cuenta', null, ['class' => 'form-control', 'placeholder'=> 'Cuenta']) }}
                </div>                         
                <div class="form-group">
                    {{ Form::text('nombre', null, ['class' => 'form-control', 'placeholder'=> 'Nombre Paciente']) }}
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
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th width="20px">CUENTA</th>
                    <th>AP PATERNO</th>
                    <th>AP MATERNO</th>
                    <th>NOMBRE</th>
                    <th>SEG NOMBRE</th>
                    <th>HC</th>
                    <th>FECHA INGRESO</th>
                    <th>SERVICIO</th>
                    <th colspan="1">&nbsp;</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $p)
                <tr>
                    <td>{{ $p->NroCuenta }}</td>
                    <td>{{ $p->ApellidoPaterno }}</td>
                    <td>{{ $p->ApellidoMaterno }}</td>
                    <td>{{ $p->PrimerNombre }}</td>
                    <td>{{ $p->SegundoNombre }}</td>
                    <td>{{ $p->NroHistoriaClinica }}</td>
                    <td>{{ $p->FechaIngreso }}</td>
                    <td>{{ $p->ServicioIngreso }}</td>
                    <td>
                        <a href="{{ route('admin.diagnostico.show', $p->NroCuenta) }}">Detalle</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        Desarrollado por: Unidad de Sistemas e Informatica
    </div>
    <!-- box-footer -->
</div>
<!-- /.box -->
@stop