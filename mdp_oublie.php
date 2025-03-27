<?php
$titre = "Mot de passe oublié";
$mode = "jour";
require_once("include/header.inc.php");

if (isset($_POST["email"])) {
    $email = htmlspecialchars($_POST["email"]);

    try {
        $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, MDP);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    // Vérifier si l'email existe
    $requete = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $requete->execute([$email]);
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Cet email n'existe pas.";
    } else {
        // Générer un token sécurisé
        $token = bin2hex(random_bytes(32));
        $expiration = date("Y-m-d H:i:s", strtotime("+1 hour")); // Expire après 1h

        // Enregistrer le token dans la base de données
        $updateToken = $pdo->prepare("UPDATE users SET reset_token = ?, reset_expiration = ? WHERE email = ?");
        $updateToken->execute([$token, $expiration, $email]);

        // Lien de réinitialisation
        $resetLink = "https://abdel.alwaysdata.net/reset_password.php?token=" . $token;

        // Envoi du mail
        $to = $email;
        $subject = "Réinitialisation de votre mot de passe";
        $message = "Bonjour,\n\nCliquez sur ce lien pour réinitialiser votre mot de passe :\n$resetLink\n\nCe lien est valable 1 heure.";
        $headers = "From: noreply@tonsite.com\r\n" .
                   "Reply-To: noreply@tonsite.com\r\n" .
                   "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "<div style='text-align:center; padding:20px;'>Un email de réinitialisation a été envoyé.</div>";
        } else {
            echo "Erreur lors de l'envoi du mail.";
        }
    }
} else {
    echo '
    <main>
    <form action="mdp_oublie.php" method="post" class="form-container">
        <h2>Mot de passe oublié</h2>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required />
        <input type="submit" value="Envoyer" />
    </form>
    </main>';
}

require_once 'include/footer.inc.php';
?>
