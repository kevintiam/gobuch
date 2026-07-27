<?php
require __DIR__ . '/vendor/autoload.php'; // Autoload Composer

use setasign\Fpdi\Tcpdf\Fpdi;

// Configuration
$uploadDir = __DIR__ . '/uploads/';
$outputDir = 'epreuvesFinales/';
$maxFileSize = 5 * 1024 * 1024; // 5MB

error_reporting(E_ALL);
ini_set('display_errors', 1); // Affiche toutes les erreurs pour le débogage

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Méthode non autorisée');
    }

    if (!isset($_FILES['pdf_file'])) {
        throw new Exception('Aucun fichier PDF reçu');
    }

    $file = $_FILES['pdf_file'];
    $watermarkText = htmlspecialchars($_POST['filigrane'] ?? 'GOBUCH', ENT_QUOTES, 'UTF-8');

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Erreur d\'upload : ' . $file['error']);
    }

    if ($file['size'] > $maxFileSize) {
        throw new Exception('Fichier trop volumineux (max 5MB)');
    }

    $nomDuFichier = $file['name'];
    $extension = strtolower(pathinfo($nomDuFichier, PATHINFO_EXTENSION));

    if ($extension !== 'pdf') {
        throw new Exception('⚠️ Le fichier envoyé n\'est pas un PDF.');
    }

    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    if (!is_dir($outputDir)) mkdir($outputDir, 0755, true);

    $safeFilename = preg_replace('/[^a-zA-Z0-9\.\-_]/', '_', $nomDuFichier);
    $filename = uniqid() . '_' . $safeFilename;
    $inputPath = $uploadDir . $filename;
    $outputPath = $outputDir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $inputPath)) {
        throw new Exception('Échec du transfert du fichier');
    }

    $monPdf = new Fpdi();

    $monPdf->SetCreator('Kevin Filigrane App');
    $monPdf->SetAuthor('Kevin');
    $monPdf->SetTitle('Document avec Filigrane');

    $pageCount = $monPdf->setSourceFile($inputPath);

    for ($i = 1; $i <= $pageCount; $i++) {
        $page = $monPdf->importPage($i);
        $size = $monPdf->getTemplateSize($page);

        $monPdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $monPdf->useTemplate($page);

        $monPdf->SetFont('DejaVuSans', 'B', 100);
        $monPdf->SetTextColor(200, 200, 200);

        $monPdf->SetAlpha(0.3);
        $monPdf->StartTransform();
        $monPdf->Rotate(45, $size['width'] / 2, $size['height'] / 2);

        $centerX = $size['width'] / 2;
        $centerY = $size['height'] / 2;

        $monPdf->Text($centerX - 100, $centerY, $watermarkText);

        $monPdf->StopTransform();
        $monPdf->SetAlpha(1);
    }

    $monPdf->Output($outputPath, 'F');

    // Suppression du fichier original
    if (file_exists($inputPath)) {
        if (!unlink($inputPath)) {
            throw new Exception('⚠️ Impossible de supprimer le fichier original : ' . $inputPath);
        }
    }

    header("Location: download.php?file=" . urlencode(basename($outputPath)));
    exit;

} catch (Exception $e) {
    // Nettoyage en cas d'erreur — on NE supprime PLUS le fichier final
    if (isset($inputPath) && file_exists($inputPath)) @unlink($inputPath);
    
    echo '<h3>Erreur :</h3><p>' . $e->getMessage() . '</p>';
}
