@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Edita un departamento:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('departments.update', ['department'=>$department->id]) }}" >
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Nombre:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') ?? $department->name }}" required />
                </div>


                <div class="form-row m-3">
                    <button type="submit" class="btn btn-primary btn-lg">Editar</button>
                </div>

            </form>
        </div>
    </div>
@endsection
