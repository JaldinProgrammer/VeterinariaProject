@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ "Inicio de: ".Auth::user()->name}}</div>
                        @php
                            $rol = "veterinario";
                            if(Auth::user()->customer){
                                $rol = "cliente";
                            }
                            if(Auth::user()->admin){
                                $rol = "Administrador";
                            }
                        @endphp
                    <div class="card-body">
                        
                        <ul class="list-group list-group-flush">
                            @if(Auth::user()->photo)
                            <li class="list-group-item"><img src="{{ asset(Auth::user()->photo)}}" class="img-fluid" alt="Responsive image" width="40" height="50"></li>
                            @else
                            <li class="list-group-item"><img src="{{ asset('storage/Images/ImagenUsuarioDefault.jpg')}}" class="img-fluid" alt="Responsive image" width="60" height="70"></li>
                            @endif  
                            <li class="list-group-item">{{"Telefono: ".Auth::user()->phone}}</li>
                            <li class="list-group-item">{{"Email: ".Auth::user()->email}}</li>
                            <li class="list-group-item">{{"Rol: ". $rol}}</li>
                            <li class="list-group-item"><a href="{{route('see_reservations',Auth::user()->id)}}"><button type="button" class="btn btn-primary">Ver mis reservas</button></a></li>
                            <li class="list-group-item"><a href="{{route('see_notifications',Auth::user()->id)}}"><button type="button" class="btn btn-success">Ver mis notificaciones</button></a></li>
                            <li class="list-group-item"><a href="{{ route('show_pets',Auth::user()->id)}}" class="btn btn-info">Mis mascotas</a></li>
                        </ul>
                    </div>
                </div>           
            </div> 
        </div>
    </div>
</div>
      

@if((isset($reservations)))

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ "Reservaciones proximas"}}</div>
<div class="card-body">
    <table class="table table-striped">
        <thead>
            <th>Fecha</th>
            <th>Espera en</th>
            <th>Descripcion</th>
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
                <td>{{$reservation->pet->nombre}}</td>
                <td>{{($reservation->user->veterinarian)? "vet. ".$reservation->user->name : "cliente. ".$reservation->user->name}}</td>
                <td>{{$reservation->period->begin->toTimeString()." - ".$reservation->period->end->toTimeString()}}</td>
                <td>{{$reservation->service->name}}</td>
                <td>
                <a href="{{route('inactive_reservation',$reservation->id)}}"><button type="button" class="btn btn-danger" onclick="return confirm('Seguro que quiere desactivar su reserva? no podra recuperarla')">Borrar</button></a>                   
                </td>
            </tr> 
            @endforeach
        </tbody>
    </table>
</div> 
@endif
    </div>
    </div> 
</div>
</div>
</div>

@if((isset($notifications)))

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ "Notificaciones proximas"}}</div>
<div class="card-body">
    <table class="table table-striped">
        <thead>
            <th>Aviso</th>
            <th>Mascota</th>
            <th>Fecha</th>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
            <tr>
                <td>{{$notification->message}}</td>
                <td>{{$notification->treatment->pet->nombre}}</td>
                <td>{{$notification->eventDate->toFormattedDateString()}}</td>
            </tr> 
            @endforeach
        </tbody>
    </table>
</div> 
@endif
    </div>
    </div> 
</div>
</div>
</div>
@endsection
