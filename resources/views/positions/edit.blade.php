@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Edita un puesto:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('positions.update', ['position' => $position->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Nombre:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') ?? $position->name }}"
                        required />
                </div>
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Departamento:</label>
                    <select class="form-select" name="department_id" required>
                        @foreach ($departments as $department)
                            <option
                            {{ (collect(old('department_id'))->contains($department->id) ? 'selected' : $position->department->id==$department->id) ? 'selected' : '' }}
                            value="{{ $department->id }}">{{ $department->name }}</option>
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
