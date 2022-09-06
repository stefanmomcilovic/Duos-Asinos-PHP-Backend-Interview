<?php
require __DIR__."/../models/User.php";
// All your models will be loaded up here and you will just initiate them in the constructor to be able to use them in your controllers //
class Controller {
    
    public function __construct(){
        $this->user = new User();
    }
 
    public function __invoke(){
        // Page $_GET variable to check on what page we are //
        $page = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : "home";
        // Set the title of the page //
        $title = "PHP Backend Developer Test Duos Asinos Interview";

        switch ($page) {
            case "home":
                // Load all needed data for the home page //
                require __DIR__."/../views/includes/main-header.php"; 
                require __DIR__."/../views/includes/main-navigation.php"; 
                    require __DIR__."/../views/home.php"; 
                require __DIR__."/../views/includes/main-footer.php";
            break;

            case "login":
                $title = "Login";
                // Check if user already logged in then redirect them to home page //
                if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                    header("Location: ".PAGE_PATH);
                }
                // Load all needed data for the login page //
                require __DIR__."/../views/includes/main-header.php"; 
                require __DIR__."/../views/includes/main-navigation.php"; 
                    require __DIR__."/../views/includes/components/response-messages.php";
                    require __DIR__."/../views/login.php"; 
                require __DIR__."/../views/includes/main-footer.php";
            break;

            case "register":
                $title = "Register";
                // Check if user already logged in then redirect them to home page //
                if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                    header("Location: ".PAGE_PATH);
                }

                // Load all needed data for the register page //
                require __DIR__."/../views/includes/main-header.php"; 
                require __DIR__."/../views/includes/main-navigation.php"; 
                    require __DIR__."/../views/includes/components/response-messages.php";
                    require __DIR__."/../views/register.php"; 
                require __DIR__."/../views/includes/main-footer.php";
            break;

            case "register__post":
                // Check if user already logged in then redirect them to home page //
                if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                    header("Location: ".PAGE_PATH);
                }

                $register_email = strip_tags(strtolower($_POST['register_email']));
                $register_email_host = explode("@",$register_email);
                $register_email_host = array_pop($register_email_host);
                $register_name = strip_tags(ucwords(strtolower($_POST['register_name'])));
                $register_password = strip_tags($_POST['register_password']);
                $register_password_confirm = strip_tags($_POST['register_password_confirm']);

                if(empty($register_email) || empty($register_name) || empty($register_password) || empty($register_password_confirm)){
                    array_push($_SESSION["errors"], "Please fill in all the fields");
                }else{
                    // Check if email already exists //
                    if($this->user->check_if_email_exists($register_email)){
                        array_push($_SESSION["errors"], "Email already exists");
                    }
                    // Validate email //
                    if(!filter_var($register_email, FILTER_VALIDATE_EMAIL) && !checkdnsrr($register_email_host, 'MX')) {
                        array_push($_SESSION["errors"], "Please enter a valid email address");
                    }
                    // Validate the name and the password for string length //
                    if(strlen($register_name) < 3){
                        array_push($_SESSION["errors"], "Please enter a valid name");
                    }
    
                    if(strlen($register_password) < 8){
                        array_push($_SESSION["errors"], "Please enter a valid password");
                    }

                    // Check if password match
                    if($register_password !== $register_password_confirm){
                        array_push($_SESSION["errors"], "Passwords do not match");
                    }
                }
                // If we have errors return in to register page //
                if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
                    header("Location: ".PAGE_PATH."register");
                }else{
                    // Insert user into the database //
                    $insert = $this->user->register_new_user($register_email, $register_name, $register_password);
                    // If is inserted successfully then show success message //
                    if($insert){
                        array_push($_SESSION["success"], "You have successfully registered");
                        header("Location: ".PAGE_PATH."register");
                    }else{
                        array_push($_SESSION["errors"], "Something went wrong");
                        header("Location: ".PAGE_PATH."register");
                    }
                }
            break;

            case "login__post":
                // Check if user already logged in then redirect them to home page //
                if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                    header("Location: ".PAGE_PATH);
                }
                
                $login_email = strtolower($_POST['login_email']);
                $login_email_host = explode("@",$login_email);
                $login_email_host = array_pop($login_email_host);
                $login_password = $_POST['login_password'];

                // Check if email and password are empty //
                if(empty($login_email) || empty($login_password)){
                    array_push($_SESSION["errors"], "Please fill in all the fields");
                }else{
                    // Check if email are valid //
                    if(!filter_var($login_email, FILTER_VALIDATE_EMAIL) && !checkdnsrr($login_email_host, 'MX')) {
                        array_push($_SESSION["errors"], "Please enter a valid email address");
                    }
                    // Check if password has more than 8 charatchters //
                    if(strlen($login_password) < 8){
                        array_push($_SESSION["errors"], "Please enter a valid password");
                    }
                }
                // If we have errors return in to login page //
                if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
                    header("Location: ".PAGE_PATH."login");
                }else{
                    // Check if user exists //
                    $login = $this->user->login_user($login_email, $login_password);
                    
                    if(isset($login) && !empty($login)){
                        $_SESSION['user'] = $login;
                        header("Location: ".PAGE_PATH."home");
                    }else{
                        array_push($_SESSION["errors"], "Something went wrong");
                        header("Location: ".PAGE_PATH."login");
                    }
                }
            break;

            case "logout":
                session_destroy();
                session_unset();
                header("Location: ".PAGE_PATH);
                exit();
            break;

            default:
                require __DIR__."/../views/errors/404.php"; 
            break;
        }
    }
}