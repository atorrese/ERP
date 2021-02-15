@extends('layout')
@section('title',"Categorias")
@section('content')
        <h1>{{$title}}</h1>
        <a href="{{ route('categories.create') }}"
            class="btn btn-success" title="Crear Usuario">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
        <table class="table table-light">
            <thead>
                <th>Id </th>
                <th>Nombre </th>
                <th>Acciones </th>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <form class="m-0" action="{{ route('categories.destroy', $category) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <a href="{{ route('categories.show',$category) }}" {{-- {{ route('categories.show', ['category'=>$category]) }} --}}
                                class="btn btn-info " title="Ver Detalle">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                           </a>
                           <a href="{{ route('categories.edit',$category) }}"
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
                        <td>No existen Categorias registradas.</td>
                    </tr>

                @endforelse   
            </tbody>
        </table>
         {{$categories->links()}}
{{--         {{$categories->appends(['sort' => 'name'])->links()}} --}}
{{--         <ul>
            @forelse ($categories as $category)
                <li>
                    {{$category->name}}, ({{$category->email}})
                    <a href="{{ route('categories.show', ['id'=>$category->id]) }}">Ver detalles</a>
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
    