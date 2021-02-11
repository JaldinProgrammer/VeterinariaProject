@extends('layouts.app')
@section('content')
<h2> {{"Mascotas de : ". $usuario->name}}</h2>

@if ($errors->count() > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
@if(Auth::user()->admin == 1)
<br>
<a href="{{route('registrar_pets',$usuario->id)}}" class="btn btn-info">Registrar nueva mascota</a>
<br>
@endif
<table class="table table-striped">
    <thead>
          <th>Nombre</th>
          <th>Fecha de nacimiento</th>
           <th>fecha de defuncion</th>
          <th>Color</th>
          <th>Genero</th>
          <th>Especie</th>
          <th>Raza</th>
          <th>Foto</th>
          <th>Reservaciones</th>
          @if(Auth::user()->veterinarian == 1)
          <th>opciones</th>
          @endif
          
    </thead>
    <tbody>
          @foreach ($pets as $pet)
              <tr>
                    <td>{{$pet->nombre}}</td>
                    <td>{{($pet->birthdate)?$pet->birthdate->toFormattedDateString(): "-"}}</td>
                    <td>{{($pet->deathdate)?$pet->deathdate->toFormattedDateString(): "-"}}</td>                    
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
                          
                    <td>              
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Reservar
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <div class="card-body">
                                <form method="POST" action="{{route('show_periods', $pet->id)}}">
                                    @csrf
                                <div class="form-group row">
                                    <label for="date" class="col-md-4 col-form-label text-md-right">Fecha de reserva</label>
                                    <div class="col-md-6">
                                        <input id="date" type="date"  class="form-control @error('date') is-invalid @enderror" name="date" >
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Buscar') }}
                                    </button>
                                </div>
                                </form>
                            </div>
                            </div>
                    </td>
                    <td>
                    @if(Auth::user()->veterinarian == 1) 
                    
                        @if(Auth::user()->admin == 1) 
                        <a href="{{route('edit_pets',$pet->id)}}"><button type="button" class="btn btn-warning">Editar</button></a>        
                        <a href="{{route('delete_pets',$pet->id)}}"><button type="button" class="btn btn-danger"  onclick="return confirm('Seguro que quiere eliminar esta mascota?')">Borrar</button></a>        
                        @endif
                        <a href="{{route('show_treatment',$pet->id)}}"><button type="button" class="btn btn-success">Historial clinico</button></a>        
                    @else
                    <a href="{{route('vaccines',$pet->id)}}"><button type="button" class="btn btn-success">Vacunas</button></a>                           
                    @endif
                    </td>
              </tr>
          @endforeach
    </tbody>
</table>
</div>
@endsection
