<?php
function getPageDetails($page_name){
    try {
        global $conn;

        $result = $conn->prepare("SELECT * FROM page WHERE path LIKE ?");
        $result->execute([$page_name]);

        return $result->fetch();
    } catch (PDOException $ex) {
        return $ex;
    }
}
function unosKorisnika($firstName, $lastName, $email, $sifrovanaLozinka){
    try{
        global $conn;
        $query = "INSERT INTO user(first_name, last_name, email, password) VALUES
        (:firstName, :lastName, :email, :password)";
        $priprema = $conn->prepare($query);
        $priprema ->bindParam(':firstName', $firstName);
        $priprema ->bindParam(':lastName', $lastName);
        $priprema ->bindParam(':email', $email);
        $priprema ->bindParam(':password', $sifrovanaLozinka);
        $result = $priprema->execute();
        return $result;
    }
    catch (PDOException $ex) {
        return false;
    }

}
function queryFunction($queryString, $fetchAll = false){
    try {
        global $conn;

        if ($fetchAll){
            return $conn->query($queryString)->fetchAll();
        }

        return $conn->query($queryString)->fetch();

    } catch (PDOException $ex) {
        return false;
    }
}

function selectQuery($table, $fetchAll = false){
    try {

        global $conn;

        $query = "SELECT * FROM " . $table;
        return $conn->query($query)->fetchAll();

    } catch (PDOException $ex) {
        return false;
    }
}
function proveraLogovanja($email, $sifrovanalozinka){
    try {
        global $conn;

        $priprema = $conn->prepare('SELECT u.*, r.name as role_name FROM user u JOIN role r ON u.role = r.id_role WHERE u.email = :email AND u.password = :password');
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':password', $sifrovanalozinka);
        $priprema->execute();
        $result = $priprema->fetch();
        return $result;
    }
    catch (PDOException $ex){
        return $ex;
    }
}
function changeActiveStatusForUser($table, $id, $status){

    try {
        global $conn;

        $status = !$status;
        $result = $conn->prepare("UPDATE ? SET active = ? WHERE id = ?");
        $result = $result->execute([$table, $status, $id]);
        var_dump($result);
        die();

        return $result;
    } catch (PDOException $ex) {
        //createLog(ERROR_LOG_FAJL, $ex->getMessage());
        var_dump($ex);
        die();
        return false;
    }
}
?>