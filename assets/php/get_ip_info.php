<?php
$ipAddress = $_GET['ip'];
$token = 'tu_token';
$apiUrl = "https://ipinfo.io/$ipAddress?token=$token";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);
if (isset($data['city'])) {
    $data['Ciudad'] = $data['city'];
}
if (isset($data['region'])) {
    $data['Región'] = $data['region'];
}
if (isset($data['country'])) {
    $data['País'] = $data['country'];
}
if (isset($data['org'])) {
    $data['ISP'] = $data['org'];
}
if (isset($data['hostname'])) {
    $data['Hostname'] = $data['hostname'];
}
if (isset($data['loc'])) {
    $coordinates = explode(',', $data['loc']);
    $data['Coordenadas geográficas'] = [
        'Latitud' => $coordinates[0],
        'Longitud' => $coordinates[1],
    ];
}
if (isset($data['timezone'])) {
    $data['Zona horaria'] = $data['timezone'];
}
if (isset($data['postal'])) {
    $data['Código postal'] = $data['postal'];
}
echo json_encode($data, JSON_PRETTY_PRINT);
