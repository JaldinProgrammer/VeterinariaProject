@extends('layouts.app')
@section('content')
<h2> {{"Mascotas de : ". $usuario->name}}</h2>
@if(Auth::user()->admin == 1)
<br>
<a href="{{route('registrar_pets',$usuario->id)}}" class="btn btn-info">Registrar nueva mascota</a>
<br>
@endif
<table class="table table-striped">
    <thead>
          <th>Nombre</th>
          <th>Fecha de nacimiento</th>
          <th>Color</th>
          <th>Genero</th>
          <th>Especie</th>
          <th>Raza</th>
          <th>Foto</th>
          @if(Auth::user()->veterinarian == 1)
          <th>opciones</th>
          @endif
          <th></th>
    </thead>
    <tbody>
          @foreach ($pets as $pet)
              <tr>
                    <td>{{$pet->nombre}}</td>
                    <td>{{$pet->birthdate}}</td>
                    <td>{{$pet->color}}</td>     
                    @if ($pet->gender == 1)
                    <td>Macho</td>
                    @else
                    <td>Hembra</td>
                    @endif
                    <td>{{$pet->breed->specie->name}}</td>
                    <td>{{$pet->breed->name}}</td>
                    @if($pet->photo == NULL)
                    <td><img src="{{ asset('storage/Images/ImagenMascotaDefault.jpg')}}" class="img-fluid" alt="Responsive image" width="60" height="70">
                    </td>      
                    @else
                    <td><img src="{{ asset($pet->photo)}}" class="img-fluid" alt="Responsive image" width="60" height="70">
                    </td>
                    @endif  
                              
                    @if(Auth::user()->veterinarian == 1) 
                    <td>
                        @if(Auth::user()->admin == 1) 
                        <a href="{{route('edit_pets',$pet->id)}}"><button type="button" class="btn btn-warning">Editar</button></a>        
                        <a href="{{route('delete_pets',$pet->id)}}"><button type="button" class="btn btn-danger"  onclick="return confirm('Seguro que quiere eliminar esta mascota?')">Borrar</button></a>        
                        @endif
                        <a href="{{route('show_treatment',$pet->id)}}"><button type="button" class="btn btn-success">Historial clinico</button></a>        
                    </td>
                    @endif
              </tr>
          @endforeach
    </tbody>
</table>
</div>
@endsection
