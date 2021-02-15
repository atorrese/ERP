@extends('layout')
@section('title',"Crear Producto")
@section('content')

    <div class="card">
      <div class="card-header">
        <h2>Crear Producto</h2>
      </div>
      <div class="card-body">
        <form action="{{ route('products.store') }}" method="post" class="">
          {{ csrf_field() }}
          <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Nombre</label>
              <div class="col-sm-10">
                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{old('name')}}">
                @if ($errors->has('name'))
                <div class="invalid-feedback">
                  <p>{{$errors->first('name')}}</p>
                </div>
                @endif
              </div>
          </div>
          <div class="form-group row">
            <label for="category_id" class="col-sm-2 col-form-label">Categoria</label>
            <div class="col-sm-10">
              <select id="category_id" class="form-control @if ($errors->has('category_id')) is-invalid @endif" id="category_id"  name="category_id">   
                <option>---Seleccione Categoria---</option>
                @foreach ($categories as $category)
                  <option value="{{$category->id}}" @if ($category->id == old('category_id')) selected @endif >{{$category->name}}</option>
                @endforeach
              </select>
              @if ($errors->has('category_id'))
              <div class="invalid-feedback">
                <p>{{$errors->first('category_id')}}</p>
              </div>
              @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
                <textarea   name="description" class="form-control @if ($errors->has('description')) is-invalid @endif" id="description" rows="3">
                  {{old('description')}}
                </textarea>
                @if ($errors->has('description'))
                <div class="invalid-feedback">
                  <p>{{$errors->first('description')}}</p>
                </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label">Precio</label>
            <div class="col-sm-10">
                <input type="number" 
                       class="form-control @if ($errors->has('price')) is-invalid @endif"
                      id="price" name="price" value="{{old('price')}}"
                      placeholder="1.0" step="0.01" min="0" >
                @if ($errors->has('price'))
                    <div class="invalid-feedback">
                      <p>{{$errors->first('price')}}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
          <label for="cost" class="col-sm-2 col-form-label">Costo</label>
          <div class="col-sm-10">
              <input type="number" 
                     class="form-control @if ($errors->has('cost')) is-invalid @endif"
                    id="cost" name="cost" value="{{old('cost')}}"
                    placeholder="1.0" step="0.01" min="0" >
              @if ($errors->has('cost'))
                  <div class="invalid-feedback">
                    <p>{{$errors->first('cost')}}</p>
                  </div>
              @endif
          </div>
        </div>
        <div class="form-group row">
          <label for="stock" class="col-sm-2 col-form-label">Existencia</label>
          <div class="col-sm-10">
              <input type="number" 
                     class="form-control @if ($errors->has('stock')) is-invalid @endif"
                    id="stock" name="stock" value="{{old('stock')}}"
                    placeholder="1" step="1" min="1" >
              @if ($errors->has('stock'))
                  <div class="invalid-feedback">
                    <p>{{$errors->first('stock')}}</p>
                  </div>
              @endif
          </div>
        </div>     
          <div class="form-group row text-center">
              <div class="col-sm-10">
                  <button type="submit" title="Guardar" class="btn btn-info"><i class="fa fa-save"></i></button>
                  <a href="{{ route('products.index') }}"
                  class="btn btn-danger" title="Volver ">
                      <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                  </a>
              </div>
            </div>
      </form>
      </div>
    </div>

{{--     @if ($errors->any())
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    </ul>
    @endif --}}

    
@endsection