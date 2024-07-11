<?php
include 'dbh.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do app</title>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">

    <script>
        $(document).ready(function() {
            $("#todo_list").load("load-todo.php");

            $("#btn").click(function(e) {
                e.preventDefault();
                var todo = $("#value").val().trim();
                if (todo !== "") {
                    $.ajax({
                        type: "POST",
                        url: "add.php",
                        data: {
                            todo: todo
                        },
                        success: function(response) {
                            $("#todo_list").load("load-todo.php");
                            $("#value").val("");
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    alert("Todo cannot be empty!");
                }
            });

            $("#todo_list").on("click", ".delete-btn", function(e) {
                e.preventDefault();
                var id = $(this).closest("a").attr("href").split("=")[1];

                $.ajax({
                    type: "GET",
                    url: "delete.php",
                    data: {
                        delete: id
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status === "success") {
                            $("#todo_list").load("load-todo.php");
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

        });
    </script>
</head>

<body>

    <div class="container">
        <h1>Todo App</h1>
        <form action="index.php" method="post">
            <input type="text" id="value" name="todo" placeholder="Enter a new todo" required>
            <input id="btn" value="Add Todo">
        </form>
        <ul id="todo_list">

        </ul>

    </div>
</body>

</html>