<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"] {
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background: #f9f9f9;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Todo App</h1>
        <form action="index.php" method="post">
            <input type="text" name="todo" placeholder="Enter a new todo" required>
            <input type="submit" value="Add Todo">
        </form>

        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "todoapp";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["todo"])) {
            $todo = trim($_POST["todo"]);
            if (!empty($todo)) {
                $stmt = $conn->prepare("INSERT INTO todos (text) VALUES (?)");
                $stmt->bind_param("s", $todo);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Handle delete request
        if (isset($_GET['delete'])) {
            $id = intval($_GET['delete']);
            $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        // Retrieve and display todos
        $result = $conn->query("SELECT * FROM todos ORDER BY created_at DESC");

        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['text']) . " <a href='index.php?delete=" . $row['id'] . "'><button class='delete-btn'>Delete</button></a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No todos yet!</p>";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>