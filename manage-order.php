<?php 
include('constants.php');
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .main-content {
        max-width: 1200px;
        margin: auto;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .message {
        padding: 10px;
        margin: 15px 0;
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
    }

    .tbl-full {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .tbl-full th, .tbl-full td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .tbl-full th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
    }

    .tbl-full tr:hover {
        background-color: #f1f1f1;
    }

    .btn-secondary {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn-secondary:hover {
        background-color: #0056b3;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
        font-size: 0.9em;
        color: #777;
    }
</style>

<div class="main-content">
    <h1>Manage Orders</h1>

    <?php 
        if (isset($_SESSION['update'])) {
            echo "<div class='message success'>{$_SESSION['update']}</div>";
            unset($_SESSION['update']);
        }
    ?>

    <table class="tbl-full">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Get all the orders from database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // Display the Latest Order at First
                // Execute Query
                $res = mysqli_query($conn, $sql);
                // Count the Rows
                $count = mysqli_num_rows($res);

                $sn = 1; // Create a Serial Number and set its initial value as 1

                if ($count > 0) {
                    // Order Available
                    while ($row = mysqli_fetch_assoc($res)) {
                        // Get all the order details
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo htmlspecialchars($food); ?></td>
                            <td><?php echo number_format($price, 2); ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo number_format($total, 2); ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <?php 
                                    // Status colors
                                    switch ($status) {
                                        case "Ordered":
                                            echo "<label>$status</label>";
                                            break;
                                        case "On Delivery":
                                            echo "<label style='color: orange;'>$status</label>";
                                            break;
                                        case "Delivered":
                                            echo "<label style='color: green;'>$status</label>";
                                            break;
                                        case "Cancelled":
                                            echo "<label style='color: red;'>$status</label>";
                                            break;
                                    }
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($customer_name); ?></td>
                            <td><?php echo htmlspecialchars($customer_contact); ?></td>
                            <td><?php echo htmlspecialchars($customer_email); ?></td>
                            <td><?php echo htmlspecialchars($customer_address); ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    // Order not Available
                    echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                }
            ?>
        </tbody>
    </table>

    </div>
<?php
include('footer.php');
?>