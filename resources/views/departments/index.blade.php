@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Departamentos</h1>
        <a class="btn btn-primary btn-rounded btn-lg" href="{{ route('departments.create') }}">Crear nuevo</a>
        @if (count($departments) == 0)
            <div class="alert alert-warning" role="alert">
                <p>No existen registros en el catálogo.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->name }}</td>

                                <td>

                                    <a class="btn btn-primary btn-rounded d-inline-block m-1"
                                        href="{{ route('departments.edit', ['department' => $department->id]) }}">
                                        Editar
                                    </a>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $departments->links() !!}
            </div>
        @endif
    </div>
@endsection
