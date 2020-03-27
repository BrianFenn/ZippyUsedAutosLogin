<?php

function get_vehicle_types() {
    global $db;
    $query = 'SELECT * FROM types
            ORDER BY Type_code';
    $statement = $db->prepare($query);
    $statement->execute();
    $Types = $statement->fetchAll();
    $statement->closeCursor();
    return $Types;

}



function get_vehicle_type_name($Type_code){
    global $db;
    $Class_code = filter_input(INPUT_GET, 'Class_code', FILTER_VALIDATE_INT);
    $Type_code = filter_input(INPUT_GET, 'Type_code', FILTER_VALIDATE_INT);
    if ($Class_code == NULL || $Class_code == FALSE || $Type_code == NULL || $Type_code == FALSE  ) {
      
        $query = 'SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
        LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY Price DESC'; 
    }else{
        
    $query = 'SELECT * FROM types
                WHERE Type_code = :Type_code';}

    $statement = $db->prepare($query);
    $statement->bindValue(':Type_code', $Type_code);
    $statement->execute();
    $Type = $statement->fetch();
    $statement->closeCursor();
    $Type_name = $Type['Type_name'];
    return $Type_name;

}



function delete_vehicle_type($Type_code) {
    global $db;
    $query = 'DELETE FROM types
                 WHERE Type_code = :Type_code';
       $statement = $db->prepare($query);
       $statement->bindValue(':Type_code', $Type_code);
       $statement->execute();
       $statement->closeCursor(); 
}



function add_vehicle_type($Type_name) {
    global $db;
    $query = 'INSERT INTO types
                (Type_name)
                VALUES
                (:Type_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':Type_name', $Type_name);
        $statement->execute();
        $statement->closeCursor();
}       


?>