<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../config/connection.php";
        include "functions.php";
        try {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
    //provera
            $sifrovanalozinka = md5($password);
            $unosKorisnika = unosKorisnika($firstName, $lastName, $email, $sifrovanalozinka);
            if($unosKorisnika){
                $odgovor = ["Poruka"=>"uspresan unos"];
                echo json_encode($odgovor);
                http_response_code(201);
            }

        }
        catch(PODException $exception){
            http_response_code(500);
        }
    }
    else{
        http_response_code(404);
    }