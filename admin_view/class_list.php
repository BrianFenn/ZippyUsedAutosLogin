<?php include '../view/header.php'; 
?>

<main>
    <h1 style="color: blue">Vehicle Class List</h1>

    
    <section>
        <table>
            <tr>
                <th colspan="2">Name</th>
            </tr>        
            <?php foreach ($Classes as $Class) : ?>
            <tr>
                <td><?php echo $Class['Class_name']; ?></td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_vehicle_class">
                        <input type="hidden" name="Class_code"
                            value="<?php echo $Class['Class_code']; ?>"/>
                        <input type="submit" value="Remove" id="button_delete" class="button red" />
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    </section>


    <section>
        <h2 style="">Add New Class</h2>
        <form action="." method="post" id="add_category_form">
            <input type="hidden" name="action" value="add_vehicle_class">

            <label>Name:</label>
            <input type="text" name="Class_name" max="30" required><br>

            <label>&nbsp;</label>
            <input type="submit" id="button" class="" value="Add Vehicle Class"><br>
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