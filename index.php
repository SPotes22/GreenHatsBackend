<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["message"])) {
        echo json_encode(["error" => "No se recibió ningún mensaje."]);
        exit;
    }

    $prompt = $data["message"];
    $apiKey = "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";  // <-- reemplázala

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
    curl_close($ch);

    $result = json_decode($response, true);

    if (isset($result["choices"][0]["message"]["content"])) {
        echo json_encode(["respuesta" => $result["choices"][0]["message"]["content"]]);
    } else {
        echo json_encode(["error" => "No se pudo obtener respuesta del modelo."]);
    }
} else {
    echo json_encode(["error" => "Solo se aceptan solicitudes POST."]);
}
?>
