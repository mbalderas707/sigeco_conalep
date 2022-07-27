@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Edita una etiqueta:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('tags.update', ['tag' => $tag->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Nombre:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') ?? $tag->name }}"
                        required />
                </div>

                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Descripción:</label>
                    <input class="form-control" type="text" name="description" value="{{ old('description') ?? $tag->description }}"
                        required />
                </div>

                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Color:</label>
                    <input class="form-control form-control-color" type="color" name="color" value="{{ old('color') ?? $tag->color }}" required>


                </div>

                <div class="form-row m-3">
                    <button type="submit" class="btn btn-primary btn-lg">Editar</button>
                </div>

            </form>
        </div>
    </div>
@endsection
