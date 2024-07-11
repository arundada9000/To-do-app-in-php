<?php
include 'dbh.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['status' => 'success', 'message' => 'Todo deleted successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
