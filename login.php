<?php 
include('constants.php'); 

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="admin.css">
   <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            position: relative;
        }

        /* Form Container */
        .login {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 10;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Input Fields */
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Error and Success Message Styling */
        .error {
            color: red;
        }

        .success {
            color: green;
        }

        /* Link Style */
        a {
            text-decoration: none;
            color: #4CAF50;
        }

        /* Image Styles */
        .image-left {
            position: absolute;
            left: 10px;
            width: 200px;
            height: auto;
            top: 50%;
            transform: translateY(-50%);
        }

        .image-right {
            position: absolute;
            right: 10px;
            width: 200px;
            height: auto;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
 </head>

<body>
    <!-- Left Image -->
    <img src="p1.jpg" alt="Image Left" class="image-left">

    <!-- Right Image -->
    <img src="p1.jpg" alt="Image Right" class="image-right">

    <div class="login">
        <h1>Login</h1>

        <?php 
            if(isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <br><br>

        <!-- Login Form Starts Here -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username" required><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password" required><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <!-- Login Form Ends Here -->

        <p>Created By - <a href="https://www.sanchi.com">Sanchita Patil</a></p>
    </div>
</body>
</html>

<?php 
// Check whether the Submit Button is Clicked or Not
if(isset($_POST['submit'])) {
    // Process for Login
    // 1. Get the Data from Login form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Get raw password

    // 2. SQL to check whether the user with username exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username'";
    $res = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($res);

    // 3. Verify Password
    if ($user && password_verify($password, $user['password'])) {
        // User Available and Login Success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; // To check whether the user is logged in or not

        // Redirect to Home Page/Dashboard
        header('location:'.SITEURL.'food2.html');
        exit; // Stop further script execution
    } else {
        // User not Available and Login Fail
        $_SESSION['login'] = "<div class='error'>Username or Password did not match.</div>";
        // Redirect to Login Page
        header('location:'.SITEURL.'food2.html'); // Adjust as necessary
        exit; // Stop further script execution
    }
}
?>
