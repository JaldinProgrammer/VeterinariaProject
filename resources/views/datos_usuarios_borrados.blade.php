@extends('layouts.app')
@section('content')

      <div class="card" >
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
                              <a href="{{route('edit_Users',$usuario->id)}}"><button type="button" class="btn btn-warning"><i class="fas fa-cogs "></i></button></a>
                              <a href="{{route('able_User',$usuario->id)}}"><button type="button" class="btn btn-success" onclick="return confirm('Seguro que quiere restaurar este usuario?')">Restaurar<img src="{{asset('./IconsWeb/reset.png')}}" alt="reset" width="20" height="20"></button></a>
                            </td>                                     
                      </tr>
                  @endforeach
            </tbody>
      </table>
</div>
<div class="table table-striped">{{$usuarios->links()}}</div>

@endsection
