<?php
// config.php - connexion PDO
$host = '127.0.0.1';
$db   = 'test-janto';
$user = 'root';
$pass = ''; // sous XAMPP par défaut c'est vide ; si tu as mis un mot de passe, le mettre ici
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // exceptions en cas d'erreur
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // en dev ok d'afficher l'erreur, en prod il faut logger et afficher un message générique
    die("Connexion échouée : " . $e->getMessage());
}
