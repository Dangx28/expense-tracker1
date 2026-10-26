<?php

require "db.php";
header("Content-Type: application/json");

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // category, number, text, date
        $number = trim($_POST["amount"] ?? "");
        $category = trim($_POST["category"] ?? "");
        $text = trim($_POST["desc"] ?? "");
        $date = trim($_POST["exp-date"] ?? "");
        $dateObject = DateTime::createFromFormat('Y-m-d', $date);

        $sql = "SELECT id FROM categories WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":id" => $category]);
        $category_id = $stmt->fetch();


        if (!is_numeric($number) || $number <= 0) {
            http_response_code(400);
            echo json_encode(["error" => "The amount is invalid."]);
            exit;
        }
        if (strlen($text) === 0 || strlen($text) > 255) {
            http_response_code(400);
            echo json_encode(["error" => "The description is invalid."]);
            exit;
        }
        if ($category_id === false) {
            http_response_code(400);
            echo json_encode(["error" => "The category is invalid."]);
            exit;
        }
        if ($dateObject !== false) {
            if ($dateObject->format('Y-m-d') !== $date) {
            http_response_code(400);
            echo json_encode(["error" => "The date format is invalid"]);
            exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "The date object returned false."]);
            exit;
        }

        $sql = "INSERT INTO expenses(category_id, amount, description, expense_date) VALUES (:category, :number, :text, :date);";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':category' => $category, ':number' => $number, ':text' => $text, ':date' => $date]);

        http_response_code(201);
        echo json_encode(["success" => true]);
    } else {
        http_response_code(405);
        echo json_encode(["error" => "The method used is invalid."]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    error_log($e);

    echo json_encode(["error" => "Could not save the expense."]);
}