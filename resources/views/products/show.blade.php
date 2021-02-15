@extends('layout')
@section('title',"Producto {$product->id}")
@section('content')
    <h1>Producto #{{$product->id}}</h1>
    <p class="text-right">
        <a href="{{ route('products.index') }}"
        class="btn btn-danger" title="Volver ">
            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
        </a>
   </p>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Datos del Producto</h5>
        </div>
        <div class="card-body">
            
            <p class="m-0"><b>Nombre:</b> {{$product->name}}</p>
            <p class="m-0"><b>Precio:</b> {{$product->price}}</p>
            <p class="m-0"><b>Costo:</b> {{$product->cost}}</p>
            <p class="m-0"><b>Costo:</b> {{$product->stock}}</p>
            <p class="m-0"><b>Descripcion:</b></p>
            <div class="card-deck">
                <p>
                    {{$product->description}}
                </p>
            </div>
            @if ($product->category)
            <p class="m-0"><b>Categoria:</b> <span class="badge badge-pill badge-success align-right"> {{$product->category->name}} </span></p> 
            @endif
        </div>
    </div>    
@endsection