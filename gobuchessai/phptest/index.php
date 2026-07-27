<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de filigrane PDF</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un filigrane à un PDF</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pdf_file">Fichier PDF:</label>
                <input type="file" name="pdf_file" id="pdf_file" accept=".pdf" required>
            </div>
            <div class="form-group">
                <label for="filigrane">Texte du filigrane:</label>
                <input type="text" name="filigrane" id="filigrane" value="GOBUCH" required>
            </div>
            <button type="submit">Ajouter le filigrane</button>
        </form>
    </div>
</body>
</html>