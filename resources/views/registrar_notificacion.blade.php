@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nueva notificacion') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('create_notification') }}" >
                        @csrf
                        {{-- mensaje --}}
                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Mensaje') }}</label>
                            <div class="col-md-6">
                                <input id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" >
                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            {{-- fecha  --}}
                            <div class="form-group row">
                                <label for="eventDate" class="col-md-4 col-form-label text-md-right">{{ __('Fecha del evento') }}</label>
                                <div class="col-md-6">
                                    <input id="eventDate" type="date"  class="form-control @error('eventDate') is-invalid @enderror" name="eventDate" value="{{ old('eventDate') }}">
    
                                    @error('eventDate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
 
                            <input type="hidden" name="treatment_id" value="{{$tratamiento->id}}">                           
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Publicar') }}
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