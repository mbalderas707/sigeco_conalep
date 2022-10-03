@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Edita un documento:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('documents.update', ['document' => $document->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Folio:</label>
                    <input  class="form-control" type="text" name="folio"
                        value="{{ old('folio') ?? $document->folio }}" required>
                </div>
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Asunto:</label>
                    <input  class="form-control" type="text" name="subject"
                        value="{{ old('subject') ?? $document->subject }}" required>
                </div>
                <div class="form-row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') ?? $document->description }}</textarea>
                </div>

                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Fecha de documento:</label>
                    <input  class="form-control" type="date" name="document_date"
                        value="{{ old('document_date') ?? $document->document_date->format('Y-m-d') }}" required>

                </div>

                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Fecha de recibido:</label>
                    <input class="form-control" type="datetime-local" name="received_since"
                        value="{{ old('received_since') ?? $document->received_since->format('Y-m-d\TH:i') }}" required>

                    </span>
                </div>

                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Etiquetas:</label>
                    <select class="form-control select2-multiple" style="width: 100%" name="tags[]" multiple="multiple"
                        id="select2Multiple">
                        @foreach ($tags as $tag)
                            <option
                                {{ (collect(old('tags'))->contains($tag->id) ? 'selected' : $document->tags->contains($tag->id)) ? 'selected' : '' }}
                                value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Remitentes:</label>
                    <select class="form-control select2-multiple" style="width: 100%" name="senders[]" multiple="multiple"
                        id="select2Multiple2" required>
                        @foreach ($companies as $company)
                            <optgroup label="{{ $company->name }}">
                                @foreach ($company->senders as $sender)
                                    <option
                                        {{ (collect(old('senders'))->contains($sender->id) ? 'selected' : $document->senders->contains($sender->id)) ? 'selected' : '' }}
                                        value="{{ $sender->id }}">{{ $sender->name }} - {{ $sender->position }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <label
                        class="col-md-4 col-form-label text-md-right">{{ __('Documento escaneado y anexos:') }}</label>
                    <div class="custom-file">
                        <input class="form-control" id="formFileMultiple" type="file" accept=".pdf"
                            name="pdfs[]" multiple />
                    </div>
                </div>

                <div class="form-row m-3">

                    <button type="submit" class="btn btn-primary btn-lg">Editar Documento</button>
                </div>
            </form>
            <div class="form-row">
                <label class="col-md-4 col-form-label text-md-right">Archivos adjuntos actuales:</label>
                @foreach ($document->files as $file)
                    <p class="d-inline-block m-1">{{ $file->name }}</p>
                    <form class="d-inline-block m-1" method="POST"
                        action="{{ route('files.destroy', ['file' => $file->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button
                            onclick="return confirm('¿Seguro que deseas eliminar el archivo {{ $file->name }}?')"
                            type="submit" class="btn-close"></button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                placeholder: "Selecciona las etiquetas...",
                allowClear: true
            });

        });
    </script>
@endsection
