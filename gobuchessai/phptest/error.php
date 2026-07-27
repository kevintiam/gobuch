<?php
function handleUploadError($code) {
    $errors = [
        UPLOAD_ERR_INI_SIZE => 'Fichier trop volumineux (configuration serveur)',
        UPLOAD_ERR_FORM_SIZE => 'Fichier trop volumineux (formulaire)',
        UPLOAD_ERR_PARTIAL => 'Upload partiel',
        UPLOAD_ERR_NO_FILE => 'Aucun fichier uploadé',
        UPLOAD_ERR_NO_TMP_DIR => 'Dossier temporaire manquant',
        UPLOAD_ERR_CANT_WRITE => 'Erreur d\'écriture',
        UPLOAD_ERR_EXTENSION => 'Extension bloquée'
    ];
    return $errors[$code] ?? 'Erreur inconnue';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Erreur</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container error-container">
        <h1>Erreur</h1>
        <div class="error-message">
            <?= htmlspecialchars($_GET['message'] ?? 'Une erreur est survenue') ?>
        </div>
        <a href="index.php" class="back-link">← Retour à l'accueil</a>
    </div>
</body>
</html>