@extends('layout')
@section('title',"Usuarios")
@section('content')
        <h1>{{$title}}</h1>
        <a href="{{ route('products.create') }}"
            class="btn btn-success" title="Crear Usuario">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
        <table class="table table-light table-responsive">
            <thead>
                <th>Id </th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Costo</th>
                <th>Existencia</th>
                <th>Acciones </th>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->cost}}</td>
                    <td>{{$product->stock}}</td>

                    <td>
                        <form class="m-0" action="{{ route('products.destroy', $product) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <a href="{{ route('products.show',$product) }}" {{-- {{ route('products.show', ['product'=>$product]) }} --}}
                                class="btn btn-info " title="Ver Detalle">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                           </a>
                           <a href="{{ route('products.edit',$product) }}"
                               class="btn btn-warning" title="Editar Usuario">
                               <i class="fa fa-edit" aria-hidden="true"></i>
                           </a>
                            <button type="submit"
                            class="btn btn-danger" title="Eliminar Usuario">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        </form>

                    </td>
                </tr>
                @empty
                    <tr>
                        <td>No hay usuarios registrados.</td>
                    </tr>

                @endforelse   
            </tbody>
        </table>
        {{$products->links()}}
{{--         <ul>
            @forelse ($products as $product)
                <li>
                    {{$product->name}}, ({{$product->email}})
                    <a href="{{ route('products.show', ['id'=>$product->id]) }}">Ver detalles</a>
                </li>
            @empty
                <li>No hay usuarios registrados.</li>
            @endforelse   
        </ul>  --}}     
@endsection
{{-- @section('sidebar')
    @parent
    <h2>Barra Lateral personalizada</h2>
@endsection --}}
    