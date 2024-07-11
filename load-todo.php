<?php
include 'dbh.php';
$result = $conn->query("SELECT * FROM todos ORDER BY created_at DESC");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['text']) . " <a href='index.php?delete=" . $row['id'] . "'><button class='delete-btn'>Delete</button></a></li>";
    }
} else {
    echo "<p>No todos yet!</p>";
}
