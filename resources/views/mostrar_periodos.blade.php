@extends('layouts.app')
@section('content')
<div>{{$pet->nombre}}</div>
@if ($dateUsed["error"])
<div class="alert alert-danger">
{{$dateUsed["error"]}}
</div>
@endif
<div class="card text-white bg-success  mb-6" style="max-width: 25rem;">
    <div class="card-header">Fecha de reservas</div>
<div class="card-body">
    <form method="POST" action="{{route('show_periods', $pet->id)}}">
        @csrf
    <div class="form-group row">
        <div class="col-md-6">
            <input id="date" type="date"  class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date')}}">
        </div>
    </div>
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Buscar') }}
        </button>
    </div>
</div>
</div>

<div class="card text-black ">
    <div class="card-header">{{'horarios disponibles en : '. $dateUsed["date"]->toFormattedDateString()}}</div>
<div class="card-body">
<table class="table table-striped">
    <thead>
          <th>Hora de inicio</th>
          <th>Hora fin</th>
          <th>reservar</th>
    </thead>
    <tbody>
        @foreach ($periods as $period)
           <tr>
               @if($dateUsed["date"]->toFormattedDateString() == $dateUsed["now"]->toFormattedDateString())
                    @if($period->begin >= $dateUsed["now"])
                    <td>{{$period->begin->toTimeString()}}</td>
                    <td>{{$period->end->toTimeString()}}</td>
                    <td>
                        <a href="{{route('register_reservation',['pet' => $pet->id , 
                        'period' => $period->id, 'date'=> $dateUsed["date"]])}}"><button type="button" class="btn btn-success">Elegir</button></a>
                    </td>
                    @endif
               @else
               <td>{{$period->begin->toTimeString()}}</td>
               <td>{{$period->end->toTimeString()}}</td>
               <td>
                   <a href="{{route('register_reservation',['pet' => $pet->id , 
                   'period' => $period->id, 'date'=> $dateUsed["date"]])}}"><button type="button" class="btn btn-success">Elegir</button></a>
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