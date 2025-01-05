
<?php 
// Start Session


// Include your config file to define SITEURL and connect to the database
include('constants.php'); // Ensure this path is correct

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admin</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="all.css"> <!-- Additional CSS if needed -->
</head>
<body>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>

        <br />

        <?php 
            // Display session messages
            $session_messages = [
                'add', 'delete', 'update', 'user-not-found', 'pwd-not-match', 'change-pwd'
            ];
            foreach ($session_messages as $msg) {
                if (isset($_SESSION[$msg])) {
                    echo $_SESSION[$msg]; // Displaying Session Message
                    unset($_SESSION[$msg]); // Removing Session Message
                }
            }
        ?>
        
        <br><br><br>

        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php 
                // Query to Get all Admin
                $sql = "SELECT * FROM tbl_admin";
                // Execute the Query
                $res = mysqli_query($conn, $sql);

                // Check whether the Query is Executed or Not
                if ($res == TRUE) {
                    // Count Rows to Check whether we have data in database or not
                    $count = mysqli_num_rows($res); // Function to get all the rows in database

                    $sn = 1; // Create a Variable and Assign the value

                    // Check the num of rows
                    if ($count > 0) {
                        // We Have data in database
                        while ($rows = mysqli_fetch_assoc($res)) {
                            // Get individual Data
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            // Display the Values in our Table
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo htmlspecialchars($full_name); ?></td>
                                <td><?php echo htmlspecialchars($username); ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>delete-admin.php?id=<?php echo $id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this admin?');">Delete Admin</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // No data found message
                        echo "<tr><td colspan='4' class='error'>No Admins Found.</td></tr>";
                    }
                } else {
                    // Query execution failed
                    echo "<tr><td colspan='4' class='error'>Failed to Fetch Admins: " . mysqli_error($conn) . "</td></tr>";
                }
            ?>
        </table>

    </div>
</div>
<!-- Main Content Section Ends -->


<?php include('footer.php'); ?>
</body>
</html>
