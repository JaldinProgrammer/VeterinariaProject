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
      {{-- BUSCADOR --}}
      <div class="navbar navbar-light bg-light">
      <form method="GET" class="form-inline" action="{{route('see_Searched_Pets')}}">
                <input type="search" class="form-control mr-sm-2" name="search" placeholder="Mascota">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search-plus fa-lg"></i></button>
      </form>
      </div>
<table class="table table-striped">
    <thead>
          <th>Nombre</th>
          <th>Dueño</th>
          <th>Nacimiento</th>
          <th>Defuncion</th>
          <th>Color</th>
          <th>Genero</th>
          <th>Especie</th>
          <th>Raza</th>
          <th>Foto</th>
          <th>Reservar</th>
          <th>opciones</th> 
          <th>vacunas</th>   
    </thead>
    <tbody>
          @foreach ($pets as $pet)
              <tr>
                    <td>{{$pet->nombre}}</td>
                    <td>{{$pet->user->name}}</td>
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
                        <a href="{{route('edit_pets',$pet->id)}}"><button type="button" class="btn btn-warning btn-sm btn-block"><i class="fas fa-cogs "></i></button></a>
                        
                        <a href="{{route('delete_pets',$pet->id)}}"><button type="button" class="btn btn-danger btn-sm btn-block"  onclick="return confirm('Seguro que quiere eliminar esta mascota?')"><i class="fas fa-trash-alt "></i></button></a>

                        <a href="{{route('show_treatment',$pet->id)}}"><button type="button" class="btn btn-success btn-sm btn-block"><i class="fas fa-clinic-medical "></i></button></a>                       
                    </td>
                    <td>
                    <a href="{{route('vaccines',$pet->id)}}"><button type="button" class="btn "><img src="{{asset('./IconsWeb/vaccine.png')}}" alt="leon" width="35" height="35"></button></a>      
                    </td>
              </tr>
          @endforeach
    </tbody>
</table>
</div>
@endsection
