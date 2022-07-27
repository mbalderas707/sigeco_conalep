@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Puestos</h1>
        <a class="btn btn-primary btn-rounded btn-lg" href="{{ route('positions.create') }}">Crear nuevo</a>
        @if (count($positions) == 0)
            <div class="alert alert-warning" role="alert">
                <p>No existen registros en el catálogo.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $position)
                            <tr>
                                <td>{{ $position->name }}</td>
                                <td>{{ $position->department->name }}</td>
                                <td>

                                    <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                        href="{{ route('positions.edit', ['position' => $position->id]) }}">
                                        Editar
                                    </a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $positions->links() !!}
            </div>
        @endif
    </div>
@endsection
