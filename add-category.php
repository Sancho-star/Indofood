
<?php 
// Start the session


// Include your config file to define SITEURL and connect to the database
include('constants.php'); // Ensure this path is correct

// Check if $conn is set
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="all.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>

            <?php 
                if(isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <br><br>

            <!-- Add Category Form Starts -->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title" required>
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image" required>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes" required> Yes 
                            <input type="radio" name="featured" value="No"> No 
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes" required> Yes 
                            <input type="radio" name="active" value="No"> No 
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Add Category Form Ends -->

            <?php 
            // Check whether the Submit Button is Clicked or Not
            if(isset($_POST['submit'])) {
                // 1. Get the Value from Category Form
                $title = $_POST['title'];

                // For Radio input, we need to check whether the button is selected or not
                $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
                $active = isset($_POST['active']) ? $_POST['active'] : "No";

                // Check whether the image is selected or not and set the value for image name accordingly
                if(isset($_FILES['image']['name'])) {
                    // Upload the Image
                    $image_name = $_FILES['image']['name'];
                    
                    // Upload the Image only if image is selected
                    if($image_name != "") {
                        // Auto Rename our Image
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/".$image_name;

                        // Ensure the images directory exists
                        if (!is_dir('../images/')) {
                            mkdir('../images/', 0777, true);
                        }

                        // Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the image is uploaded or not
                        if($upload == false) {
                            // Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            // Redirect to Add Category Page
                            header('location:'.SITEURL.'add-category.php');
                            // Stop the Process
                            die();
                        }
                    }
                } else {
                    // Don't Upload Image and set the image_name value as blank
                    $image_name = "";
                }

                // 2. Create SQL Query to Insert Category into Database
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'";

                // 3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                // 4. Check whether the query executed or not and data added or not
                if($res == true) {
                    // Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    // Redirect to Manage Category Page
                    header('location:'.SITEURL.'manage-category.php');
                } else {
                    // Failed to Add Category
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    // Redirect to Manage Category Page
                    header('location:'.SITEURL.'add-category.php');
                }
            }
            ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
