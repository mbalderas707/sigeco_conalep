@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Instrucciones</h1>
        <a class="btn btn-primary btn-rounded btn-lg" href="{{ route('instructions.create') }}">Crear nueva</a>
        @if (count($instructions) == 0)
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
                        @foreach ($instructions as $instruction)
                            <tr>
                                <td>{{ $instruction->name }}</td>
                                <td>{{ $instruction->description }}</td>
                                <td>

                                    <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                        href="{{ route('instructions.edit', ['instruction' => $instruction->id]) }}">
                                        Editar
                                    </a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $instructions->links() !!}
            </div>
        @endif
    </div>
@endsection
