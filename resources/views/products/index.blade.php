@extends('layouts.main')
@section('contenido')
<div  class="container"><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    LISTADO DE PRODUCTOS
                    <a href="{{ route('products.name') }}" class="btn btn-success btn-sm float-right"> Nuevo Producto</a>
                </div>
                <div class="card-body">
                    @if(session('info'))
                    <div class="alert alert-success">{{session('info')}}</div>
                    @endif
                    <table class="table table-hover table-sm">
                        <thead>
                            <th>Descripcion</th>
                            <th>precio</th>
                            <th>Accion </th>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        {{$product->description}}
                                    </td>
                                    <td>
                                        {{$product->price}}
                                    </td>
                                    <td>
                                        <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning btn-sm">Editar</a>
                                        <a  href="javascript:document.getElementById('delete-{{$product->id}}').submit()" class="btn btn-danger btn-sm ">Eliminar</a>
                                <form id="delete-{{$product->id}}" action="{{route('products.destroy', $product->id)}}" method="POST">
                                @method('delete')
                                @csrf
                                </form></td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </thead>
                    </table>
                </div>
                <div class="card-footer">
                    Bienvenido {{ auth()->user()->name }}
                    <a href="javascript:document.getElementById('logout').submit()" class="btn btn-danger btn-sm float-right">Cerrar sesion</a>
                    <form action="{{route('logout')}}" id="logout" style="display:none" method="post">
                         @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection