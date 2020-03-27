<?php include '../view/header.php'; 
?>

<main>
    <h1>Vehicle Type List</h1>

    
    <section>
        <table>
            <tr>
                <th colspan="2">Name</th>
            </tr>        
            <?php foreach ($Types as $Type) : ?>
            <tr>
                <td><?php echo $Type['Type_name']; ?></td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_vehicle_type">
                        <input type="hidden" name="Type_code"
                            value="<?php echo $Type['Type_code']; ?>"/>
                        <input type="submit" value="Remove" id="button_delete" />
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    </section>


    <section>
        <h2 >Add Vehicle Type</h2>
        <form action="." method="post" id="add_category_form">
            <input type="hidden" name="action" value="add_vehicle_type">

            <label>Name:</label>
            <input type="text" name="Type_name" max="30" required><br>

            <label>&nbsp;</label>
            <input type="submit" id="button" value="Add Vehicle Type"><br>
        </form>
    </section>
    <section>
        <p><a href="index.php">View Vehicle Inventory</a></p>
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Zippy Used Autos </p>
</footer>
</body>
</html>