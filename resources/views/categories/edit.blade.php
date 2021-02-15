@extends('layout')
@section('title',"Editar Categoria")
@section('content')
    <div class="card">
      <div class="card-header">
        <h2>Editar Categoria</h2>
      </div>
      <div class="card-body">
        <form action="{{ route('categories.update',$category) }}" method="POST" class="">
          {{ method_field('PUT') }}
          {{ csrf_field() }}
          <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Nombre</label>
              <div class="col-sm-10">
                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" id="name" name="name" value="{{old('name',$category->name)}}">
                @if ($errors->has('name'))
                <div class="invalid-feedback">
                  <p>{{$errors->first('name')}}</p>
                </div>
                @endif
              </div>
          </div>
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

@endsection