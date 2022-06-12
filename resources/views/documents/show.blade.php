@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Documentos</h1>
        @empty($document)
            <div class="alert alert-warning" role="alert">
                <p>No existe el documento.</p>
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
                            <th>Etiqueta(s)</th>
                            <th>Remitente(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $document->folio }}</td>
                            <td>{{ $document->subject }}</td>
                            <td>{{ $document->description }}</td>
                            <td>{{ $document->document_date->format('d-M-Y') }}</td>
                            <td>{{ $document->status->name }}</td>
                            <td>
                                @foreach ($document->tags as $tag)
                                    <p>{{ $tag->name }}</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($document->senders as $sender)
                                    <p>{{ $sender->name }}-{{ $sender->company->acronym }}</p>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endempty
    </div>
@endsection
