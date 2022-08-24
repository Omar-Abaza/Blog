<?php 
require_once '../inc/connection.php';
    if(isset($_POST['submit'])){
        
        $email = htmlspecialchars((trim($_POST['email'])));
        $password = htmlspecialchars((trim($_POST['password'])));
        
        $errors =[];
        //email
        if(empty($email)){ 
            $errors[]="email is required";
        }elseif(! filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors[]= "please enter validate email";
        }

        //password
        if(empty($password)){
            $errors[]= 'password is required';
        }elseif(strlen($password)<6 ){
            $errors[]= 'password must be more than 6 chars';
        }

        if(empty($errors)){

            $query = "select * from users where email = '$email'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result) == 1){
                
                $user =mysqli_fetch_assoc($result);
                $oldPassword = $user['password'];
                $is_valid = password_verify($password,$oldPassword);
                if($is_valid){
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['success']= ["welcome back"];
                    header("location: ../index.php");
                    
                }else{
                    $_SESSION['errors'] = ["credintials not correct"];
                    header("location: ../login.php");
                }

            }else{
                $_SESSION['errors'] = ["this account doesn't exist"];
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header("location: ../login.php");
            }
        }else{
            $_SESSION['errors'] = $errors;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header("location: ../login.php");
        }
    }else{
        header("location: ../login.php");
    }
