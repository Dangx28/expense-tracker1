<?php

require "db.php";
header("Content-Type: application/json");

try {
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $sql = "SELECT e.id, e.amount, e.description, e.category_id, c.name AS category_name, e.expense_date FROM expenses e JOIN categories c ON e.category_id = c.id ORDER BY e.expense_date DESC, e.id DESC";
        $stmt = $pdo->query($sql);
        $data = $stmt->fetchAll();
        echo json_encode($data);
    } else {
        http_response_code(405);
        echo json_encode(["error" => "Wrong method used."]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    error_log($e->getMessage());
    echo json_encode(["error" => "Couldn't get expenses."]);
}