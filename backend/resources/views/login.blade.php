<form action="/api/login" method="POST">
    @csrf

    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Mot de passe">

    <button type="submit">Se connecter</button>
</form>