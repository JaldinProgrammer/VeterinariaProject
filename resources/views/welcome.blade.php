@extends('layouts.app')
@section('content')   
<div id="carouselExampleIndicators" class="carousel slide carrusel" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner ">
    <div class="carousel-item active">
      <img class="d-block w-100 " src="{{asset('ImagesWeb/cat.jpg')}}" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
            <h1>Misión</h1>
            <h3>Promover el bienestar de los animales a través de la excelencia en medicina veterinaria, estándares médicos, educación, y servicio sin precedentes para nuestros clientes y la comunidad, sin perder nunca de vista las necesidades cambiantes de nuestros pacientes y clientes.</h3>
      </div>   
      </div>
    <div class="carousel-item ">
      <img class="d-block w-100 " src="{{asset('ImagesWeb/paraba.jpg')}}" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
            <h1>Visión</h1>
            <h3>Ofrecer y realizar servicios veterinarios de gran calidad y alto nivel técnico y científico, dirigidos a nuestros clientes y a sus mascotas para satisfacer con excelencia sus necesidades.</h3>
      </div>   
    </div>
    <div class="carousel-item ">
      <img class="d-block w-100 " src="{{asset('ImagesWeb/dog.jpg')}}" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
            <h1>Veterinaria vida</h1>
            <h3> <i> "Los animales no son propiedades o cosas, sino organismos vivientes, sujetos de una vida, que merecen nuestra compasión, respeto, amistad y apoyo" (Marc Bekoff)</i></h3>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@endsection
