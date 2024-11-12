@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-center mb-4">
                <h1 class="display-4 text-primary">{{ __('Alerta +') }}</h1>
                <h1 class="display-4 text-primary">{{ __('Reportes de Alertas en Fusagasuga') }}</h1>
                <p class="text-muted">{{ __('Bienvenido a la página principal de reportes. Aquí podrás visualizar las alertas más recientes de Fusagasugá.') }}</p>
            </div>
            
            <div class="card mb-3 border-danger">
                <div class="card-body bg-dark">
                    <h5 class="card-title text-danger">{{ __('Robo en el centro de la ciudad') }}</h5>
                    <p class="card-text">{{ __('Reporte de un robo ocurrido en el centro, se recomienda precaución.') }}</p>
                    <span class="badge badge-danger" style="font-size: 1.25rem;">{{ __('Urgente') }}</span>
                </div>
            </div>
            
            <div class="card mb-3 border-warning">
                <div class="card-body bg-dark">
                    <h5 class="card-title text-warning">{{ __('Accidente de tráfico en la avenida principal') }}</h5>
                    <p class="card-text">{{ __('Accidente que involucra varios vehículos, tránsito lento en la zona.') }}</p>
                    <span class="badge badge-danger" style="font-size: 1.25rem;">{{ __('Moderado') }}</span>

                </div>
            </div>
            
            <div class="card mb-3 border-info">
                <div class="card-body bg-dark">
                    <h5 class="card-title text-info">{{ __('Fuga de agua en el barrio Norte') }}</h5>
                    <p class="card-text">{{ __('Fuga menor que está siendo atendida por la compañía de aguas.') }}</p>
                    <span class="badge badge-danger" style="font-size: 1.25rem;">{{ __('Bajo') }}</span>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
