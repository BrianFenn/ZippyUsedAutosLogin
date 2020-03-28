<?php include '../view/header.php';

?>



<main>
    <h1>Vehicle Inventory List</h1>
    <?php if ( sizeof($Vehicle_Classes) != 0) { ?>
                <form action="." method="get" id="category_selection">
                <label>Class:</label>
                <select name="Class_code">
                    <option value="0">View All Classes</option>
                    <?php foreach ($Vehicle_Classes as $Class) : ?>
                        <option value="<?php echo $Class['Class_code']; ?>">
                            <?php echo $Class['Class_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
                <?php } ?>
            

            <?php if ( sizeof($Types) != 0) { ?>
                <form action="." method="get" id="category_selection">
                <label>Type:</label>
                <select name="Type_code">
                    <option value="0">View All Types</option>
                    <?php foreach ($Types as $Type) : ?>
                        <option value="<?php echo $Type['Type_code']; ?>">
                            <?php echo $Type['Type_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
                <?php } ?>

            <?php if ( sizeof($Vehicle_Makes) != 0) { ?>
                <form action="." method="get" id="category_selection">
                <label>Make:</label>
                <select name="Make">
                    <option value="0">View All Makes</option>
                    <?php foreach ($Vehicle_Makes as $Make_1) : ?>
                        <option value="<?php echo $Make_1['Make']; ?>">
                            <?php echo $Make_1['Make']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
               
                <div id="sort-inline">
                <p style="margin:0em">Sort by:</p>
                
                    <input type="radio" id="category-selection" name="Sort" value="year">
                    <label id="select-year" for="year">Year</label><br>
                    <input type="radio" id="category-selection" name="Sort" value="price" checked= "checked">
                    <label id="select-year" for="price">Price</label><br>
                    </div>
                <?php } ?>
                
                <input type="submit" value="Submit" id="button" class="button blue">
                </form>
            

        <!-- display a table of vehicles -->
       
<?php if ( sizeof($Vehicles) == 0) { 
    
    echo "Your Search Returned 0 Results, Please Make a New Selection.";
} else { ?>
                
                <div id="table-scroll">          
    <section>    
        
        
        <table>
            <tr>
                
                <th>Year</th>
                <th>Make</th>
                <th>Model</th>
                <th>Price</th>
                <th>Type</th>
                <th class="right">Class</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($Vehicles as $Vehicle) : ?>
            <tr>
                
                <td><?php echo $Vehicle['Vehicle_year']; ?></td>
                <td><?php echo $Vehicle['Make']; ?></td>
                <td><?php echo $Vehicle['Model']; ?></td>
                <td><?php echo $Vehicle['Price']; ?></td>
                <td><?php echo $Vehicle['Type_name']; ?></td>
                <td class="right"><?php echo $Vehicle['Class_name']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_vehicle">
                    <input type="hidden" name="Vehicle_id"
                           value="<?php echo $Vehicle['Vehicle_id']; ?>">
                    <input type="hidden" name="Class_code"
                           value="<?php echo $Vehicle['Class_code']; ?>">
                    <input type="submit" value="Delete" id="button">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
            </div>

            <?php } ?>

        <p class="last_paragraph">
            <br>
            <a href="?action=show_add_form">Add Vehicle</a>
            <br>
            <br>
            <a href="?action=show_view_edit_classes_form">View/Edit Classes</a>
            <br>
            <br>
            <a href="?action=show_view_edit_types_form">View/Edit Types</a>
        </p>
    </section>
</main>
<?php include '../view/footer.php'; ?>