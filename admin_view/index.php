<?php
    session_start();
    require('../model/database.php');
    require('../model/admin_db.php');
    require('../model/vehicle_db.php');
    require('../model/class_db.php');
    require('../model/type_db.php');
    require('../model/make_db.php');
    
    //require('../admin-register.php');
    $action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_vehicles';
    //if ($action == NULL) {
      //  $action = filter_input(INPUT_GET, 'action');
       // if ($action == NULL) {
           // $action = 'list_vehicles';
        //}
    //}


    if (!isset($_SESSION['is_valid_admin_login'])) {
        $action = 'login';
    }



    switch($action) {
    
    case 'register_admin_user': 
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $confirm_password = filter_input(INPUT_POST, 'confirm_password');
        //username_check($username);
        //$username_exists = False;
        $error_reg = false;
    //is username empty
    if (empty($username)  || strlen($username) <= 5)   {
        $error_username = "Please enter a valid username with at least 6 characters.";
        $error_reg = true;
    } else { empty($error_username); 
        
        
        }

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    if (isset($password) && $uppercase && $lowercase && $number && strlen($password) > 7) {
        empty($error_password);
        
    }else { empty($error_password);
        $error_password = "Password must be at least: 1 uppercase and 1 lowercase letter, 1 number, and a minimum of 8 characters long.";
        $error_reg = true;
        }

    if ($confirm_password == $password) {
        empty($error_confirm_password);
        
       
    }else { $error_confirm_password = "The passwords you entered do not match.";
        $error_reg = true;
        }

        if ($error_reg == false) {
            username_check($username);
            if (empty(username_check($username))) {
                //$username_exists = True;
                add_admin($username,$password);
                include('../admin-login.php');
            } else { 
                $user_name_exists = "Username is taken.";
                include('../admin-register.php');
            }
        }
        if ($error_reg == True) {
            include('../admin-register.php');
            
        }

        //add_admin($username,$password);
       // if ($username_exists == False) {
        //goto admin page
        //}
        //}else { 
           
          //  include('../admin-register.php');
            //echo "Username already exists.";
        
        //echo $rowcount;
        //username_check($username); 
        //echo $row;
        break;
    


    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_admin_login($username, $password)) {
            $_SESSION['is_valid_admin_login'] = true;
            $Class_code = filter_input(INPUT_GET, 'Class_code', FILTER_VALIDATE_INT);
        $Type_code = filter_input(INPUT_GET, 'Type_code', FILTER_VALIDATE_INT);
        $Make = filter_input(INPUT_GET, 'Make');
        $Sort = filter_input(INPUT_GET, 'Sort');
        $Vehicles = get_vehicles_by_selection($Class_code,$Type_code,$Make); 

        
        // call the functions
        $Class_name = get_vehicle_class_name($Class_code);
        $Vehicle_Classes = get_vehicle_classes();

        $Types = get_vehicle_types();
        $Type_name = get_vehicle_type_name($Type_code);

        $Vehicle_Makes = get_vehicle_makes();
            include('vehicle_list.php');
        } else {
            $login_message = 'You must login to view this page.';
            
            include('../admin-login.php');
        }
    break;

    
    case 'register_user':
        
        include('../admin-register.php');
    break;

    case 'admin_logout':
        $_SESSION = array();
        session_destroy();
        $login_message = 'You have been logged out.';
        include('../admin-login.php');
    break;

        
    case 'list_vehicles':
        $Class_code = filter_input(INPUT_GET, 'Class_code', FILTER_VALIDATE_INT);
        $Type_code = filter_input(INPUT_GET, 'Type_code', FILTER_VALIDATE_INT);
        $Make = filter_input(INPUT_GET, 'Make');
        $Sort = filter_input(INPUT_GET, 'Sort');

        
        // call the functions
        $Class_name = get_vehicle_class_name($Class_code);
        $Vehicle_Classes = get_vehicle_classes();

        $Types = get_vehicle_types();
        $Type_name = get_vehicle_type_name($Type_code);

        $Vehicle_Makes = get_vehicle_makes();

        
        
        
        //$Vehicles = get_vehicles_by_class($Class_code);
        
        //if ( $Class_code != 0 && $Type_code != 0 && $Make != 0) {
            //$Vehicles = get_vehicles_by_class($Class_code);
            //$Vehicles = get_all_vehicles(get_vehicles_by_class($Class_code,get_vehicles_by_type($Type_code,get_vehicles_by_make($Make))));
        //}

        $Vehicles = get_vehicles_by_selection($Class_code,$Type_code,$Make); 
        //Refined_Vehicle_Results = get_all_vehicles(get_vehicles_by_class(get_vehicles_by_type(get_vehicles_by_make())));
        //$Vehicles = get_all_vehicles(get_vehicles_by_class($Class_code,get_vehicles_by_type($Type_code,get_vehicles_by_make($Make))));
        
        include('vehicle_list.php');
    break;
    
    case 'list_classes':
        $Vehicle_Classes = get_vehicle_classes();
        include('class_list.php');
    break;

    case 'delete_vehicle':
        $Vehicle_id = filter_input(INPUT_POST, 'Vehicle_id', FILTER_VALIDATE_INT);
        if (empty($Vehicle_id) ) {
            $error = "Missing or incorrect Vehicle id.";
            include('../errors/error.php');
        } else {
            delete_vehicle($Vehicle_id);
            header("Location: .?Class_code=$Class_code");
        }
    break;

    case 'delete_vehicle_class':
        $Class_code = filter_input(INPUT_POST, 'Class_code', FILTER_VALIDATE_INT);
        if (empty($Class_code)) {
            $error = "Missing or incorrect Class code.";
            include('../errors/error.php');
        } else {
            delete_vehicle_class($Class_code);
            header("Location: .?action=show_view_edit_classes_form");
        }
    break;

    case 'show_add_form':
        $Class_code = filter_input(INPUT_GET, 'Class_code', FILTER_VALIDATE_INT);
        $Type_code = filter_input(INPUT_GET, 'Type_code', FILTER_VALIDATE_INT);
        
        
        $Vehicle_Classes = get_vehicle_classes();
        //$Class_name = get_vehicle_class_name($Class_code);
        $Types = get_vehicle_types();
        //$Type_name = get_vehicle_type_name($Type_code);
       
        // call the functions
        include('vehicle_add.php');
    break;

    case 'add_vehicle':
        $Vehicle_year = filter_input(INPUT_POST, 'Vehicle_year');
        $Make = filter_input(INPUT_POST, 'Make');
        $Model = filter_input(INPUT_POST, 'Model');
        $Price = filter_input(INPUT_POST, 'Price');
        $Type_code = filter_input(INPUT_POST, 'Type_code', FILTER_VALIDATE_INT);
        $Class_code = filter_input(INPUT_POST, 'Class_code', FILTER_VALIDATE_INT);
        
        //if ($Vehicle_year == NULL || $Vehicle_year == FALSE || $Make == NULL || $Make == FALSE || $Model == NULL || $Model == FALSE || $Price == NULL || $Price == FALSE || $Type_code == NULL || $Type_code == FALSE || $Class_code == NULL || $Class_code == FALSE) 
        //{
          //  $error = "Invalid vehicle data. Check all fields and try again.";
            //include('errors/error.php');
        //} else {
            add_vehicle($Vehicle_year, $Make, $Model, $Price, $Type_code, $Class_code);
            header("Location: .?Class_code=$Class_code");
        //}
    break;

    case 'add_vehicle_class':
            
        $Class_name = filter_input(INPUT_POST, 'Class_name');
        add_vehicle_class($Class_name);
        header("Location: .?action=show_view_edit_classes_form");
    break;

    case 'show_view_edit_classes_form':
        $Class_code = filter_input(INPUT_GET, 'Class_code', 
        FILTER_VALIDATE_INT);
        $Classes = get_vehicle_classes();

        include('class_list.php'); 
    break;

    case 'add_vehicle_type':
        $Type_name = filter_input(INPUT_POST, 'Type_name');
        add_vehicle_Type($Type_name);
        header("Location: .?action=show_view_edit_types_form");

    break;

    case 'delete_vehicle_type':
        $Type_code = filter_input(INPUT_POST, 'Type_code', FILTER_VALIDATE_INT);
        if (empty($Type_code)) {
            $error = "Missing or incorrect Type code.";
            include('../errors/error.php');
        } else {
            delete_vehicle_type($Type_code);
            header("Location: .?action=show_view_edit_types_form");
        }
    break;

    case 'show_view_edit_types_form':
        $Type_code = filter_input(INPUT_GET, 'Type_code', 
        FILTER_VALIDATE_INT);
        $Types = get_vehicle_types();

        include('type_list.php'); 
    break;
    }



?> 

   