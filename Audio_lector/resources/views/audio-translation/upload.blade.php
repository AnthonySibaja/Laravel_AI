<form method="POST" action="{{ route('audio-translation.process') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" />
    <button type="submit">Subir archivo y traducir</button>
</form>
