@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro visita') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('create_visit') }}" >
                        @csrf
                        {{-- description --}}
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
                            {{-- fecha --}}
                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de la visita') }}</label>
                                <div class="col-md-6">
                                    <input id="date" type="date"  class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Hora --}}
                            <div class="form-group row">
                                <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>
                                <div class="col-md-6">
                                    <input id="time" type="time"  class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}">
                                    @error('time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>     
                            {{-- servicio --}}
                            <div class="form-group row">
                                <label for="service_id" class="col-md-4 col-form-label text-md-right">{{ __('Servicio') }}</label>
                                <div class="col-md-6">
                                    <select name="service_id" id="service_id">
                                        <option value="">--selecciona el servicio--</option>
                                       @foreach ($services as $service)                                        
                                       <option value="{{$service->id}}">{{$service->name}}</option>                                    
                                       @endforeach 
                                    </select>
                                    @error('service_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                        <input type="hidden" name="treatment_id" value="{{$treatment->id}}">     
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">                                                 
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection