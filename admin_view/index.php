<?php
    require('../model/database.php');
    require('../model/vehicle_db.php');
    require('../model/class_db.php');
    require('../model/type_db.php');
    require('../model/make_db.php');

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'list_vehicles';
        }
    }

        
    if ($action == 'list_vehicles') {
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
    }else if ($action == 'list_classes') {
        $Vehicle_Classes = get_vehicle_classes();
        include('class_list.php');


    } else if ($action == 'delete_vehicle') {
        $Vehicle_id = filter_input(INPUT_POST, 'Vehicle_id', FILTER_VALIDATE_INT);
        if ($Vehicle_id == NULL || $Vehicle_id == FALSE) {
            $error = "Missing or incorrect Vehicle id.";
            include('../errors/error.php');
        } else {
            delete_vehicle($Vehicle_id);
            header("Location: .?Class_code=$Class_code");
        }
    } else if ($action == 'delete_vehicle_class') {
        $Class_code = filter_input(INPUT_POST, 'Class_code', FILTER_VALIDATE_INT);
        if ($Class_code == NULL || $Class_code == FALSE) {
            $error = "Missing or incorrect Class code.";
            include('../errors/error.php');
        } else {
            delete_vehicle_class($Class_code);
            header("Location: .?action=show_view_edit_classes_form");
        }
    } else if ($action == 'show_add_form') {
        $Class_code = filter_input(INPUT_GET, 'Class_code', FILTER_VALIDATE_INT);
        $Type_code = filter_input(INPUT_GET, 'Type_code', FILTER_VALIDATE_INT);
        
        
        $Vehicle_Classes = get_vehicle_classes();
        //$Class_name = get_vehicle_class_name($Class_code);
        $Types = get_vehicle_types();
        //$Type_name = get_vehicle_type_name($Type_code);
       
        // call the functions
        include('vehicle_add.php');

    } else if ($action == 'add_vehicle') {
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
    } else if ($action == 'add_vehicle_class') {
            
        $Class_name = filter_input(INPUT_POST, 'Class_name');
        add_vehicle_class($Class_name);
        header("Location: .?action=show_view_edit_classes_form");}
    

    else if ($action == 'show_view_edit_classes_form') {
        $Class_code = filter_input(INPUT_GET, 'Class_code', 
        FILTER_VALIDATE_INT);
        $Classes = get_vehicle_classes();

        include('class_list.php'); 
        } else if ($action == 'add_vehicle_type') {
        $Type_name = filter_input(INPUT_POST, 'Type_name');
        add_vehicle_Type($Type_name);
        header("Location: .?action=show_view_edit_types_form");

    }else if ($action == 'delete_vehicle_type') {
        $Type_code = filter_input(INPUT_POST, 'Type_code', FILTER_VALIDATE_INT);
        if ($Type_code == NULL || $Type_code == FALSE) {
            $error = "Missing or incorrect Type code.";
            include('../errors/error.php');
        } else {
            delete_vehicle_type($Type_code);
            header("Location: .?action=show_view_edit_types_form");
        }
    }

    else if ($action == 'show_view_edit_types_form') {
        $Type_code = filter_input(INPUT_GET, 'Type_code', 
        FILTER_VALIDATE_INT);
        $Types = get_vehicle_types();

        include('type_list.php'); 
    }

?> 

   