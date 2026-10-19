<?php

require "db.php";
header("Content-Type: application/json");

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // category, number, text, date
        $category = trim($_POST["category"]);
        $number = trim($_POST["number"]);
        $text = trim($_POST["text"]);
        $date = trim($_POST["date"]);

        $sql = "INSERT INTO expenses(category_id, amount, description, expense_date) VALUES (:category, :number, :text, :date);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':category' => $category, ':number' => $number, ':text' => $text, ':date' => $date]);

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    error_log($e);

    echo json_encode(["success" => false]);
}