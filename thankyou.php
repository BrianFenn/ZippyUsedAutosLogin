<?php include 'view/header.php';
// include_once 'index.php';
$firstname = filter_input(INPUT_GET, 'firstname');

$_SESSION['firstname'] = $firstname;
$sessionfirstname = $_SESSION['firstname'];
?>
<link rel="stylesheet" type="text/css"
          href="view/main.css">
<main>
    
    
    <h2>
    <?php 
if ($sessionfirstname == NULL || $sessionfirstname == FALSE) {
    echo "Please go back and register your name";
}
else {
    echo "<h1>Thank you for registering, " . $sessionfirstname . "!</h1>";
    }     
    ?>

    </h2>


    <p class="last_paragraph">
        <a href="index.php?action=list_vehicles">View Vehicle List</a>
    </p>

</main>
<?php include 'view/footer.php'; ?>