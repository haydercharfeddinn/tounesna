<?php
$host = 'smtp.gmail.com';
$port = 465; // Changez pour 587 si vous utilisez TLS

echo "Test de connexion à $host:$port...\n";

$connection = fsockopen($host, $port, $errno, $errstr, 10);

if (!$connection) {
    echo "Échec de la connexion : $errstr ($errno)\n";
} else {
    echo "Connexion réussie à $host:$port !\n";
    fclose($connection);
}
?>
