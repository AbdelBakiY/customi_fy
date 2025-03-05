<?php require_once("include/functions.inc.php");
// session_start();
// if (isset($_SESSION['mode'])) {
//     $prenom = $_SESSION['prenom'];
// } else {
//     $prenom = "";
// }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles\<?php echo $mode . ".css"; ?>" />
    <link rel="icon" type="image/png" href="images\favicon_fy.png" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title><?php echo $titre; ?></title>
    <?php if (basename($_SERVER['PHP_SELF']) === 'index.php') {
        echo "<style>
        header {
            height: 590px;
            background: url('images/{$mode}.webp') no-repeat center center;
            background-size: cover;

            
            width: 100%;
        }

    @media (max-width: 768px) {
        header {
            height: 400px;
            background-size: contain;
            background-attachment: scroll;
            width: 100%;
        }
    }
    </style>";
    }
    ?>
</head>

<body>
    <header class="site-header">
        <div class="top-head site-nav" id="top-head">
            <!-- Sidebar menu -->
            <div class="menu">
                <span class="menu-bar" onclick="openNav()" style='color:#734F43;'><strong>

                    ☰ <span class="menu-text">Menu</span>
                </span>
            </strong>
            </div>
            <div class="titre"><a href="index.php">
                    <h1><strong>CUSTOMI FY</strong></h1>
                </a></div>
            <?php
            if (isset($_SESSION['prenom']) && isset($_SESSION['nom'])) {
                echo "<div><a href=\"deconnexion.php\" class=\"cnx\">Déconnexion</a>
                <a href=\"profil.php\" class=\"cnx\">Mon Profil</a></div>";
            } else {
                echo "<a href=\"connexion.php\"  class=\"cnx\">Connexion</a>";
            }
            ?>
        </div>
        <?php if (basename($_SERVER['PHP_SELF']) === 'index.php') {
            echo " <div class=\"titre-page\" style=\"font-family: 'Times New Roman';\"><strong>CUSTMI FY : crée tes vêtements, impose ton style</strong></div>
            <div class=\"decouvrir\"><a href=\"#\">Découvrez nos modèles disponibles</a></div>";
        }
        ?>


    </header>

    <!-- Sidebar -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="index.php">Accueil</a>
        <a href="nouveautes.php">Nouveautés</a>
        <a href="contact.php">Contact</a>
    </div>


    <script>
        // Fonction pour ouvrir la sidebar
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.querySelector('header').classList.add("blur-background");
            document.querySelector('main').classList.add("blur-background");
        }

        // Fonction pour fermer la sidebar
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.querySelector('header').classList.remove("blur-background");
            document.querySelector('main').classList.remove("blur-background");
        }
        window.addEventListener("scroll", function() {
            var topNav = document.getElementById("top-head");
            if (window.pageYOffset > 0) {
                topNav.classList.add("scrolled");
            } else {
                topNav.classList.remove("scrolled");
            }
        });


        window.addEventListener("scroll", function() {
            let navbar = document.querySelector(".site-header .top-head");
            if (window.scrollY > 50) { // Si l'utilisateur scrolle plus de 50px
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>