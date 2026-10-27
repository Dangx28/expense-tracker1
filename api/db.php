<?php
$host = "localhost";
$dbname = "expenses_db";   // your database name
$user = "root";                // XAMPP default
$pass = "";                    // XAMPP default is empty

$options = [
    // ERRMODE_EXCEPTION: throw an exception whenever a DB error occurs,
    // instead of silently failing. Much easier to debug as a beginner.
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,

    // FETCH_ASSOC: when we read rows, give us an associative array
    // (e.g. $row["name"]) instead of a numbered array ($row[0]).
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

set_exception_handler(function ($e) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => "Server error"]);
});