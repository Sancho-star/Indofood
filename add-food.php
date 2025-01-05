<?php 



// Include your config file to define SITEURL and connect to the database
include('constants.php'); // Ensure this path is correct

?>
   <link rel="stylesheet" href="all.css">
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                // Create PHP Code to display categories from Database
                                // 1. Create SQL to get all active categories from the database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                
                                // Executing Query
                                $res = mysqli_query($conn, $sql);

                                // Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                // If count is greater than zero, we have categories else we don't
                                if($count>0)
                                {
                                    // We have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // Get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    // We do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
            // Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // Add the Food in Database

                // 1. Get the Data from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // Check whether the radio buttons for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; // Setting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; // Setting Default Value
                }

                // 2. Upload the Image if selected
                if(isset($_FILES['image']['name']))
                {
                    // Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    // Check Whether the Image is Selected or not and upload image only if selected
                    if($image_name != "")
                    {
                        // Image is selected
                        // A. Rename the Image
                        $ext = end(explode('.', $image_name)); // Get the extension of the selected image

                        // Create New Name for Image
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext; // New Image Name

                        // B. Upload the Image
                        $src = $_FILES['image']['tmp_name']; // Source path
                        $dst = "../images/".$image_name; // Destination Path

                        // Finally Upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        // Check whether image uploaded or not
                        if($upload == false)
                        {
                            // Failed to Upload the image
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'add-food.php');
                            die(); // Stop the process
                        }
                    }
                }
                else
                {
                    $image_name = ""; // Setting Default Value as blank
                }

                // 3. Insert Into Database
                $sql2 = "INSERT INTO tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // 4. Redirect with Message to Manage Food page
                if($res2 == true)
                {
                    // Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'manage-food.php');
                }
                else
                {
                    // Failed to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:'.SITEURL.'manage-food.php');
                }
            }
        ?>
    </div>
</div>

<?php include('footer.php'); ?>
