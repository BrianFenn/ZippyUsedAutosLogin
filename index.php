<?php
    session_start();
    require('model/database.php');
    require('model/vehicle_db.php');
    require('model/class_db.php');
    require('model/type_db.php');
    require('model/make_db.php');
   

    $action = filter_input(INPUT_GET, 'action');
    //$firstname = filter_input(INPUT_GET,'firstname');
    
    $lifetime = 60 * 60 * 24; 
    //session_set_cookie_params($lifetime, '/');
    //session_name('login');
    
    //session_write_close();
    
    //if (isset($_SESSION['firstname'] )) {
      //  $sessionfirstname = $_SESSION['firstname'];
     //};
     if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'list_vehicles';
        }
        
    }
    switch($action) {

    case 'register_customer':
        $firstname = filter_input(INPUT_GET, 'firstname');
           
        //session_regenerate_id();
        //setting up the session cookie
       
        //end of setup for session cookie, now I can assign session variables
        
        //session_name('login');
        
        //session_write_close();


        $_SESSION['firstname'] = $firstname;
        $sessionfirstname = $_SESSION['firstname'];
        //session_start();
        include('thankyou.php');
    break;    
    

    
        $removecookie = function () {
            $sessionfirstname = $_SESSION['firstname'];
        //$_SESSION = array();
        //unset($_SESSION['firstname']);
        //session_destroy();
        //session_commit();
        //$_SESSION = array();
        //$name = session_name();
        //$expire = strtotime('-1 year');
        //$params = session_get_cookie_params();
        //$path = $params['/'];
        //$domain = $params['domain'];
        //$secure = $params['secure'];
        //$httponly = $params['httponly'];
        
        //setcookie($name, '', time() -3600, $path);
        };
/*
    if ($action == 'signout') {
        $firstname = filter_input(INPUT_GET, 'firstname');
        //$firstname = $_SESSION['firstname'];
        unset($_SESSION['login']);
        session_destroy();
                //, $path, $domain, $secure, $httponly);
        //session_regenerate_id();
        if (session_status() == PHP_SESSION_ACTIVE){ session_destroy();}
        
        $_SESSION = [];
        session_start();
        $_SESSION = array();
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name('login'), '', 0, '/');
        //session_regenerate_id(true);
        //include('signout.php');
        
    }
*/

  
  

       
    case 'list_vehicles':
        $Class_code = filter_input(INPUT_GET, 'Class_code', FILTER_VALIDATE_INT);
        $Type_code = filter_input(INPUT_GET, 'Type_code', FILTER_VALIDATE_INT);
        $Make = filter_input(INPUT_GET, 'Make');
        $Sort = filter_input(INPUT_GET, 'Sort');

        $Vehicle_Makes = get_vehicle_makes();

        
        // call the functions
        $Class_name = get_vehicle_class_name($Class_code);
        $Vehicle_Classes = get_vehicle_classes();

        $Types = get_vehicle_types();
        $Type_name = get_vehicle_type_name($Type_code);

        $Vehicles = get_vehicles_by_selection($Class_code,$Type_code,$Make); 
        include('vehicle_list.php'); 
    break;
        
        
        //$Vehicles = get_vehicles_by_class($Class_code);
        
        //if ( $Class_code != 0 && $Type_code != 0 && $Make != 0) {
            //$Vehicles = get_vehicles_by_class($Class_code);
            //$Vehicles = get_all_vehicles(get_vehicles_by_class($Class_code,get_vehicles_by_type($Type_code,get_vehicles_by_make($Make))));
        //}

        //$Vehicles = get_vehicles_by_selection(); 
        //Refined_Vehicle_Results = get_all_vehicles(get_vehicles_by_class(get_vehicles_by_type(get_vehicles_by_make())));
        //$Vehicles = get_all_vehicles(get_vehicles_by_class($Class_code,get_vehicles_by_type($Type_code,get_vehicles_by_make($Make))));
        
        //include('vehicle_list.php');
    
}
?> 

   