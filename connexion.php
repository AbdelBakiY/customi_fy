<?php 
$titre = "Accueil";
$mode = "jour";

require_once("include/header.inc.php");

if (isset($_POST['connexion'])) {
    $e_mail = htmlspecialchars($_POST['e-mail']);
    $mdp = htmlspecialchars($_POST['mdp']);

    connexion($e_mail, $mdp);
}

?>

<main>
    <h2 >Connexion</h2>
    <form action="connexion.php" method="post" class="form-container">
        <label for="e-mail" class="form-label">E-mail :</label>
        <input type="email" id="e-mail" name="e-mail" required class="form-input"/>
        
        <label for="mdp" class="form-label">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required class="form-input"/>
        <a href="mdp_oublie.php" class="form-link" style="margin-bottom:2%;text-align:center;">Mot de passe oublié ?</a>
        <span style="color:red;display:none;margin-bottom:2%;text-align:center;" id="mail_faux">Cet email n'existe pas</span>
        <span style="color:red;display:none;margin-bottom:2%;text-align:center;" id="mdp_faux">Mot de passe incorrect</span>
        
        <input type="submit" value="Connexion" class="form-submit" name="connexion"/>

        <a href="inscription.php" class="form-link">Inscrivez-vous</a>
    </form>
</main>

<?php 
require_once 'include/footer.inc.php'; 
?>
