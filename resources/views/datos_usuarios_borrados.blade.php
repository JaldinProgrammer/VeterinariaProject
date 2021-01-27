@extends('layouts.app')
@section('content')
      <h3 class="display-3"> datos de usuario</h3>
      <div class="card" >
      <a href="{{route('register')}}" class="btn btn-info">Registrar nuevo usuario</a>
      <a href="{{route('see_users')}}" class="btn btn-warning">ver lista de usuarios</a>

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
                              <a href="{{route('edit_Users',$usuario->id)}}"><button type="button" class="btn btn-warning">Editar</button></a>
                              <a href="{{route('able_User',$usuario->id)}}"><button type="button" class="btn btn-success" onclick="return confirm('Seguro que quiere restaurar este usuario?')">Restaurar</button></a>
                            </td>   
                                   
                      </tr>
                  @endforeach
            </tbody>
      </table>
</div>
<div class="table table-striped">{{$usuarios->links()}}</div>

@endsection
