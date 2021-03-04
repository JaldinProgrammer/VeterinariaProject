@extends('layouts.app')
@section('content')

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

    <div class="container">
        <div class="row">
            <a href="{{route('registrar_pets',$usuario->id)}}" class="btn btn-info btn-lg btn-block">Registrar nueva mascota</a>
        </div>
    </div>

@endif
<br>
<div class="card">
    <div class="card-header"> <b> {{ "Mascotas de : ". $usuario->name}} </b></div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-striped">
    <thead >
          <th>Nombre</th>
          <th>Nacimiento</th>
           <th>Defuncion</th>
          <th>Color</th>
          <th>Genero</th>
          <th>Especie</th>
          <th>Raza</th>
          <th>Foto</th>
          <th>Reservaciones</th>
          @if(Auth::user()->veterinarian == 1)
          <th>Opciones</th>
          @else
          <th>Vacunas</th>
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
                    <td><img src="{{asset('imagenes/ImagenMascotaDefault.png')}}" class="img-fluid" alt="Responsive image" width="60" height="70">
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
                    
                    @if(Auth::user()->veterinarian == 1) 
                    <td>
                        @if(Auth::user()->admin == 1)                       
                        <a href="{{route('edit_pets',$pet->id)}}"><button type="button" class="btn btn-warning">{{"configurar  "}} <i class="fas fa-cogs "></i></button></a>        
                        <a href="{{route('delete_pets',$pet->id)}}"><button type="button" class="btn btn-danger"  onclick="return confirm('Seguro que quiere eliminar esta mascota?')">{{"Borrar  "}}<i class="fas fa-trash-alt "></i></button></a>                             
                        @endif                  
                        <a href="{{route('show_treatment',$pet->id)}}"><button type="button" class="btn btn-success">{{"Historial  "}} <i class="fas fa-clinic-medical "></i></button></a>        
                    </td>
                    @else
                    <td>
                    <a href="{{route('vaccines',$pet->id)}}"><button type="button" class="btn "><img src="{{asset('./IconsWeb/vaccine.png')}}" alt="leon" width="35" height="35"></button></a>                           
                    </td>
                    @endif               
              </tr>
          @endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endsection
