<?php
include "db.php";
$res = mysqli_query($conn, "SELECT * FROM eproduct");
$product = mysqli_fetch_all($res, MYSQLI_ASSOC);

?>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f6fa;
        padding: 30px;
    }

    .container {
        width: 80%;
        margin: auto;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    .add-btn {
        display: inline-block;
        background: #007bff;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .add-btn:hover {
        background: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    th {
        background: #343a40;
        color: white;
        padding: 12px;
        text-align: left;
    }

    td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background: #f1f1f1;
    }

    .edit {
        color: #007bff;
        text-decoration: none;
        margin-right: 10px;
    }

    .delete {
        color: #dc3545;
        text-decoration: none;
    }
</style>

<div class="container">

    <h2>Product List</h2>

    <a href="addproduct.php" class="add-btn">+ Add New Product</a>

    <table>

        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php foreach($product as $x) { ?>

        <tr>
            <td><?php echo $x['id']; ?></td>

            <td><?php echo $x['p_brand']; ?></td>

            <td><?php echo $x['p_name']; ?></td>

            <td>₹<?php echo $x['p_price']; ?></td>

            <td>
                <a href="editproduct.php" class="edit">Edit</a>
                <a href="deleteproduct.php" class="delete">Delete</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>
