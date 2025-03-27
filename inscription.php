<?php
$titre = "Accueil";
$mode = "jour";
require_once("include/header.inc.php");

if (isset($_POST["inscription"])) {
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    $e_mail = $_POST["e-mail"];
    $tel = $_POST["tel"];
    $mdp = $_POST["mdp"];
    $Cmdp = $_POST["Cmdp"];

    if ($mdp !== $Cmdp) {
        echo " <script>
        // Affiche l'erreur après le chargement complet
        window.onload = function() {
            document.getElementById('non_cor').style.display = 'block';
        };
    </script>";
    } else {
        inscription($Nom, $Prenom, $e_mail, $tel, $mdp);
    }
}





// traitemnt de comfirmation de mdp 

?>
<script>
    $(document).ready(function() {
        $('#mdp, #Cmdp').on('input', function() {
            var mdp = $('#mdp').val().trim();
            var Cmdp = $('#Cmdp').val().trim();

            if (mdp !== '' && Cmdp !== '') {
                if (mdp === Cmdp) {
                    $('#mdp_message').text("Les mots de passe correspondent.")
                        .removeClass()
                        .addClass("success");
                } else {
                    $('#mdp_message').text("Les mots de passe ne correspondent pas.")
                        .removeClass()
                        .addClass("error");
                        $('#submitBtn').prop('disabled', true); 

                }
            } else {
                $('#mdp_message').text("").removeClass();
            }
        });
    });
</script>

<main>
    <h2 style="color:black;text-align:center;font-size: 2em;font-family: 'Poppins', sans-serif;">Inscription</h2>

    <form action="inscription.php" method="post" class="form-container-inscription">
        <label for="Nom" class="form-label">Nom :</label>
        <input type="text" id="Nom" name="Nom" required class="form-input" />

        <label for="Prenom" class="form-label">Prénom :</label>
        <input type="text" id="Prenom" name="Prenom" required class="form-input" />

        <label for="e-mail" class="form-label">E-mail :</label>
        <input type="email" id="e-mail" name="e-mail" required class="form-input" />
        <span style="color:red;display:none;margin-bottom:2%;text-align:center;" id="deja_mail">
            Un compte avec cet e-mail existe déjà.
        </span>
        <label for="tel" class="form-label">Télephone :</label>
        <input type="tel" id="tel" name="tel" class="form-input" required />

        <label for="mdp" class="form-label">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required class="form-input" />
        <div id="mdp_message"></div>

        <label for="Cmdp" class="form-label">Confirmez votre mot de passe :</label>
        <input type="password" id="Cmdp" name="Cmdp" required class="form-input" />

        <span style="color:red;display:none;margin-bottom:2%;text-align:center;" id="non_cor">Les deux mots de passe ne correspondent pas.</span>

        <input type="submit"  id="submitBtn" value="Inscrivez-vous" class="form-submit" name="inscription" />

        <a href="connexion.php" class="form-link">Connexion</a>
    </form>
</main>

<?php
require_once 'include/footer.inc.php';
?>