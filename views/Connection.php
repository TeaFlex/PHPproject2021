<div class="center">
    <h3>Connexion</h3>
    <span style="font-style: italic;">powered by</span> 
    <img src="assets/icons/elephpant.gif" alt="funny elephant" class="elephant"/>
    <span class="success"><?= $data['success'] ?></span>
    <span class="error"><?= $data['error'] ?></span>
    <form action="index.php?action=connection" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"/>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password"/>
        <input type="submit" value="Se connecter">
    </form>
    <div>
        Pas encore de compte ? <a href="index.php?page=registration">Inscrivez-vous !</a>
    </div>
</div>