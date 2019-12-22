@extends('adminlte::page') @section('title', 'Paciente') @section('content_header')
<h1>Paciente</h1>

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
            <a class="product-title">Nro de Cuenta:</a>
            <span class="product-description">{{ $pacientes->CUENTA_C }}</span>
            <a class="product-title">Nombre:</a>
            <span class="product-description">{{ $pacientes->NOMBRE }}</span>
        </h3>
        <div class="box-tools pull-right">
            <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Volver</a>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <!-- box-body -->
    <div class="box-body">
        <ul class="products-list">
            <li class="item">
                <div class="product-info">
                    <a class="product-title">Fecha de Ingreso
                    <span class="product-description">{{ $pacientes->FECHA_INGR }}</span>
                </div>
            </li>
            <li class="item">
                <div class="product-info">
                    <a class="product-title">Fecha de Alta
                    <span class="product-description">{{ $pacientes->FECHA_ALTA }}</span>
                </div>
            </li>
            <li class="item">
                <div class="product-info">
                    <a class="product-title">Diagnostico
                    <span class="product-description">{{ $pacientes->DIAG1 }}</span>
                </div>
            </li>
            <li class="item">
                <div class="product-info">
                    <a class="product-title">Motivo
                    <span class="product-description">{{ $pacientes->MOTIVO }}</span>
                </div>
            </li>
            <li class="item">
                <div class="product-info">
                    <a class="product-title">Medicina
                    <span class="product-description">S/. {{ $pacientes->C_MEDICINA }}</span>
                </div>
            </li>
            <li class="item">
                <div class="product-info">
                    <a class="product-title">Laboratorio
                    <span class="product-description">S/. {{ $pacientes->LABORATORI }}</span>
                </div>
            </li>
            <li class="item">
                <div class="product-info">
                    <a class="product-title">Imagenes 
                    <span class="product-description">S/. {{ $pacientes->IMAGENES }}</span>
                </div>
            </li>
            <li class="item">
                <div class="product-info">
                    <a class="product-title">Monto
                    <span class="product-description">S/. {{ $pacientes->MTO_ASEGUR }}</span>
                </div>
            </li>
            <li class="item">
                <div class="product-info">
                    <a class="product-title">Digitador
                    <span class="product-description">{{ $pacientes->DIGITADOR }}</span>
                </div>
            </li>
            <!-- /.item -->
        </ul>
    </div>
      <!-- /.box-body -->
    <div class="box-footer">
        Desarrollado por: Unidad de Sistemas e Informatica
    </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->
    @stop