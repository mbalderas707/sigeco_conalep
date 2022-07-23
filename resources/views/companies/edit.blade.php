@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Edita una compañia/dependencia:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('companies.update', ['company'=>$company->id]) }}" >
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Nombre:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') ?? $company->name }}"" required />
                </div>
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Acrónimo o abreviatura:</label>
                    <input class="form-control" type="text" name="acronym" value="{{ old('acronym') ?? $company->acronym }}" required />
                </div>

                <div class="form-row m-3">
                    <button type="submit" class="btn btn-primary btn-lg">Editar</button>
                </div>

            </form>
        </div>
    </div>
@endsection

