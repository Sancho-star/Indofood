<?php 
// Include Constants Page
include('constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) // Check if ID and image name are set
{
    // Process to Delete

    // 1. Get ID and Image Name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2. Remove the Image if Available
    if ($image_name != "") 
    {
        // It has an image, and it needs to be removed from the folder
        // Get the Image Path
        $path = "../images/" . $image_name; // Ensure this points to the correct directory

        // Remove Image File from Folder
        $remove = unlink($path);

        // Check whether the image is removed or not
        if ($remove == false) 
        {
            // Failed to Remove Image
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
            // Redirect to Manage Food
            header('location:' . SITEURL . 'manage-food.php');
            // Stop the process of deleting food
            die();
        }
    }

    // 3. Delete Food from Database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    // Execute the Query
    $res = mysqli_query($conn, $sql);

    // 4. Redirect to Manage Food with Session Message
    if ($res == true) 
    {
        // Food Deleted
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:' . SITEURL . 'manage-food.php');
    } 
    else 
    {
        // Failed to Delete Food
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        header('location:' . SITEURL . 'manage-food.php');
    }
} 
else 
{
    // Redirect to Manage Food Page
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL . 'manage-food.php');
}
?>
