@extends('layout')
@section('title',"Crear Categoria")
@section('content')

    <div class="card">
      <div class="card-header">
        <h2>Crear Categoria</h2>
      </div>
      <div class="card-body">
        <form action="{{ route('categories.store') }}" method="post" class="">
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
          {{ csrf_field() }}
      
          <div class="form-group row text-center">
              <div class="col-sm-10">
                  <button type="submit" title="Guardar" class="btn btn-info"><i class="fa fa-save"></i></button>
                  <a href="{{ route('categories.index') }}"
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