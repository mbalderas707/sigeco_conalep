@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Documentos</h1>
            </div>
            <div class="col">
                <form method="GET" action="{{ route('documents.index') }}">
                    <div class="input-group justify-content-end mb-3">
                        <div class="form-outline">
                            <input type="search" class="form-control" name="searchTerm" />
                            <label class="form-label">Buscar</label>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-primary btn-rounded btn-lg" href="{{ route('documents.create') }}">Crear documento</a>

            </div>
            <div class="col">
                <div class="input-group justify-content-end">

                    <form method="GET" action="{{ route('documents.index') }}">
                        <div class="input-group justify-content-end">

                            <label class="col-form-label me-3">Remitentes:</label>
                            <select class="form-control select2-multiple" name="senders[]" multiple="multiple"
                                id="select2Multiple">
                                @foreach ($companies as $company)
                                    <optgroup label="{{ $company->name }}">
                                        @foreach ($company->senders as $sender)
                                            <option {{ collect(old('senders'))->contains($sender->id) ? 'selected' : '' }}
                                                value="{{ $sender->id }}">{{ $sender->name }} - {{ $sender->position }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>

                            <label class="col-form-label ms-3 me-3">Status:</label>
                            <select class="form-control select2-multiple" name="statoos[]" multiple="multiple"
                                id="select2Multiple2">
                                @foreach ($statoos as $status)
                                    <option {{ collect(old('statoos'))->contains($status->id) ? 'selected' : '' }}
                                        value="{{ $status->id }}">{{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="ms-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>



            @if (count($documents) == 0)
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
                                <th>Remitente(s)</th>
                                <th>Etiqueta(s)</th>
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
                                        @foreach ($document->senders as $sender)
                                            <p>{{ $sender->name }}-{{ $sender->company->acronym }}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($document->tags as $tag)
                                            <a class="btn d-inline-block m-1" style="background-color: {{ $tag->color }}"
                                                href="?tag={{ $tag->id }}">{{ $tag->name }}</a>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                            href="{{ route('documents.show', ['document' => $document->id]) }}">
                                            Mostrar
                                        </a>
                                        <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                            href="{{ route('documents.edit', ['document' => $document->id]) }}">
                                            Editar
                                        </a>

                                        <form class="d-inline-block m-1" method="POST"
                                            action="{{ route('documents.destroy', ['document' => $document->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('¿Seguro que deseas eliminar el registro {{ $document->folio }}?')"
                                                type="submit" class="btn btn-rounded btn-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $documents->links() !!}
                </div>
            @endif
        </div>
    @endsection

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // Select2 Multiple


                $('.select2-multiple').select2({
                    placeholder: "Selecciona ...",
                    allowClear: true,
                });

            });
        </script>
    @endsection
