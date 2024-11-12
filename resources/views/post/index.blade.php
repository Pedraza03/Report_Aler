@extends('layouts.app')

@section('template_title')
    Posts
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Registros') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear un Nuevo Reporte') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-dark">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Titulo</th>
                                        <th>Contenido</th>
                                        <th>Nombre del Lugar</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $post->titulo }}</td>
                                            <td>{{ $post->contenido }}</td>
                                            <td>{{$post->nombre_lugar }}</td>
                                            <td>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('posts.show', $post->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('posts.edit', $post->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">
                                                        <i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $posts->withQueryString()->links() !!}
            </div>
        </div>
    </div>

     <!-- Contenedor del mapa -->
     <div id="map" style="height: 500px; margin-top: 20px;"></div>

<!-- Scripts de Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicializar el mapa
        var map = L.map('map').setView([4.3333, -74.3667], 13); // Coordenadas iniciales de Fusagasugá

        // Cargar el mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Agregar los marcadores de cada post al mapa
        @foreach ($posts as $post)
            // Verificar si la latitud y longitud existen antes de agregar el marcador
            @if ($post->latitud && $post->longitud)
                L.marker([{{ $post->latitud }}, {{ $post->longitud }}]).addTo(map)
                    .bindPopup('<strong>{{ $post->nombre_lugar }}</strong>') // Solo mostrar el nombre del lugar
                    .openPopup();
            @endif
        @endforeach
    });
</script>
@endsection
