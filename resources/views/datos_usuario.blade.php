@extends('layouts.app')
@section('content')
      {{-- BUSCADOR --}}
      <div class="navbar navbar-light bg-light">
      <form method="GET" class="form-inline" action="{{route('see_Searched_Users')}}">
            <div class="input-group input-group-lg">
                  <input type="search" class="form-control mr-sm-2" name="search" placeholder="Nombre Usuario">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search-plus fa-lg"></i></button>
            </div>
      </form>
      </div>
      <div class="card">
      <div class="card-header"> <b> {{"Datos de usuario"}} </b></div>
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
                              <td><img src="{{asset('./imagenes/user.png')}}" class="img-fluid" alt="Responsive image" width="60" height="70">
                              </td>      
                              @else
                              <td><img src="{{'https://fileapp.quokasoft.com/get/'.$usuario->photo}}" class="img-fluid" style="border-radius: 50%" alt="Responsive image" width="60" height="70">
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
                                    <a href="{{route('edit_Users',$usuario->id)}}"><button type="button" class="btn btn-warning"><i class="fas fa-cogs "></i></button></a>
                                    <a href="{{route('disable_User',$usuario->id)}}"><button type="button" class="btn btn-danger" onclick="return confirm('Seguro que quiere eliminar este usuario?')"><i class="fas fa-trash-alt "></i></button></a>
                                    @endif
                                    <a href="{{route('show_pets',$usuario->id)}}"><button type="button" class="btn btn-success ">{{"mascotas "}}<i class="fas fa-paw"></i></button></a>
                              </td>   
                                          
                        </tr>
                        @endforeach
                  </tbody>
            </table>
      </div>
<div class="table table-striped">{{$usuarios->links()}}</div>

@endsection
