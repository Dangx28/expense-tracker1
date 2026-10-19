<?php

require "db.php";
header("Content-Type: application/json");

try {
    $sql = "SELECT name, id FROM categories";
    $stmt = $pdo->query($sql);
    $categories = $stmt->fetchAll();

    echo json_encode($categories);
} catch (PDOException $e) {
    http_response_code(500);
    $errorMessage = "Database connection failed";
    error_log($e->getMessage());
    echo json_encode(["error" => $errorMessage]);
}