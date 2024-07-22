<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Listado de Personas</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($personas as $persona)
            <tr>
                <td>{{ $persona['id'] }}</td>
                <td>{{ $persona['nombre'] }}</td>
                <td>{{ $persona['edad'] }}</td>
                <td>{{ $persona['email'] }}</td>
                <td>
                    <a href="{{ route('personas.edit', $persona['id']) }}">Editar</a>
                    <form action="{{ route('personas.destroy', $persona['id']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('personas.create') }}">Crear nueva persona</a>

</body>
</html>
    