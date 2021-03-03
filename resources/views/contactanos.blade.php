@extends('layouts.app')
@section('content')
.<div class="container">
      <h1><b>Contactanos</b></h1>
      .<div class="row">
            
            <div class="col-6">
                 <div class="card" style="width: 20rem;">
                        <img class="card-img-top" src="{{asset('ImagesWeb/tania.png')}}" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">Veterinaria Tania Alvarez Peña </h5>
                        <p class="card-text">Nos ubicamos cerca del hospital Japones, en la calle diego guerra N# 3495; Estamos ansiosos de brindarle nuestros servicios 
                              <br>Llame al:  +591 76041031
                        </p>
                        </div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item">Atendemos 24 hrs por el canal de emergencia. La atencion regular es de 7:00 am - 11:00pm</li>
                        </ul>
                        <div class="card-body">
                              <a href="https://www.facebook.com/tania.alvarezpena" class="card-link"><i class="fab fa-facebook-square fa-lg"></i></a>
                              <a href="#" class="card-link"><i class="fab fa-whatsapp-square fa-lg"></i></a>
                              <a href="#" class="card-link"><i class="fas fa-envelope-open-text fa-lg"></i></a>
                        </div>
                  </div>      
            </div>
            <div class="col-6">
                  <img src="{{asset('ImagesWeb/location.png')}}" alt="evita cargarlo" class="card-img-top" alt="Responsive image" >           
            </div>
      </div>
      <br>
      <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3799.3929993708916!2d-63.14982611726079!3d-17.77321775664107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93f1e883d417a7a5%3A0xc42d06380372a165!2sCalle%20Diego%20Guerra%203495%2C%20Santa%20Cruz%20de%20la%20Sierra!5e0!3m2!1ses!2sbo!4v1614753122897!5m2!1ses!2sbo" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
</div>
@endsection
