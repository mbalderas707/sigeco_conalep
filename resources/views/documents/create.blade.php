@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Crea un documento:</h1>
        <div class="form-group">
        <form method="POST" action="{{ route('documents.store') }}">
            <div class="form-row">
                <label>Folio:</label>
                <input class="form-control" type="text" name="folio" required>
            </div>
            <div class="form-row">
                <label>Asunto:</label>
                <input class="form-control" type="text" name="subject" required>
            </div>
            <div class="form-row">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="form-row">
                <label>Fecha de documento:</label>
                <input class="form-control" type="text" name="document_date" required>

            </div>

            <div class="form-row">
                <label>Fecha de recibido:</label>
                <input class="form-control" type="text" name="received_since" required>

                </span>
            </div>

        </form>
        </div>
    </div>
@endsection
