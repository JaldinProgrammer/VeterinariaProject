@extends('layouts.app')
@section('content')
<div class="container ">
  <div class="container">
    <H1 class="text-center">
      <b>Aprovecha nuestras ofertas</b>
    </H1>
  </div>
  <br>
  <div class="container-fluid " >
    @foreach ($bargains as $bargain)
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="card" style="width: 100%;">
              @if($bargain->photo == NULL)
              <img src="{{ asset('storage/Images/ImagenOferta.jpg')}}" class="img-fluid" alt="Responsive image" width="100%" height="100%">                  
              @else
              <img src="{{ asset($bargain->photo)}}" class="img-fluid" alt="Responsive image" >                
              @endif
              <div class="card-body">
                <h5 class="card-title"> <b> {{$bargain->title}} </b></h5>
                <p class="card-text">{{$bargain->body}}</p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">{{"Comienza: ".$bargain->start->toFormattedDateString()}}</li>
                <li class="list-group-item">{{"Expira: ".$bargain->expiration->toFormattedDateString()}}</li>
              </ul>
              <small class="card-text text-center" > <b>{{" nota:".$bargain->note}} </b></small>
            </div>
          </div>
      </div>  
      <br>
    @endforeach
  </div>
  <div class="table table-striped">{{$bargains->links()}}</div>
</div>
<footer class="foot"></footer>
@endsection