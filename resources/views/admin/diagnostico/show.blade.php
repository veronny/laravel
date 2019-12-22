@extends('adminlte::page') @section('title', 'Paciente') @section('content_header')
<h1>Diagnosticos</h1>

<ol class="breadcrumb ">
    <li><a href="">Principal</a></a>
    </li>
    <li><a href="">Diagnosticos</a></a>
    </li>
</ol>
@stop @section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <a class="product-title"></a>
        </h3>
        <div class="box-tools pull-right">
            <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Volver</a>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <!-- box-body -->
    <div class="box-body">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="20px">CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th>TIPO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($diagnosticos as $d)
                    <tr>
                        <td>{{ $d->CODIGO }}</td>
                        <td>{{ $d->DESCRIPCION }}</td>
                        <td>{{ $d->TIPO }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Editar</a>
                        </td>
                        <td>
                            <a href="#"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        Desarrollado por: Unidad de Sistemas e Informatica
    </div>
    <!-- box-footer -->
</div>
<!-- /.box -->
@stop