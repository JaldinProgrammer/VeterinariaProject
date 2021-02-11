@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de nueva reserva') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('create_reservation') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="service" class="col-md-4 col-form-label text-md-right">{{ __('Servicio') }}</label>
                            <div class="col-md-6">
                                <select name="service" id="service">
                                    <option value="">--selecciona el servicio--</option>
                                    @foreach ($services as $service)                    
                                        @if (Auth::user()->customer == 1)
                                            @if($service->reservable == 1)
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                            @endif
                                        @else
                                            <option value="{{$service->id}}">{{$service->name}}</option>
                                        @endif
                                    @endforeach 
                                </select>
                                @error('service')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="pet_id" value="{{$pet}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="period_id" value="{{$period}}">
                        <input type="hidden" name="date" value="{{$date}}">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection