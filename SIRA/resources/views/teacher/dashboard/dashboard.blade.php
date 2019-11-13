<?php
$hoy = date("d.m.y"); 
?>

@extends("layouts.teachers")

@section('head')
<title>Bienvenido</title>
@endsection
@section('cuerpo')
<center>Bienvenido:::: {{auth('teachers')->user()->NOMBRES}}</center>
<center>Hora: {{$hoy}}</center>
@foreach($asignaturas as $asignatura)
<p>{{$asignatura->NOMBRE_ASIGNATURA." ".$asignatura->curso->CURSO  }}</p>
@endforeach
@endsection