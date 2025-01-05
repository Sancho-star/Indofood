<?php
include('constants.php'); // Include constants

?>

<head>
    <link rel="stylesheet" type="text/css" href="all.css">
    <style>
        /* Place your CSS styles here or link an external CSS file */
    </style>
</head>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) { //Checking whether the Session is Set or Not
                echo $_SESSION['add']; //Display the Session Message if Set
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" required>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" required>
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>

<?php 
// Process the Value from Form and Save it in Database
if(isset($_POST['submit'])) {
    // Button Clicked
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Use password_hash for better security

    // SQL Query to Save the data into database
    $sql = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('$full_name', '$username', '$password')";

    // Executing Query and Saving Data into Database
    $res = mysqli_query($conn, $sql);

    // Check whether the (Query is Executed) data is inserted or not
    if($res) {
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
        header("location:".SITEURL.'food2.html');
        exit(); // Always call exit after redirecting
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
        header("location:".SITEURL.'add-admin.php');
        exit(); // Always call exit after redirecting
    }
}
?>
