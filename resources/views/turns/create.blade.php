@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Turnado de documento:</h1>
        <div class="container bg-light rounded border mb-3">
            <div class="row">
                <div class="col">
                    <p><b>Folio:</b> {{ $document->folio }} </p>
                </div>
                <div class="col">
                    <p><b>Fecha documento:</b> {{ $document->document_date->format('d-M-Y') }}</p>
                </div>
                <div class="col">
                    <p><b>Fecha recepción:</b> {{ $document->received_since->format('d-M-Y h:i a') }}</p>
                </div>
            </div>
            <div class="row justify-content-start">
                <div class="col-1">
                    <p><b>Remitente(s):</b></p>
                </div>
                <div class="col-11">
                    <ul class="list-group list-group-horizontal">
                        @foreach ($document->senders as $sender)
                            <li class="list-group-item">{{ $sender->name }} - {{ $sender->position }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                <p><b>Asunto: </b>{{ $document->subject }}</p>
            </div>
        </div>

        <div class="form-group">
            <form method="POST" action="{{ route('turns.store') }}">
                @csrf
                <h6> Turnar a: </h6>
                <div class="row g-3">
                    @foreach ($departments as $department)
                        <div class="col-4">
                            <div class="row">
                                <div class="col-1">
                                    <input class="form-check-input" type="checkbox"
                                        id="inlineCheckbox{{ $department->profile->id }}" name=profiles[]
                                        value="{{ $department->profile->id }}"
                                        {{ collect(old('profiles'))->contains($department->profile->id) ? 'checked' : '' }} />
                                </div>
                                <div class="col-11">
                                    <label class="form-check-label"
                                        for="inlineCheckbox{{ $department->profile->id }}">{{ $department->name }}</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-row mb-3">
                    <label class="col-md-4 col-form-label text-md-right">Otros:</label>
                    <select class="form-control select2-multiple" style="width:100%" name="profiles[]" multiple="multiple"
                        id="select2Multiple2">
                        @foreach ($positions as $position)
                            <option value="{{ $position->profile->id }}"
                                {{ collect(old('profiles'))->contains($position->profile->id) ? 'selected' : '' }}>
                                {{ $position->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <label class="col-md-4 col-form-label text-md-right">Instrucción:</label>
                <div class="row">
                    <div class="col-2">

                        <select class="form-select" name="instruction_id" aria-label="Default select example" required>
                            @foreach ($instructions as $instruction)
                                <option value="{{ $instruction->id }}"
                                    {{ old('instruction_id') == $instruction->id ? 'selected' : '' }}>
                                    {{ $instruction->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-8">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Escribe ..." id="floatingTextarea" name="additional_instructions">{{ old('additional_instructions') }}</textarea>
                            <label for="floatingTextarea">Instrucciones adicionales:</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-floating">
                            <input class="form-control" type="date" name="expiration" id="expiration"
                                value="{{ old('expiration') }}" min={{ now()->format('Y-m-d') }} required />
                            <label for="expiration">Vencimiento:</label>
                        </div>


                    </div>
                </div>

                <input type="hidden" value="{{ $document->id }}" name="document_id" />


                <div class="form-row m-3">
                    <button type="submit" class="btn btn-primary btn-lg">Turnar</button>
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
                placeholder: "Selecciona ...",
                allowClear: true,
            });

        });
    </script>
@endsection
