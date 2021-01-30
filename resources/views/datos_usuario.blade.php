@extends('layouts.app')
@section('content')
      <h3 class="display-3"> datos de usuario</h3>
      {{-- BUSCADOR --}}
      <form method="GET" class="form-inline ml-3" action="{{route('see_Searched_Users')}}">
            <div class="input-group input-group-sm">
                  <input type="search" class="form-control form-control-navbar" name="search" placeholder="Nombre Usuario">
                  <div class="input-group-append">
                        <button class="btn btn-dark" type="submit"> Buscar</button>
                  </div>
            </div>
      </form>
      <div class="card" >
      @if(Auth::user()->admin == 1)  
      <a href="{{route('register')}}" class="btn btn-info">Registrar nuevo usuario</a>
      <a href="{{route('see_Deleted_Users')}}" class="btn btn-warning">ver usuarios borrados</a>
      <a href="{{route('see_Customers')}}" class="btn btn-primary">ver clientes</a>
      @endif
      <table class="table table-striped">
            <thead>
                  <th>Nombre</th>
                  <th>Phone</th>
                  <th>E - mail</th>
                  <th>Foto</th>
                  <th>Rol</th>
                  <th>Opciones</th>
            </thead>
            <tbody>
                  @foreach ($usuarios as $usuario)
                      <tr>
                          
                            <td>{{$usuario->name}}</td>
                            <td>{{$usuario->phone}}</td>     
                            <td>{{$usuario->email}}</td>
                            @if($usuario->photo == NULL)
                            <td><img src="{{ asset('storage/Images/ImagenUsuarioDefault.jpg')}}" class="img-fluid" alt="Responsive image" width="60" height="70">
                            </td>      
                            @else
                            <td><img src="{{ asset($usuario->photo)}}" class="img-fluid" alt="Responsive image" width="60" height="70">
                            </td>
                            @endif
                             
                            @if ($usuario->veterinarian == 1 && $usuario->admin == 0) 
                            <td>Veterinario</td>
                            @endif
                            @if ($usuario->admin == 1) 
                            <td>Admin</td>
                            @endif
                            @if ($usuario->customer == 1) 
                            <td>Cliente</td>
                            @endif
                            <td>
                               @if(Auth::user()->admin == 1)   
                              <a href="{{route('edit_Users',$usuario->id)}}"><button type="button" class="btn btn-warning">Editar</button></a>
                              <a href="{{route('disable_User',$usuario->id)}}"><button type="button" class="btn btn-danger" onclick="return confirm('Seguro que quiere eliminar este usuario?')">Borrar</button></a>
                              @endif
                              <a href="{{route('show_pets',$usuario->id)}}"><button type="button" class="btn btn-outline-success btn-sm">Mascotas</button></a>
                            </td>   
                                      
                      </tr>
                  @endforeach
            </tbody>
      </table>
</div>
<div class="table table-striped">{{$usuarios->links()}}</div>

@endsection
