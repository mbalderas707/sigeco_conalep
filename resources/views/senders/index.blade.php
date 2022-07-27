@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Remitentes</h1>
        <a class="btn btn-primary btn-rounded btn-lg" href="{{ route('senders.create') }}">Crear nuevo</a>
        @if (count($senders) == 0)
            <div class="alert alert-warning" role="alert">
                <p>No existen registros en el catálogo.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Compañia/Dependencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($senders as $sender)
                            <tr>
                                <td>{{ $sender->name }}</td>
                                <td>{{ $sender->position }}</td>
                                <td>{{ $sender->company->name }}</td>
                                <td>

                                    <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                        href="{{ route('senders.edit', ['sender' => $sender->id]) }}">
                                        Editar
                                    </a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $senders->links() !!}
            </div>
        @endif
    </div>
@endsection
