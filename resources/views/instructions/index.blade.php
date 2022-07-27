@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Compañias/Dependencias</h1>
        <a class="btn btn-primary btn-rounded btn-lg" href="{{ route('companies.create') }}">Crear nueva</a>
        @if (count($companies) == 0)
            <div class="alert alert-warning" role="alert">
                <p>No existen registros en el catálogo.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acrónimo o Abreviatura</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->acronym }}</td>
                                <td>

                                    <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                        href="{{ route('companies.edit', ['company' => $company->id]) }}">
                                        Editar
                                    </a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $companies->links() !!}
            </div>
        @endif
    </div>
@endsection
