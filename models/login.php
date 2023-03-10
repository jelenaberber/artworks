<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "../config/connection.php";
    include "functions.php";
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];
        //provera
        $sifrovanalozinka = md5($password);
        $korisnikObj = proveraLogovanja($email, $sifrovanalozinka);
        if($korisnikObj){
            var_dump($korisnikObj);
            $_SESSION['user'] = $korisnikObj;
            if ($korisnikObj->role_name == "Admin"){
                header("Location: ../index.php?page=admin");
//                die();
            }
            else{
                header("Location: ../index.php?page=home");
            }
        }
    }
    catch(PODException $exception){
        //http_response_code(500);
        $error = "Greška pri komunikaciji sa serverom, probajte kasnije ponovo.";
        header("Location: ../index.php?page=login&error=".$error);
        die();
    }
}
else{
    header("Location: ../index.php?page=home");
    die();
}