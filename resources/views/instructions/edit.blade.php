@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Edita una instrucción:</h1>
        <div class="form-group">
            <form method="POST" action="{{ route('instructions.update', ['instruction'=>$instruction->id]) }}" >
                @csrf
                @method('PUT')
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Nombre:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') ?? $instruction->name }}" required />
                </div>
                <div class="form-row">
                    <label class="col-md-4 col-form-label text-md-right">Instrucción:</label>
                    <input class="form-control" type="text" name="description" value="{{ old('description') ?? $instruction->description }}" required />
                </div>

                <div class="form-row m-3">
                    <button type="submit" class="btn btn-primary btn-lg">Editar</button>
                </div>

            </form>
        </div>
    </div>
@endsection

