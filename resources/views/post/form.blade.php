<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <!-- Campo de Título (Desplegable) -->
        <div class="form-group mb-2 mb20">
            <label for="titulo" class="form-label">{{ __('Título') }}</label>
            <select name="titulo" class="form-control @error('titulo') is-invalid @enderror" id="titulo">
                <option value="Reporte de Robo" {{ old('titulo', $post?->titulo) == 'Reporte de Robo' ? 'selected' : '' }}>{{ __('Reporte de Robo') }}</option>
                <option value="Accidente de Tráfico" {{ old('titulo', $post?->titulo) == 'Accidente de Tráfico' ? 'selected' : '' }}>{{ __('Accidente de Tráfico') }}</option>
                <option value="Fuga de Agua" {{ old('titulo', $post?->titulo) == 'Fuga de Agua' ? 'selected' : '' }}>{{ __('Fuga de Agua') }}</option>
                <option value="Incendio" {{ old('titulo', $post?->titulo) == 'Incendio' ? 'selected' : '' }}>{{ __('Incendio') }}</option>
            </select>
            {!! $errors->first('titulo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Campo de Contenido -->
        <div class="form-group mb-2 mb20">
            <label for="contenido" class="form-label">{{ __('Contenido') }}</label>
            <input type="text" name="contenido" class="form-control @error('contenido') is-invalid @enderror" value="{{ old('contenido', $post?->contenido) }}" id="contenido" placeholder="Contenido">
            {!! $errors->first('contenido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Campo de Nombre del Lugar -->
        <div class="form-group mb-2 mb20">
            <label for="nombre_lugar" class="form-label">{{ __('Nombre del Lugar') }}</label>
            <input type="text" name="nombre_lugar" class="form-control @error('nombre_lugar') is-invalid @enderror" value="{{ old('nombre_lugar', $post?->nombre_lugar) }}" id="nombre_lugar" placeholder="Escribe el nombre del lugar">
            {!! $errors->first('nombre_lugar', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <!-- Campos de Latitud y Longitud (Ocultos y gestionados por el mapa) -->
        <div class="form-group mb-2 mb20">
            <input type="hidden" name="latitud" id="latitud" value="{{ old('latitud', $post?->latitud) }}">
            <input type="hidden" name="longitud" id="longitud" value="{{ old('longitud', $post?->longitud) }}">
        </div>

    </div>

    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>

<!-- Contenedor del Mapa -->
<div id="map" style="height: 500px; margin-top: 20px;"></div>

<!-- Scripts de Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
    // Variables globales para guardar la latitud, longitud y nombre del lugar
    var selectedLat;
    var selectedLng;

    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([4.3333, -74.3667], 13); // Coordenadas iniciales

        // Cargar el mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Evento al hacer clic en el mapa
        map.on('click', function(e) {
            selectedLat = e.latlng.lat;
            selectedLng = e.latlng.lng;
            var nombreLugar = document.getElementById('nombre_lugar').value || 'Ubicación sin nombre';

            // Establecer los valores de latitud y longitud en los campos ocultos
            document.getElementById('latitud').value = selectedLat;
            document.getElementById('longitud').value = selectedLng;

            // Crear un popup en la posición seleccionada
            L.popup()
                .setLatLng(e.latlng)
                .setContent('Lugar: ' + nombreLugar + '<br>Latitud: ' + selectedLat.toFixed(5) + '<br>Longitud: ' + selectedLng.toFixed(5))
                .openOn(map);
        });
    });
</script>
