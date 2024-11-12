@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Post
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Post</span>
                    </div>
                    <div class="card-body bg-dark">
                        <form method="POST" action="{{ route('posts.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('post.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenedor del mapa -->
<div id="map" style="height: 500px; margin-top: 20px;"></div>

<!-- Scripts de Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
    // Variables globales para guardar la latitud y la longitud
    var selectedLat;
    var selectedLng;

    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar el mapa
        var map = L.map('map').setView([4.3333, -74.3667], 13); // Coordenadas iniciales de Fusagasugá

        // Cargar el mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Evento para mostrar latitud y longitud al hacer clic en el mapa
        map.on('click', function(e) {
            selectedLat = e.latlng.lat; // Guardar la latitud en la variable global
            selectedLng = e.latlng.lng; // Guardar la longitud en la variable global
            
            // Crear un popup en la posición seleccionada
            L.popup()
                .setLatLng(e.latlng)
                .setContent('Latitud: ' + selectedLat.toFixed(5) + '<br>Longitud: ' + selectedLng.toFixed(5))
                .openOn(map);

            // Mostrar en la consola para verificar (puedes eliminar esta línea después)
            console.log('Latitud:', selectedLat, 'Longitud:', selectedLng);
        });
    });
</script>


@endsection
