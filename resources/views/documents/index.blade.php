@extends('layouts.app')

@section('content')
<div class="container">
        <h1>Documentos</h1>
        <a class="btn btn-primary btn-lg" href="{{ route('documents.create') }}">Crear documento</a>
        @if(count($documents)==0)
            <div class="alert alert-warning" role="alert">
                <p>No existen documentos para el pefil seleccionado.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Asunto</th>
                            <th>Descripción</th>
                            <th>Fecha del Documento</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ $document->folio }}</td>
                                <td>{{ $document->subject }}</td>
                                <td>{{ $document->description }}</td>
                                <td>{{ $document->document_date->format('d-M-Y') }}</td>
                                <td>{{ $document->status->name }}</td>
                                <td>
                                    <a class="btn btn-primary d-inline-block m-1"
                                        href="{{ route('documents.show', ['document' => $document->id]) }}">
                                        Mostrar
                                    </a>
                                    <a class="btn btn-primary d-inline-block m-1"
                                        href="{{ route('documents.edit', ['document' => $document->id]) }}">
                                        Editar
                                    </a>

                                    <form class="d-inline-block m-1" method="POST"
                                        action="{{ route('documents.destroy', ['document' => $document->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('¿Seguro que deseas eliminar el producto {{ $document->id }}?')"
                                            type="submit" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
