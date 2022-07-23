@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Crea un departamento:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('departments.store') }}" >
                @csrf
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Nombre:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" required />
                </div>


                <div class="form-row m-3">
                    <button type="submit" class="btn btn-primary btn-lg">Crear</button>
                </div>

            </form>
        </div>
    </div>
@endsection
