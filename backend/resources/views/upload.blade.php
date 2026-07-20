<form action="/api/admin/contenus" method="POST" enctype="multipart/form-data">

    @csrf

    <input type="text" name="titre" placeholder="Titre du dars">

    <select name="type">
        <option value="dars">Dars</option>
        <option value="khoutba">Khoutba</option>
    </select>

    <input type="file" name="audio">

    <button type="submit">
        Envoyer
    </button>

</form>