<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Editar Persona</h1>
    <form action="{{ route('personas.update', $persona['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ $persona['nombre'] }}" required>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="{{ $persona['edad'] }}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $persona['email'] }}" required>

        <button type="submit">Actualizar</button>
    </form>

</body>
</html>