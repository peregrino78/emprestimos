<?php 
$url = $_SERVER['REQUEST_URI'];
$separator = explode('?', $url);

# Verify if exist a Controller for render the index page
if (array_key_exists(1, $separator)) 
{
    $the_controller_name = explode('=', $separator[1]);
    $controller = ucwords($the_controller_name[0]);
    $controller_first_name = "{$controller}";
    
    # Verify if exist Controller or Method in the url
    if (array_key_exists(1, $the_controller_name)) {

         $method_name_only = $the_controller_name[1] .= '&';
         $method_name_only = explode('&', $method_name_only);
         $real_method_name = $method_name_only[0]; 

    } else {
        echo 'The name of the Controller or the name of the Method can be wrong or not exist';
        exit;
    }
}
else 
{   
    # Include the start application file
    require_once('start_application.php');
    $start_application_by = str_replace('.', '=', $start_application_by);

    if ( ! empty($start_application_by)) {
        # Redirect to the first Controller
        header("Location:?{$start_application_by}&p=1");
    } else {
        # Redirect to the first Controller
        header("Location:?home=index&p=1");
    }

    echo 'This Controller not exist';
    exit;
}

# Verify if Controller exist in the folder 'controllers'
if (file_exists("controllers/{$controller_first_name}_Controller.php"))
{
    # Include the Database Class
    require_once("system/database/Database.php");
    
    # Include the Persistence Class
    require_once("system/Persistence.php");

    # Include the Model Class
    require_once("system/Model.php");

    # Include the Controller Class
    require_once("system/Controller.php");

    # Include the Controller that will be called in the url
    require_once("controllers/{$controller_first_name}_Controller.php");
    
    # full name of controller
    $full_name_controller = "{$controller_first_name}_Controller";
    
    # Including the Model autoloader
    require_once("system/loading_models.php");
    
    # Including the Service autoload
    require_once("system/loading_services.php");

    $controller_app = new $full_name_controller(prepare_models_to_instantiate(), prepare_service_to_instantiate());

    # Including the names of the class services
    require_once('register_service.php');
    
    # Start the Session
    Session::start();
    
    # Include private areas file
    require_once('private_areas.php');
    
    # Verify if the Method exist in the Class controller
    if (method_exists($controller_app, $real_method_name)) {

        # Call the methods of the controllers
        $controller_app->$real_method_name();

    } else {
        echo 'This method not exist in this class';
        exit;
    }
} else {
    echo 'This Contoller not exist in this application';
    exit;
}