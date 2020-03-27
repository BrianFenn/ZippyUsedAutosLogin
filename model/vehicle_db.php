<?php


function get_all_vehicles() {
    global $db;
    $Sort = filter_input(INPUT_GET, 'Sort');

    //$query1 = 'SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
    //LEFT JOIN types T ON V.Type_code = T.Type_code';
    
    if ($Sort == 'year') {
        
            $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
            LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Vehicle_year DESC";
    }else{  
        $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
        LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Price DESC";
    }
    
    $statement = $db->prepare($query1);
    $statement->execute();
    $all_vehicles = $statement->fetchAll();
    $statement->closeCursor();
    return $all_vehicles;
}

function get_vehicles_by_class($Class_code) {
    $Class_code = filter_input(INPUT_GET, 'Class_code', FILTER_VALIDATE_INT);
    $Sort = filter_input(INPUT_GET, 'Sort');
    global $db;
    if ($Class_code == NULL || $Class_code == FALSE) {

        if ($Sort == 'year') {
            
                $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
                LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Vehicle_year DESC";     
        } else {
        $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
        LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Price DESC";   
        } 
    $statement = $db->prepare($query1);
    $statement->bindValue(":Class_code", $Class_code);
    $statement->execute();
    $all_vehicles_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_vehicles_list;

   
} else {
    global $db;
    //$query = 'SELECT * FROM vehicles
    //WHERE vehicles.Class_code = :Class_code
    //ORDER BY Price DESC';
    if ($Sort == 'year') {
        
            $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
            LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = :Class_code ORDER BY V.Vehicle_year DESC";     
    } else {
    $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
    LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = :Class_code ORDER BY V.Price DESC";   
    } 
    }
    $statement = $db->prepare($query1);
    $statement->bindValue(":Class_code", $Class_code);
    $statement->execute();
    $all_vehicles_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_vehicles_list;
}


function get_vehicle($Vehicle_id) {
    global $db;
    $query = 'SELECT * FROM vehicles
                WHERE Vehicle_id = :Vehicle_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":Vehicle_id", $Vehicle_id);
    $statement->execute();
    $vehicle = $statement->fetch();
    $statement->closeCursor();
    return $vehicle;
}

