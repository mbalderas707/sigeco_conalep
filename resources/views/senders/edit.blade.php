@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Edita un remitente:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('senders.update', ['sender' => $sender->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Nombre:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') ?? $sender->name }}"
                        required />
                </div>

                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Puesto:</label>
                    <input class="form-control" type="text" name="position" value="{{ old('position') ?? $sender->position }}"
                        required />
                </div>

                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Departamento:</label>
                    <select class="form-select" name="company_id" required>
                        @foreach ($companies as $company)
                            <option
                            {{ (collect(old('department_id'))->contains($company->id) ? 'selected' : $sender->company->id==$company->id) ? 'selected' : '' }}
                            value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row m-3">
                    <button type="submit" class="btn btn-primary btn-lg">Editar</button>
                </div>

            </form>
        </div>
    </div>
@endsection
