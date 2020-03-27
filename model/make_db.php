<?php

function get_vehicle_makes() {
    global $db;
    $query = 'SELECT DISTINCT Make FROM vehicles
            ORDER BY Price ASC';
    $statement = $db->prepare($query);
    $statement->execute();
    $Vehicle_Makes = $statement->fetchAll();
    $statement->closeCursor();
    return $Vehicle_Makes;

}


?>