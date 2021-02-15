@extends('layout')
@section('title',"Categorias")
@section('content')
<div class="row row-cols-1 row-cols-md-2">
    <div class="col mb-4">
        <a href="{{route('products.index')}}">
            <div class="card">
                <img src="https://th.bing.com/th/id/R6acdf41b5577f8ea0b9ef3c1ee67643a?rik=ipVqBCh2F1gYhw&riu=http%3a%2f%2fwww.stonyelectrical.com%2fwp-content%2fuploads%2f2018%2f04%2fProduct_Icon.png&ehk=ZTHysmaMXbmWa2AdM4ismLU447aFvK1AAYZOTe0yO18%3d&risl=&pid=ImgRaw" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Productos</h5>
                  <p class="card-text">
                      Mantenimiento de Productos
                    </p>
                </div>
              </div>
        </a>
    </div>
    <div class="col mb-4">
        <a href="{{route('categories.index')}}">
      <div class="card">
        <img src="https://th.bing.com/th/id/R948a1c7aec1ba46cccc27fcfe4330cb3?rik=Nz1pfCDfdCNLLA&riu=http%3a%2f%2fwinsupply.co.uk%2fwp-content%2fuploads%2fcategory-management.jpg&ehk=dEzMk3CR7vX0gRBnsygBR5oQWC2XJcuxKIoHlyfFMbo%3d&risl=&pid=ImgRaw" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Categorias</h5>
          <p class="card-text">
            Mantenimiento de Categorias
        </p>
        </div>
      </div>
    </a>
    </div>
    <div class="col mb-4 hidden" hidden>
      <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
        </div>
      </div>
    </div>
    <div class="col mb-4 hidden" hidden>
      <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
      </div>
    </div>
  </div>
    
@endsection
{{-- s --}}
    