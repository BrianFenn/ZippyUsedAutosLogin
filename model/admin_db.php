<?php
function add_admin($username, $password) {
    global $db;
    $query = "SELECT * FROM administrators 
    WHERE username = :username";
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
$statement->execute();
//$result = 
$statement->fetch();

//$rowcount = $statement->rowCount();
//$number_count = $db->query("SELECT count(username) from administrators WHERE username = :username")->fetchColumn();

//echo mysqli_num_rows($result);
//$rows = $result->rowCount(); 

//if ($number_count >= 1) {
//if ($result=mysqli_query($db,$query)) {
  //  $rowcount= mysqli_num_rows($result);
    //if ($rowcount =  0 ) {
    //mysqli_num_rows($result) != 0) {
 // if (sizeof($result) != 0) {   
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'INSERT INTO administrators (username, password)
              VALUES (:username, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $hash);
    $statement->execute();
    $statement->closeCursor();
} //else {    
    
    //$username_exists = True;

   // return $username_exists;
    
//}
//return $rowcount;
//}

function is_valid_admin_login($username, $password) {
    global $db;
  
    $query = 'SELECT password FROM administrators
              WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    if (empty($row['password'])) {
        echo "Please enter a valid password.<br>"; 
        $hash = $row['password'] = NULL;
        //$hash = 0;
        echo ($row['password']);
      } else {
      
    //if (isset($password)) {
    $hash = $row['password'];
    }
     //check is this bracket needs to be moved down one line   
     if (password_verify($password, $hash)) {
         echo 'Password is valid.';
     }  
    return password_verify($password, $hash);
    }

function username_check($username) {
    global $db;
    $query = 'SELECT username FROM administrators
    WHERE username = :username';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
$statement->execute();
$row = $statement->fetch();
$statement->closeCursor();
return $row;
//$row_cnt = $query->num_rows;
//$row_cnt = mysqli_num_rows($row);
}



?>