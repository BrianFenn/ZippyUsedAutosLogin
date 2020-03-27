<?php include 'view/header_customer_view.php';

?>



<main>
    <h1>Vehicle Inventory List</h1>
    <?php if ( sizeof($Vehicle_Classes) != 0) { ?>
                <form action="." method="get" id="category_selection">
                <div id="hide_select">
                <label>Class:</label>
                <select name="Class_code">
                    <option  onclick="hideMenu()" value="0">View All Classes</option>
                    <?php foreach ($Vehicle_Classes as $Class) : ?>
                        <option onclick="hideMenu()" value="<?php echo $Class['Class_code']; ?>">
                            <?php echo $Class['Class_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
                <?php } ?>
            

            <?php if ( sizeof($Types) != 0) { ?>
                
                <label>Type:</label>
                <select name="Type_code">
                    <option onclick="hideMenu()"  value="0">View All Types</option>
                    <?php foreach ($Types as $Type) : ?>
                        <option onclick="hideMenu()"  value="<?php echo $Type['Type_code']; ?>">
                            <?php echo $Type['Type_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
                <?php } ?>

            <?php if ( sizeof($Vehicle_Makes) != 0) { ?>
              
                <label>Make:</label>
                <select name="Make" >
                    <option onclick="hideMenu()" value="0">View All Makes</option>
                    <?php foreach ($Vehicle_Makes as $Make) : ?>
                        <option onclick="hideMenu()" value="<?php echo $Make['Make']; ?>">
                            <?php echo $Make['Make']; ?>
                        </option>
                    <?php endforeach; ?>
                </select> 
                        <!--END OF hide_select-->
                        </div>

                <p>Sort by:</p>
                    <input type="radio" id="category_selection" name="Sort" value="year">
                    <label for="year">Year</label><br>
                    <input type="radio" id="category_selection" name="Sort" value="price" checked= "checked">
                    <label for="price">Price</label><br>

                <?php } ?>

                <input type="submit" value="Submit" id="button" class="button blue">
                </form>
            



        <!-- display a table of vehicles -->
       
      

<h2><?php 
if ($Class_code != NULL || $Class_code != FALSE) {
    //$category_id = 1;
    //$all_items = get_all_items();
    //echo "All Vehicles";
    //echo $Class_name;
    //echo $Class['Class_code']; 
} elseif ($Type_code != NULL || $Type_code != FALSE ){
//echo $Type_name;
}
elseif ($Make != NULL || $Make != FALSE ){
    //echo $Type_name;
    }
else{
    echo "All Vehicles";
    }


        
        ?>

    <section>    
        </h2>
        <div id="table-scroll">
        <table>
            <tr>
                
                <th>Year</th>
                <th>Make</th>
                <th>Model</th>
                <th>Price</th>
                <th>Type</th>
                <th class="right">Class</th>
                
            </tr>
            <?php foreach ($Vehicles as $Vehicle) : ?>
            <tr>
                
                <td><?php echo $Vehicle['Vehicle_year']; ?></td>
                <td><?php echo $Vehicle['Make']; ?></td>
                <td><?php echo $Vehicle['Model']; ?></td>
                <td><?php echo $Vehicle['Price']; ?></td>
                <td><?php echo $Vehicle['Type_name']; ?></td>
                <td class="right"><?php echo $Vehicle['Class_name']; ?></td>
                
            </tr>
            <?php endforeach; ?>
        </table>
            </div>
        
    </section>
</main>

<script>
//function hideMenu() {
  //  var x = document.getElementById("hide_select");
    //x.style.display = "none";
//}
</script>

<?php include 'view/footer.php'; ?>