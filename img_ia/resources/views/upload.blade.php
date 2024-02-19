<form method="post" action="/generate">
    @csrf
    <div>
        <label for="text">Texto:</label>
        <input type="text" name="text" id="text">
    </div>
    <button type="submit">Generar imagen</button>
</form>