@extends('layouts.app')

@section('content')
    <div class="container">


        @empty($document)
            <h1>Documento</h1>
            <div class="alert alert-warning" role="alert">
                <p>No existe el documento.</p>
            </div>
        @else
            <div class="row">
                <div class="col">
                    <h1>Folio: {{ $document->folio }}</h1>
                </div>
                <div class="col">
                    <div class="text-center">

                        <h5 class="d-inline">Estado:</h2>

                            @foreach ($statuses as $status)
                                <input type="radio" name="status" class="btn-check" id="{{ $status->id }}" autocomplete="off"
                                    {{ $status->id == $document->status_id ? 'checked' : '' }} disabled>
                                <label class="btn btn-outline-primary" for="{{ $status->id }}">{{ $status->name }}</label>
                            @endforeach

                    </div>
                </div>
            </div>
            <div class="row bg-light rounded border mb-3">
                <div class="col">
                    <p><b>Fecha documento: </b> {{ $document->document_date->format('d/M/Y') }}</p>
                    <p><b>Fecha recepción: </b>{{ $document->received_since->format('d/M/Y h:i a') }}</p>
                </div>
                <div class="col">
                    <h6>Remitente(s):</h6>
                    <ul>
                        @foreach ($document->senders as $sender)
                            <li>{{ $sender->name }} - {{ $sender->position }}/{{ $sender->company->acronym }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col">
                    <h6>Archivo(s):</h6>
                    <div class="list-group  mb-3">
                        @foreach ($document->files as $file)
                            <a class="list-group-item list-group-item-action list-group-item-dark px-3 border-0"
                                href="{{ asset("pdfs/{$file->path}") }}" target="_blank">{{ $file->name }}</a>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="row bg-light rounded border">
                <div class="col">
                    <h6>Asunto:</h6>
                    <p> {{ $document->subject }}</p>
                    <h6>Descripción:</h6>
                    <p>{{ $document->description }}</p>
                    <h6>Etiqueta(s): </h6>
                    @foreach ($document->tags as $tag)
                        <a class="btn d-inline-block m-1" style="background-color: {{ $tag->color }}"
                            href="?tag={{ $tag->id }}">{{ $tag->name }}</a>
                    @endforeach

                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th>Asunto</th>
                            <th>Descripción</th>
                            <th>Fecha del Documento</th>


                            <th>Archivo(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td>{{ $document->subject }}</td>
                            <td>{{ $document->description }}</td>
                            <td>{{ $document->document_date->format('d-M-Y') }}</td>


                            <td>
                                <div class="list-group list-group-light">
                                    @foreach ($document->files as $file)
                                        <a class="list-group-item list-group-item-action px-3 border-0"
                                            href="{{ asset("pdfs/{$file->path}") }}" target="_blank">{{ $file->name }}</a>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endempty
    </div>
@endsection
