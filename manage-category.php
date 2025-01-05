<head>
    <link rel="stylesheet" type="text/css" href="all.css">
    <style>
        /* Place your CSS styles here or link an external CSS file */
    </style>
</head><?php include('constants.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br /><br />
        
        <!-- Display session messages -->
        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found'])) {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove'])) {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>
        
        <br><br>

        <!-- Button to Add Category -->
        <a href="<?php echo SITEURL; ?>add-category.php" class="btn-primary">Add Category</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
                // Query to Get all Categories from Database
                $sql = "SELECT * FROM tbl_category";
                
                // Execute Query
                $res = mysqli_query($conn, $sql);
                
                // Count Rows
                $count = mysqli_num_rows($res);
                
                // Create Serial Number Variable and assign value as 1
                $sn = 1;

                // Check whether we have data in database or not
                if($count > 0) {
                    // We have data in database
                    // Get the data and display
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php  
                                    // Check whether image name is available or not
                                    if($image_name != "") {
                                        // Display the Image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                    } else {
                                        // Display the Message
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update              Category</a><br><br><br>
                                <a href="<?php echo SITEURL; ?>delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete           Category</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // We do not have data
                    // We'll display the message inside table
                    ?>
                    <tr>
                        <td colspan="6"><div class='error'>No Category Added.</div></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>

