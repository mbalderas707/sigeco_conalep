@extends('layouts.app')

@section('content')
    <div class="container">
        @empty($turn)
            <h1>Turno:</h1>
            <div class="alert alert-warning" role="alert">
                <p>No existe el Turno.</p>
            </div>
        @else
            <div class="row">
                <div class="col">
                    <h1>Folio: {{ $turn->document->folio }}</h1>
                </div>

            </div>
            <div class="row bg-light rounded border mb-3">
                <div class="col">
                    <p><b>Fecha documento: </b> {{ $turn->document->document_date->format('d/M/Y') }}</p>
                    <p><b>Fecha recepción: </b>{{ $turn->document->received_since->format('d/M/Y h:i a') }}</p>
                    <p><b>Capturado por: </b>{{ $turn->document->user->name }}
                        {{ $turn->document->created_at->diffForHumans() }}</p>
                </div>
                <div class="col">
                    <h6>Remitente(s):</h6>
                    <ul>
                        @foreach ($turn->document->senders as $sender)
                            <li>{{ $sender->name }} - {{ $sender->position }}/{{ $sender->company->acronym }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col">
                    <h6>Archivo(s):</h6>
                    <div class="list-group  mb-3">
                        @foreach ($turn->document->files as $file)
                            <a class="list-group-item list-group-item-action list-group-item-dark px-3 border-0"
                                href="{{ asset("pdfs/{$file->path}") }}" target="_blank">{{ $file->name }}</a>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="row bg-light rounded border mb-3">
                <div class="col-10">
                    <h6>Asunto:</h6>
                    <p> {{ $turn->document->subject }}</p>
                    <h6>Descripción:</h6>
                    <p>{{ $turn->document->description }}</p>


                </div>


            </div>
            <div class="row bg-light rounded border mb-3">

                <div class="col-3">
                    <h6>Turnado a:</h6>
                    <ul class="list-group mb-3">
                        @foreach ($turn->profiles as $profile)
                            <li class="list-group-item">{{ $profile->profilable->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6">
                    <h6>Instrucción:</h6>
                    <p>{{ $turn->instruction->name }} - {{ $turn->instruction->description }}</p>
                    <h6>Instrucciones adicionales:</h6>
                    <p>{{ $turn->additional_instructions }}</p>
                </div>
                <div class="col-3">
                    <p><b>Fecha de turno: </b>{{ $turn->created_at->format('d/M/Y h:i a') }}</p>
                    <p><b>Vencimiento: </b> {{ $turn->expiration->diffForHumans() }} </p>
                </div>
            </div>



            <div class="card">
                <div class="card-body">

                    @include('turns.commentsDisplay', ['comments' => $turn->comments, 'turn_id' => $turn->id])

                    <form method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Añadir comentario:" name="text" id="floatingTextarea">{{ old('text') }}</textarea>
                                <label for="floatingTextarea">Añadir comentario:</label>
                            </div>
                            <input type="hidden" name="turn_id" value="{{ $turn->id }}" />

                            <label class="col-md-4 col-form-label text-md-right">{{ __('Agregar archivo:') }}</label>
                            <div class="custom-file">
                                <input class="form-control" id="formFileMultiple" type="file" accept=".pdf"
                                    name="pdf" />
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-success" value="Comentar" />
                        </div>
                    </form>
                </div>
            </div>
        @endempty
    </div>
@endsection
