<?php

function get_vehicle_classes() {
    global $db;
    $query = 'SELECT * FROM classes
            ORDER BY Class_code';
    $statement = $db->prepare($query);
    $statement->execute();
    $Vehicle_Classes = $statement->fetchAll();
    $statement->closeCursor();
    return $Vehicle_Classes;

}



function get_vehicle_class_name($Class_code) {
    global $db;
    $Class_code = filter_input(INPUT_GET, 'Class_code', FILTER_VALIDATE_INT);
    $Type_code = filter_input(INPUT_GET, 'Type_code', FILTER_VALIDATE_INT);
    if ($Class_code == NULL || $Class_code == FALSE || $Type_code == NULL || $Type_code == FALSE  ) {
      
        $query = 'SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
        LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY Price DESC'; 
    }else{
        
    $query = 'SELECT * FROM classes
                WHERE Class_code = :Class_code';}
    
    $statement = $db->prepare($query);
    $statement->bindValue(':Class_code', $Class_code);
    $statement->execute();
    $Class = $statement->fetch();
    $statement->closeCursor();
    $Class_name = $Class['Class_name'];
    return $Class_name;

}



function delete_vehicle_class($Class_code) {
    global $db;
    $query = 'DELETE FROM classes
                 WHERE Class_code = :Class_code';
       $statement = $db->prepare($query);
       $statement->bindValue(':Class_code', $Class_code);
       $statement->execute();
       $statement->closeCursor(); 
}



function add_vehicle_class($Class_name) {
    global $db;
    $query = 'INSERT INTO classes
                (Class_name)
                VALUES
                (:Class_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':Class_name', $Class_name);
        $statement->execute();
        $statement->closeCursor();
}       


?>