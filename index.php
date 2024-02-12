<?php
// Detalles de la API
$api_server = "https://api.demo.sitehost.co.nz";
$api_version = "1.0";
$api_key = "d17261d51ff7046b760bd95b4ce781ac";
$client_id = 293785;

// Buildiing URL of the API. 
$url = "$api_server/$api_version/srs/list_domains.json?client_id=$client_id&apikey=$api_key";

// API Request
$response = file_get_contents($url);

// JSON
$data = json_decode($response, true);

// This code is to verify the request.
if ($data && isset($data['status']) && $data['status'] === 'success' && isset($data['domains'])) {
    $domains = $data['domains'];
} else {
    $error_message = "No se pudieron recuperar los dominios del cliente.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Lists</title>
</head>
<body>
    <h1>Client Domain Lists #<?php echo $client_id; ?></h1>

    <?php if (isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php else: ?>
        <ul>
            <?php foreach ($domains as $domain): ?>
                <li><?php echo $domain; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
