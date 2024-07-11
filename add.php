<?php
include 'dbh.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["todo"])) {
    $todo = trim($_POST["todo"]);
    if (!empty($todo)) {
        $stmt = $conn->prepare("INSERT INTO todos (text) VALUES (?)");
        $stmt->bind_param("s", $todo);
        $stmt->execute();
        $stmt->close();
    }
}
