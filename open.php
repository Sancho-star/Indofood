<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Here you can handle the form submission and store the data in your database
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    header("Location: food2.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #E0F7FA;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        /* Lock icon styles */
        .lock-icon {
            font-size: 50px;
            cursor: pointer;
            color: #007bff;
        }

        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5); /* Black w/ opacity */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 8px; /* Rounded corners */
            text-align: center;
        }

        /* Input and button styles */
        input {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div id="myModal" class="modal">
    <div class="modal-content">
        <h2>Create Account</h2>
        <form id="accountForm" method="POST" action="open.php">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Create Account</button>
        </form>
    </div>
</div>

<script>
    // Get modal element
    var modal = document.getElementById("myModal");
    var lockIcon = document.getElementById("lockIcon");
    lockIcon.onclick = function() {
        modal.style.display = "flex"; // Show modal
    }

    // Close modal when user clicks anywhere outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none"; // Hide modal
        }
    }

    // Handle account creation form submission
    document.getElementById('accountForm').onsubmit = function(event) {
        
    }
</script>

</body>
</html>
