<?php
    require 'db/db.php';
    $mydb = new myDB();

    $mydb->select('products', '*');
    $product_data = $mydb->res;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/style.css">
    <title>OOP AJAX CRUD</title>
</head>
<body>

    <h1>OOP AJAX CRUD</h1>

    <div>
        <h1>Student Information</h1>
    </div>

    <div class="container">
        <table>
            <thead>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Manufactured Dateeeeee</th>
                <th>Manufacturer</th>
            </thead>

            <form method="POST" action="db/request.php">
                <input type="text" name="product_name" placeholder="Product Name">
                <input type="text" name="product_category" placeholder="Product Category">
                <input type="number" name="product_price" placeholder="Product Price">
                <input type="date" name="manufactured_date" placeholder="Manufactured Date">
                <input type="text" name="manufacturer" placeholder="Manufacturer">
                <button type="submit" name="add_product">Submit</button>
            </form>
        </table>
    </div>

    <br><b>Product List</b><br>

    <?php while ($row = $product_data->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['product_category']; ?></td>
            <td><?php echo $row['product_price']; ?></td>
            <td><?php echo $row['manufactured_date']; ?></td>
            <td><?php echo $row['manufacturer']; ?></td>
        </tr><br>
    <?php endwhile; ?>

</body>
</html>

