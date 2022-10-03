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
                    <p><b>Capturado por: </b>{{ $document->user->name }} {{ $document->created_at->diffForHumans() }}</p>
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
                <div class="col-10">
                    <h6>Asunto:</h6>
                    <p> {{ $document->subject }}</p>
                    <h6>Descripción:</h6>
                    <p>{{ $document->description }}</p>
                    <h6>Etiqueta(s): </h6>
                    @foreach ($document->tags as $tag)
                        <a class="btn d-inline-block m-1" style="background-color: {{ $tag->color }}"
                            href="{{route('documents.index')}}?tag={{ $tag->id }}">{{ $tag->name }}</a>
                    @endforeach

                </div>
                <div class="col-2 align-self-center">
                    <a class="btn btn-success btn-rounded m-1"
                        href="{{ route('turns.create', ['document' => $document->id]) }}">
                        Turnar Documento
                    </a>

                </div>

            </div>
            @if ($document->turns->isEmpty())
                <div class="alert alert-warning" role="alert">
                    <p>No existen turnos para este documento.</p>
                </div>
            @else
                <h3 class="mt-3">Turnos:</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th>Turnado a </th>
                                <th>Instrucción</th>
                                <th>Fecha de turno</th>
                                <th>Vencimiento</th>
                                <th>Visto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($document->turns as $turn)
                                <tr>
                                    <td>
                                        <ul class="list-group">
                                        @foreach ($turn->profiles as $profile)
                                            <li class="list-group-item">{{ $profile->profilable->name }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $turn->instruction->name }}</td>
                                    <td>{{ $turn->created_at->format('d/M/Y h:i a') }}</td>
                                    <td>{{ $turn->expiration->diffForHumans() }}</td>
                                    <td>{{ $turn->seen_since ? $turn->seen_since->diffForHumans() : "No visto" }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                            href="{{ route('turns.show', ['turn' => $turn->id]) }}">
                                            Mostrar
                                        </a>
                                        <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                            href="{{ route('turns.edit', ['turn' => $turn->id]) }}">
                                            Editar
                                        </a>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endempty
    </div>
@endsection
