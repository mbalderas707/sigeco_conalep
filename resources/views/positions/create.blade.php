@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Crea un puesto:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('positions.store') }}">
                @csrf
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Nombre:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" required />
                </div>
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Departamento:</label>
                    <select class="form-select" name="department_id" required>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{old('department_id')==$department->id ? 'selected':''}}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row m-3">
                    <button type="submit" class="btn btn-primary btn-lg">Crear</button>
                </div>

            </form>
        </div>
    </div>
@endsection
