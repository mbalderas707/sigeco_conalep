@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body bg-light">
                <h4 class="card-title">Crea un remitente:</h4>
                <div class="form-group">
                    <form method="POST" action="{{ route('senders.store') }}">
                        @csrf
                        <div class="form-row">
                            <label class="col-md-4 col-form-label text-md-right">Nombre:</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required />
                        </div>
                        <div class="form-row">
                            <label class="col-md-4 col-form-label text-md-right">Puesto:</label>
                            <input class="form-control" type="text" name="position" value="{{ old('position') }}"
                                required />
                        </div>
                        <div class="form-row">
                            <label class="col-md-4 col-form-label text-md-right">Compañia/Dependencia:</label>
                            <select class="form-select select2" style="width:100%" name="company_id" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row m-3">
                            <button type="submit" class="btn btn-primary btn-lg">Crear</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Select2
            $('.select2').select2({
                placeholder: "Selecciona la dependencia...",
                allowClear: true
            });

        });
    </script>
@endsection
