<?php
$titre = "CUSTOMI FY";
$mode = "jour";
require_once("include/header.inc.php");
?>

<main>
    <div class="box-acceuil">
        <h2 class="h2-acceuil">CUSTOMI FY</h2>
        <p class="phrase-acceuil">Découvrez une nouvelle façon de personnaliser vos vêtements et d’exprimer votre style unique</p>

    </div>
    <section>
        <h2 class="h2-univers">Découvrez Nos Univers</h2>
        <?php
        if (isset($_SESSION["role"])) {
            if ($_SESSION["role"] == "admin") {
                echo  '<div class="modifications">
            <div class="ajouter_collection"><botton onclick= >Ajouter</botton></div>
            <div class="modifier_collection"><botton onclick= >Modifier</></div>
            </div>';
            }
        }
        ?>
        <div class="univers-container">
            <!-- Bouton de gauche -->
            <button class="nav-btn left" id="btn-left">❮</button>
            <!-- Zone défilable -->
            <div class="univers" id="univers">
                <div class="univer">
                    <a href="univers/univer_bebe.php"><img src="images/univers/univer_bebe.png" alt="Bébé">
                        <h3>Univer bébé</h3>
                    </a>
                </div>
                <div class="univer">
                    <a href="univers/univer_bebe.php"><img src="images/univers/papeterie_evenementiel.png" alt="Papeterie Événementiel">
                        <h3>Papeterie Événementiel</h3>
                    </a>
                </div>
                <div class="univer">
                    <a href="univers/univer_mariage.php"><img src="images/univers/univer_mariage.png" alt="Univer Mariage">
                        <h3>Univer Mariage</h3>
                    </a>

                </div>
                <div class="univer">
                    <a href="univers/univer_cadeau.php"><img src="images/univers/univer_cadeau.png" alt="Univer Cadeau">
                        <h3>Univer Cadeau</h3>
                    </a>

                </div>
                <div class="univer">
                    <a href="univers/univer_cini.php"><img src="images/univers/univer_dini.png" alt="Univer Dini">
                        <h3>Univer Dini</h3>
                    </a>

                </div>

            </div>
            <!-- Bouton de droite -->
            <button class="nav-btn right" id="btn-right">❯</button>
        </div>




    </section>

</main>
<script>
    const univers = document.getElementById("univers");
    const btnLeft = document.getElementById("btn-left");
    const btnRight = document.getElementById("btn-right");
    const scrollStep = 220; // Largeur d'une carte (200px) + marge (20px)

    // Met à jour l'affichage des boutons en fonction du scroll
    function updateButtons() {
        btnLeft.style.display = univers.scrollLeft > 0 ? "block" : "none";
        btnRight.style.display = univers.scrollLeft + univers.clientWidth < univers.scrollWidth ? "block" : "none";
    }

    // Scroll vers la gauche
    btnLeft.addEventListener("click", () => {
        univers.scrollBy({
            left: -scrollStep,
            behavior: "smooth"
        });
        setTimeout(updateButtons, 300); // Délai pour permettre le scroll
    });

    // Scroll vers la droite
    btnRight.addEventListener("click", () => {
        univers.scrollBy({
            left: scrollStep,
            behavior: "smooth"
        });
        setTimeout(updateButtons, 300);
    });

    // Mise à jour des boutons lors du défilement manuel
    univers.addEventListener("scroll", updateButtons);
    window.addEventListener("resize", updateButtons);
    updateButtons(); // Initialisation

    // Gestion du swipe pour mobile
    let touchStartX = 0;
    univers.addEventListener("touchstart", (e) => {
        touchStartX = e.touches[0].clientX;
    });
    univers.addEventListener("touchmove", (e) => {
        const diff = touchStartX - e.touches[0].clientX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                univers.scrollBy({
                    left: scrollStep,
                    behavior: "smooth"
                });
            } else {
                univers.scrollBy({
                    left: -scrollStep,
                    behavior: "smooth"
                });
            }
            touchStartX = e.touches[0].clientX;
            setTimeout(updateButtons, 300);
        }
    });
</script>

<?php require_once("include/footer.inc.php"); ?>