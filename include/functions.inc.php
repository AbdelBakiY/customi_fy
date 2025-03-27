<?php

define('HOST', 'mysql-abdel.alwaysdata.net');
define('DBNAME', 'abdel_customi_fy');
define('USER', 'abdel');
define('MDP', 'Youcef-2004');

function getConnection()
{
    try {
        $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, MDP);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Error connecting: " . $e->getMessage();
        exit;
    }
}

function connexion(String $e_mail, String $password)
{
    $pdo = getConnection();

    $e_mail = htmlspecialchars($e_mail);
    $requete = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $requete->execute([$e_mail]);
    $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$utilisateur) {
        echo "<script>window.onload = function() {document.getElementById('mail_faux').style.display='block';};</script>";
    } else {
        // Vérification du mot de passe
        if (password_verify($password, $utilisateur['mdp'])) {
            session_start();
            $_SESSION['nom'] = $utilisateur['Nom'];
            $_SESSION['prenom'] = $utilisateur['Prenom'];
            $_SESSION['email'] = $utilisateur['email'];
            $_SESSION['role'] = $utilisateur['role'];
            header('Location: index.php');
            exit();
        } else {
            echo "<script>window.onload = function() {document.getElementById('mdp_faux').style.display='block';};</script>";
        }
    }
}

function inscription(String $nom, String $prenom, String $e_mail, String $tel, String $password)
{
    $pdo = getConnection();

    $nom = htmlspecialchars($nom);
    $prenom = htmlspecialchars($prenom);
    $e_mail = htmlspecialchars($e_mail);
    $tel = htmlspecialchars($tel);
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $requete = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $requete->execute([$e_mail]);

    if ($requete->fetch(PDO::FETCH_ASSOC)) {
        echo "<script>window.onload = function() {document.getElementById('deja_mail').style.display='block';};</script>";
        return;
    }

    $role = (strtolower($nom) === "mougari") ? "admin" : "user";

    $requete = $pdo->prepare("INSERT INTO users (Nom, Prenom, email,tel, mdp, role) VALUES (:Nom, :Prenom, :email, :tel,:mdp, :role)");
    $requete->execute([
        'Nom' => $nom,
        'Prenom' => $prenom,
        'email' => $e_mail,
        'tel' => $tel,
        'mdp' => $passwordHash,
        'role' => $role
    ]);

    session_start();
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['email'] = $e_mail;
    $_SESSION['tel'] = $tel;
    $_SESSION['role'] = $role;
    header("Location: index.php");
    exit();
}





?>