function delete_vehicle($Vehicle_id) {
    global $db;
    $query = 'DELETE FROM vehicles
                WHERE Vehicle_id = :Vehicle_id';
                $statement = $db->prepare($query);
    $statement->bindValue(':Vehicle_id', $Vehicle_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_vehicle($Vehicle_year, $Make, $Model, $Price, $Type_code, $Class_code) {
    global $db;
    $query = 'INSERT INTO vehicles
                (Vehicle_year, Make, Model, Price, Type_code, Class_code)
                VALUES
                (:Vehicle_year, :Make, :Model, :Price, :Type_code, :Class_code)';
    $statement = $db->prepare($query);
    $statement->bindValue(':Vehicle_year', $Vehicle_year);
    $statement->bindValue(':Make', $Make);
    $statement->bindValue(':Model', $Model);
    $statement->bindValue(':Price', $Price);
    $statement->bindValue(':Type_code', $Type_code);
    $statement->bindValue(':Class_code', $Class_code);
    $statement->execute();
    $statement->closeCursor();
}

function get_vehicles_by_type($Type_code) {
    global $db;
    $Type_code = filter_input(INPUT_GET, 'Type_code', FILTER_VALIDATE_INT);
    $Sort = filter_input(INPUT_GET, 'Sort');
    if ($Type_code == NULL || $Type_code == FALSE) {
        if ($Sort == 'year') {
        
            $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
            LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Vehicle_year DESC";     
    } else {
    $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
    LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Price DESC";   
    } 
      
    $statement = $db->prepare($query1);
    $statement->bindValue(":Type_code", $Type_code);
    $statement->execute();
    $all_vehicles_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_vehicles_list;
} else {
    global $db;
    if ($Sort == 'year') {
        
        $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
        LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Type_code = :Type_code ORDER BY V.Vehicle_year DESC";     
} else {
$query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Type_code = :Type_code ORDER BY V.Price DESC";   
} 

    $statement = $db->prepare($query1);
    $statement->bindValue(":Type_code", $Type_code);
    $statement->execute();
    $all_vehicles_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_vehicles_list;
}
}
function get_vehicles_by_make($Make) {
    global $db;
    $Make = filter_input(INPUT_GET, 'Make');
    $Sort = filter_input(INPUT_GET, 'Sort');
    if ($Make == NULL || $Make == FALSE) {
        if ($Sort == 'year') {
        
            $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
            LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Vehicle_year DESC";     
    } else {
    $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
    LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Price DESC";   
    } 
    $statement = $db->prepare($query1);
    $statement->bindValue(":Make", $Make);
    $statement->execute();
    $all_vehicles_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_vehicles_list;
} else {
    global $db;
    if ($Sort == 'year') {
        
        $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
        LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Make = :Make ORDER BY V.Vehicle_year DESC";     
} else {
$query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Make = :Make ORDER BY V.Price DESC";   
} 
    $statement = $db->prepare($query1);
    $statement->bindValue(":Make", $Make);
    $statement->execute();
    $all_vehicles_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_vehicles_list;
}
}

$Class_code = filter_input(INPUT_GET, 'Class_code');
    $Type_code = filter_input(INPUT_GET, 'Type_code');
    $Make = filter_input(INPUT_GET, 'Make');
    $Sort = filter_input(INPUT_GET, 'Sort');

if (($Class_code != 0 || $Class_code != FALSE) && ($Type_code != 0 || $Type_code != FALSE) && ($Make != 0 || $Make != FALSE)) {

function get_vehicles_by_selection($Class_code,$Type_code,$Make) {
    global $db;
    $Class_code = filter_input(INPUT_GET, 'Class_code');
    $Type_code = filter_input(INPUT_GET, 'Type_code');
    $Make = filter_input(INPUT_GET, 'Make');
    $Sort = filter_input(INPUT_GET, 'Sort');
    if ($Sort == 'year') {
        
       $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
        LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = ? AND V.Type_code = ? AND V.Make = ? ORDER BY V.Vehicle_year DESC";   
} else {
    $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
    LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = ? AND V.Type_code = ? AND V.Make = ? ORDER BY V.Price DESC";   
    
}

    $statement = $db->prepare($query1);
    $statement->bindValue(1, $Class_code, PDO::PARAM_INT);
    $statement->bindValue(2, $Type_code,PDO::PARAM_INT );
    $statement->bindValue(3, $Make, PDO::PARAM_STR);
    $statement->execute();
    $all_vehicles_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_vehicles_list;
}    


} else if (($Class_code == 0 || $Class_code == FALSE) && ($Type_code != 0 || $Type_code != FALSE) && ($Make != 0 || $Make != FALSE)) {
    function get_vehicles_by_selection($Type_code,$Make) {
        global $db;
        $Class_code = filter_input(INPUT_GET, 'Class_code');
        $Type_code = filter_input(INPUT_GET, 'Type_code');
        $Make = filter_input(INPUT_GET, 'Make');
        $Sort = filter_input(INPUT_GET, 'Sort');
        if ($Sort == 'year') {
            
           $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
            LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Type_code = ? AND V.Make = ? ORDER BY V.Vehicle_year DESC";   
    } else {
        $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
            LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Type_code = ? AND V.Make = ? ORDER BY V.Price DESC";   
        
    }
    
        $statement = $db->prepare($query1);
        $statement->bindValue(1, $Type_code,PDO::PARAM_INT );
        $statement->bindValue(2, $Make, PDO::PARAM_STR);
        $statement->execute();
        $all_vehicles_list = $statement->fetchAll();
        $statement->closeCursor();
        return $all_vehicles_list;
    }    

} else if (($Class_code == 0 || $Class_code == FALSE) && ($Type_code == 0 || $Type_code == FALSE) && ($Make != 0 || $Make != FALSE) ) {

function get_vehicles_by_selection($Make) {
    global $db;
    $Class_code = filter_input(INPUT_GET, 'Class_code');
    $Type_code = filter_input(INPUT_GET, 'Type_code');
    $Make = filter_input(INPUT_GET, 'Make');
    $Sort = filter_input(INPUT_GET, 'Sort');
    if ($Sort == 'year') {
        
       $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
        LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Make = ? ORDER BY V.Vehicle_year DESC";   
} else {
    $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
        LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Make = ? ORDER BY V.Price DESC";   
    
}

    $statement = $db->prepare($query1);
    $statement->bindValue(1, $Make, PDO::PARAM_STR);
    $statement->execute();
    $all_vehicles_list = $statement->fetchAll();
    $statement->closeCursor();
    return $all_vehicles_list;
}    
} else if (($Class_code != 0 || $Class_code != FALSE) && ($Type_code == 0 || $Type_code == FALSE) && ($Make != 0 || $Make != FALSE) ) {

    function get_vehicles_by_selection($Class_code,$Type_code,$Make) {
        global $db;
        $Class_code = filter_input(INPUT_GET, 'Class_code');
        $Type_code = filter_input(INPUT_GET, 'Type_code');
        $Make = filter_input(INPUT_GET, 'Make');
        $Sort = filter_input(INPUT_GET, 'Sort');
        if ($Sort == 'year') {
            
           $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
            LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = ? AND V.Make = ? ORDER BY V.Vehicle_year DESC";   
    } else {
        $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
            LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = ? AND V.Make = ? ORDER BY V.Price DESC";   
        
    }
    
        $statement = $db->prepare($query1);
        $statement->bindValue(1, $Class_code, PDO::PARAM_INT);
        $statement->bindValue(2, $Make, PDO::PARAM_STR);
        $statement->execute();
        $all_vehicles_list = $statement->fetchAll();
        $statement->closeCursor();
        return $all_vehicles_list;
    }    
    } else if (($Class_code != 0 || $Class_code != FALSE) && ($Type_code != 0 || $Type_code != FALSE) && ($Make == 0 || $Make == FALSE) ) {

        function get_vehicles_by_selection($Class_code,$Type_code,$Make) {
            global $db;
            
            $Class_code = filter_input(INPUT_GET, 'Class_code');
            $Type_code = filter_input(INPUT_GET, 'Type_code');
            $Make = filter_input(INPUT_GET, 'Make');
            $Sort = filter_input(INPUT_GET, 'Sort');
            if ($Sort == 'year') {
                
               $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
                LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = ? AND V.Type_code = ? ORDER BY V.Vehicle_year DESC";   
        } else {
            $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
                LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = ? AND V.Type_code = ? ORDER BY V.Price DESC";   
            
        }
        
            $statement = $db->prepare($query1);
            $statement->bindValue(1, $Class_code, PDO::PARAM_INT);
            $statement->bindValue(2, $Type_code, PDO::PARAM_INT );
            $statement->execute();
            $all_vehicles_list = $statement->fetchAll();
            $statement->closeCursor();
            return $all_vehicles_list;
        }    
        } else if (($Class_code != 0 || $Class_code != FALSE) && ($Type_code == 0 || $Type_code == FALSE) && ($Make == 0 || $Make == FALSE) ) {

            function get_vehicles_by_selection($Class_code,$Type_code,$Make) {
                global $db;
                
                $Class_code = filter_input(INPUT_GET, 'Class_code');
                $Type_code = filter_input(INPUT_GET, 'Type_code');
                $Make = filter_input(INPUT_GET, 'Make');
                $Sort = filter_input(INPUT_GET, 'Sort');
                if ($Sort == 'year') {
                    
                   $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
                    LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = ? ORDER BY V.Vehicle_year DESC";   
            } else {
                $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
                    LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Class_code = ? ORDER BY V.Price DESC";   
                
            }
            
                $statement = $db->prepare($query1);
                $statement->bindValue(1, $Class_code, PDO::PARAM_INT);
                $statement->execute();
                $all_vehicles_list = $statement->fetchAll();
                $statement->closeCursor();
                return $all_vehicles_list;
            }    
            } else if (($Class_code == 0 || $Class_code == FALSE) && ($Type_code != 0 || $Type_code != FALSE) && ($Make == 0 || $Make == FALSE) ) {

                function get_vehicles_by_selection($Class_code,$Type_code,$Make) {
                    global $db;
                    
                    $Class_code = filter_input(INPUT_GET, 'Class_code');
                    $Type_code = filter_input(INPUT_GET, 'Type_code');
                    $Make = filter_input(INPUT_GET, 'Make');
                    $Sort = filter_input(INPUT_GET, 'Sort');
                    if ($Sort == 'year') {
                        
                       $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
                        LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Type_code = ? ORDER BY V.Vehicle_year DESC";   
                } else {
                    $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
                        LEFT JOIN types T ON V.Type_code = T.Type_code WHERE V.Type_code = ? ORDER BY V.Price DESC";   
                    
                }
                
                    $statement = $db->prepare($query1);
                    $statement->bindValue(1, $Type_code,PDO::PARAM_INT );
                    $statement->execute();
                    $all_vehicles_list = $statement->fetchAll();
                    $statement->closeCursor();
                    return $all_vehicles_list;
                }    
                }else if (($Class_code == 0 || $Class_code == FALSE) && ($Type_code == 0 || $Type_code == FALSE) && ($Make == 0 || $Make == FALSE) ) {

                    function get_vehicles_by_selection($Class_code,$Type_code,$Make) {
                        global $db;
                        
                        $Class_code = filter_input(INPUT_GET, 'Class_code');
                        $Type_code = filter_input(INPUT_GET, 'Type_code');
                        $Make = filter_input(INPUT_GET, 'Make');
                        $Sort = filter_input(INPUT_GET, 'Sort');
                        if ($Sort == 'year') {
                            
                           $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
                            LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Vehicle_year DESC";   
                    } else {
                        $query1 = "SELECT V.Vehicle_id, V.Vehicle_year, V.Make, V.Model, V.Price, T.Type_name, C.Class_name FROM vehicles V LEFT JOIN classes C ON V.Class_code = C.Class_code 
                            LEFT JOIN types T ON V.Type_code = T.Type_code ORDER BY V.Price DESC";   
                        
                    }
                    
                        $statement = $db->prepare($query1);
                        $statement->execute();
                        $all_vehicles_list = $statement->fetchAll();
                        $statement->closeCursor();
                        return $all_vehicles_list;
                    }    
                    }
    

?>