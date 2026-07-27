<?php
// Exemple conceptuel avec une API fictive

$api_url = "https://api.ip2location.io/?key=60286E91A3E3D7DA9032C3432F65E909&ip=129.0.76.34";

$response = file_get_contents($api_url);
$data = json_decode($response, true);

if ($data && isset($data['city_name'])) {
    $city = $data['city_name'];
    echo "La ville de l'utilisateur est : " . $city . "\n";
} else {
    echo "Impossible de récupérer la ville pour cette IP.\n";
}
?>
