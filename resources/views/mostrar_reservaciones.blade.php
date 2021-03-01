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
        <form method="GET" class="form-inline" action="{{route('search_per_date')}}">
                <input type="date" class="form-control mr-sm-2" name="search" placeholder="Nombre Usuario">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search-plus fa-lg"></i></button>
        </form>
    </div>    

<table class="table table-striped">
    <thead>
          <th>Fecha</th>
          <th>Comienza en</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>mascota</th>
          <th>Reservado por</th>
          <th>periodo</th>
          <th>servicio</th>
    </thead>
    <tbody>
        @foreach ($reservations as $reservation)
           <tr>
                <td>{{$reservation->date->toFormattedDateString()}}</td>
                <td>{{\Carbon\Carbon::parse($reservation->date->toFormattedDateString().$reservation->period->begin->toTimeString())->diffForHumans()}}</td>
                <td>{{$reservation->description}}</td>
                <td>{{($reservation->active)? "activo":"inactivo"}}</td>
                <td>{{$reservation->pet->nombre}}</td>
                <td>{{($reservation->user->veterinarian)? "vet. ".$reservation->user->name : "cliente. ".$reservation->user->name}}</td>
                <td>{{$reservation->period->begin->toTimeString()." - ".$reservation->period->end->toTimeString()}}</td>
                <td>{{$reservation->service->name}}</td>
           </tr> 
        @endforeach
    </tbody>
</table>
<div class="table table-striped">{{$reservations->links()}}</div>

@endsection