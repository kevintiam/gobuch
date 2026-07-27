<?php
// Répertoire où les PDF sont enregistrés
$outputDir = 'C:\\Users\\tiamk\\Desktop\\phptest\\epreuvesFinales\\';

try {
    // Vérifie la présence du paramètre 'file'
    if (!isset($_GET['file'])) {
        throw new Exception('Paramètre "file" manquant dans l\'URL');
    }

    // Sécurise le nom du fichier
    $filename = basename($_GET['file']);

    // Construit le chemin complet
    $filepath = realpath($outputDir . $filename);

    // Sécurité : vérifie que le fichier existe et se trouve bien dans le dossier prévu
    if (!$filepath || !file_exists($filepath)) {
        throw new Exception('Fichier non trouvé ou chemin invalide');
    }

    if (strpos($filepath, realpath($outputDir)) !== 0) {
        throw new Exception('Accès au fichier interdit');
    }

    // Envoie les bons headers pour le téléchargement
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($filepath));
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');

    // Lis et affiche le contenu du fichier
    readfile($filepath);
    exit;

} catch (Exception $e) {
    // En cas d’erreur, affiche un message simple (ou redirige)
    echo '<h3>Erreur :</h3><p>' . htmlspecialchars($e->getMessage()) . '</p>';
    // Ou utilise : header("Location: error.php?message=" . urlencode($e->getMessage()));
    exit;
}
