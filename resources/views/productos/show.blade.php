@extends('app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top sticky-top">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span>Esconder</span>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <a href="/productos" class="btn btn-primary">Volver</a>
            </ul>
        </div>
    </div>
</nav>

<h2>Detalles del producto: {{$producto->nombre}}</h2>
        @error('nombre')
            <div class="alert alert-danger">El nombre no es correcto.</div>
        @enderror

        @error('precio')
            <div class="alert alert-danger">El precio no es correcto.</div>
        @enderror

        @error('descripcion')
            <div class="alert alert-danger">La descripción no es correcta.</div>
        @enderror

        @error('stock')
            <div class="alert alert-danger">El stock no es correcto.</div>
        @enderror

        @error('activo')
            <div class="alert alert-danger">La visibilidad no es correcta.</div>
        @enderror
        
        @error('estado')
            <div class="alert alert-danger">El estado no es correcto.</div>
        @enderror
        @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

<p><b>Creado</b>: {{$producto->created_at}}</p>
<p><b>Última modificación</b>: {{$producto->updated_at}}</p>

<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Visible</th>
        <th scope="col">Categoria</th>
        <th scope="col">Precio</th>
        <th scope="col">Stock</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Estado</th>
        
      </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{$producto->id}}</th>
            <td>{{$producto->nombre}}</td>
            <td>{{($producto->activo) == 0 ? "NO": "SI"}}</td>
            <td><a href="{{ route('categorias.show', ['categoria' => $producto->categoria->id]) }}">{{$producto->categoria->nombre}}</a></td>
            <td>${{$producto->precio}}</td>
            <td>{{$producto->stock}}</td>
            <td>{{$producto->descripcion}}</td>
            <td>{{$producto->estado}}</td>
        </tr>
    </tbody>
  </table>
  
  <div class="text-align-center">
    <img src="{{$producto->imagen}}" class="img-thumbnail" >
  </div>

  <br><p>Para editar este producto, rellene el siguiente formulario y luego, presione el botón "<b>Modificar producto</b>"<p>
<button id="botonFormulario" onClick="cambiarNombre('botonFormulario', 'Editar', 'Esconder')" type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#formulario">Editar</button>
<div id="formulario" class="collapse">
    <form  method="POST" action="{{route('productos.update',['producto' => $producto->id])}}">
        @method('PATCH')
        @csrf 

        <div class="mb-3 col">

        

            <label for="exampleFormControlInput1" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control mb-2" name="nombre" id="exampleFormControlInput1" value="{{$producto->nombre}}">

            <label for="exampleFormControlInput1" class="form-label">Precio</label>
            <input type="text" class="form-control mb-2" name="precio" id="exampleFormControlInput1" value="{{$producto->precio}}">
            
            <label for="exampleFormControlInput1" class="form-label">Visibilidad</label>
            <select id="inputState" class="form-control" name="activo">
                @if($producto->activo)
                  <option value="true" selected>Si</option>
                  <option value="false">No</option>
                @else
                  <option value="true">Si</option>
                  <option value="false" selected>No</option>
                @endif
              </select>
            
            <label for="exampleFormControlInput1" class="form-label">Stock</label>
            <input type="text" class="form-control mb-2" name="stock" id="exampleFormControlInput1" value="{{$producto->stock}}">
            
            
              <label for="exampleFormControlInput1" class="form-label">Descripción</label>
            <textarea rows="5" class="form-control mb-2" name="descripcion" id="exampleFormControlInput1">{{$producto->descripcion}}</textarea>

            <label for="exampleFormControlInput1" class="form-label">Estado</label>
            <input type="text" class="form-control mb-2" name="estado" id="exampleFormControlInput1" value="{{$producto->estado}}">

            <label for="exampleFormControlInput1" class="form-label">Imagen</label>
            <input type="text" class="form-control mb-2" name="imagen" id="exampleFormControlInput1" value="{{$producto->imagen}}">


            <label for="exampleFormControlInput1" name="labelcategoria" class="form-label">Categoria</label>

                <select id="inputState" class="form-control" name="categoria">
                 @foreach ($productos as $productoact)
                     <option value="{{ $productoact->categoria->id }}" {{ $productoact->categoria->nombre == $producto->categoria->nombre ? 'selected' : '' }}>
                     {{ $productoact->categoria->nombre }}
                    </option>
                @endforeach
                </select>


              <input type="submit" value="Modificar producto" class="btn btn-primary my-2" />
        </div>
    </form>

    <br><br>
    <form action="{{ route('productos.destroy', [$producto->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger btn-sm">Eliminar producto</button>
    </form>
    </div>



@endsection

@section('scripts')
<script>cambiar('productos');</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> <!-- Script para que se esconda el div del formulario -->
@endsection