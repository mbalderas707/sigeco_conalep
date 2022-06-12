@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Crea un documento:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('documents.store') }}">
                @csrf
                <div class="form-row">
                    <label>Folio:</label>
                    <input class="form-control" type="text" name="folio" value="{{ old('folio') }}"  />
                </div>
                <div class="form-row">
                    <label>Asunto:</label>
                    <input class="form-control" type="text" name="subject" value="{{ old('subject') }}" required />
                </div>
                <div class="form-row">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <label>Fecha de documento:</label>
                    <input class="form-control" type="date" name="document_date" value="{{ old('document_date') }}"
                        required>

                </div>

                <div class="form-row">
                    <label>Fecha de recibido:</label>
                    <input class="form-control" type="datetime-local" name="received_since"
                        value="{{ old('received_since') }}" required>

                    </span>
                </div>

                <div class="form-row">
                    <label>Etiquetas:</label>
                    <select class="form-control select2-multiple" name="tags[]" multiple="multiple" id="select2Multiple">
                        @foreach ($tags as $tag)
                            <option {{collect(old('tags'))->contains($tag->id)?'selected':''}} value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <label>Remitentes:</label>
                    <select class="form-control select2-multiple" name="senders[]" multiple="multiple" id="select2Multiple2" required>
                        @foreach ($companies as $company)
                            <optgroup label="{{ $company->name }}">
                                @foreach ($company->senders as $sender)
                                    <option {{collect(old('senders'))->contains($sender->id)?'selected':''}} value="{{ $sender->id }}">{{ $sender->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <div class="form-row m-3">
                    <button type="submit" class="btn btn-primary btn-lg">Crear Documento</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
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
