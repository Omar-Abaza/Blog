<?php 
    require_once '../inc/connection.php';

    if(isset($_POST['submit'])){

        $email = htmlspecialchars((trim($_POST['email'])));
        $password = htmlspecialchars((trim($_POST['password'])));

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

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
        }elseif(strlen($password)<8 || strlen($password)>20 ){
            $errors[]= 'password must be 8-20 characters at least';
        }elseif(!$uppercase || !$lowercase || !$number || !$specialChars ) {
            $errors[]= 'Password should include at least one upper case letter, one number, and one special character.';
        }

        if(empty($errors)){
            $query = "select * from users where Email='$email'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){

            }else{
                $_SESSION['errors'] = "this account not exists";
            }

        }


    }else{
        header("location: ../login.php");
    }
