@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Etiquetas</h1>
        <a class="btn btn-primary btn-rounded btn-lg" href="{{ route('tags.create') }}">Crear nueva</a>
        @if (count($tags) == 0)
            <div class="alert alert-warning" role="alert">
                <p>No existen registros en el catálogo.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td> <a class="btn d-inline-block m-1" style="background-color: {{$tag->color}}" href="">{{ $tag->name }}</a></td>
                                <td>{{ $tag->description }}</td>
                                <td>

                                    <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                        href="{{ route('tags.edit', ['tag' => $tag->id]) }}">
                                        Editar
                                    </a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $tags->links() !!}
            </div>
        @endif
    </div>
@endsection
