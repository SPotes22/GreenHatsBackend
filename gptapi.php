<?php
// gpt_use.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["message"])) {
        echo json_encode(["error" => "No se recibió ningún mensaje."]);
        exit;
    }

    $prompt = $data["message"];
    $apiKey = "TU_API_KEY_AQUI";  // <-- Reemplaza con tu clave válida

    $postData = [
        "model" => "gpt-3.5-turbo",
        "messages" => [
            ["role" => "user", "content" => $prompt]
        ]
    ];

    $ch = curl_init("https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $apiKey"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(["error" => curl_error($ch)]);
    } else {
        echo $response;
    }

    curl_close($ch);
} else {
    echo json_encode(["error" => "Solo se aceptan solicitudes POST."]);
}
?>
