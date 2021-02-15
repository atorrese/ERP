@extends('layout')
@section('title',"Usuario {$category->id}")
@section('content')
    <h1>Categoria #{{$category->id}}</h1>
    <p class="text-right">
        <a href="{{ route('categories.index') }}"
        class="btn btn-danger" title="Volver ">
            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
        </a>
   </p>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Datos de Categoria</h5>
        </div>
        <div class="card-body">
            
            <p class="m-0"><b>Nombre del Categoria:</b> {{$category->name}}</p>
            {{-- <p class="m-0"><b>Correo Electronico:</b> {{$category->email}}</p> --}}
{{--             @if ($category->profession)
            <p class="m-0"><b>Profesión:</b> {{$category->profession->title}}</p> 
            @endif
            

            @if ($category->is_admin)
            <span class="badge badge-pill badge-success align-right">Administrador</span>
            @else
            <span class="badge badge-pill badge-info">Usuario Normal</span>
            @endif --}}
        </div>
    </div>    
@endsection