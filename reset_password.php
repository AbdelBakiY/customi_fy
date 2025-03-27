<?php
$mode = "jour";

$titre = "Réinitialisation du mot de passe";
require_once("include/header.inc.php");

if (isset($_GET["token"])) {
    $token = htmlspecialchars($_GET["token"]);

    try {
        $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, MDP);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    // Vérifier si le token est valide et non expiré
    $requete = $pdo->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expiration > NOW()");
    $requete->execute([$token]);
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("Lien invalide ou expiré.");
    }

    // Traitement du formulaire
    if (isset($_POST["new_password"])) {
        $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe
        $updateMdp = $pdo->prepare("UPDATE users SET mdp = ?, reset_token = NULL, reset_expiration = NULL WHERE id = ?");
        $updateMdp->execute([$new_password, $user["id"]]);

        echo "<div style='text-align:center; padding:20px;'>Votre mot de passe a été mis à jour ! <a href='connexion.php'>Se connecter</a></div>";
        exit;
    }
} else {
    die("Token manquant.");
}

// Formulaire de réinitialisation
echo '
<main>
<form action="" method="post" class="form-container">
    <h2>Réinitialiser votre mot de passe</h2>
    <label for="new_password">Nouveau mot de passe :</label>
    <input type="password" id="new_password" name="new_password" required />
    <input type="submit" value="Mettre à jour" />
</form>
</main>';

require_once 'include/footer.inc.php';
?>
