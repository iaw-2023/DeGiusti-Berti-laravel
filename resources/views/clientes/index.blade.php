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
            <!--<ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Page</a>
                </li>
            </ul>-->
        </div>
    </div>
</nav>

<h2>Selecciona el email de un cliente para ver sus estadisticas</h2>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Email</th>
        <th scope="col">Cantidad de pedidos</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente) <!-- Misma complejidad -> O(2n) = O(n) -->
            <tr>
                <th scope="row">{{$cliente->id}}</th>
                <td><a href="{{ route('clientes.show', ['cliente' => $cliente->email]) }}">{{$cliente->email}}</a></td>
                <td>{{$counts[$cliente->email]}}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection

@section('scripts')
<script>cambiar('clientes');</script>
@endsection
