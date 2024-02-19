<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Transcripción de Audio</title>
</head>
<body>
    <h1>Resultado de la Transcripción de Audio</h1>

    @if(isset($transcription))
        <p>Transcripción: {{ $transcription }}</p>
    @else
        <p>Error al obtener la transcripción.</p>
    @endif
</body>
</html>
